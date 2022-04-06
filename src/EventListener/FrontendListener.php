<?php

declare(strict_types=1);

/*
 * This file is part of terminal42/contao-inserttags.
 *
 * (c) terminal42
 *
 * @license MIT
 */

namespace Terminal42\InsertTagsBundle\EventListener;

use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\Monolog\ContaoContext;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\CoreBundle\String\SimpleTokenParser;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Terminal42\InsertTagsBundle\InsertTagHandler;

class FrontendListener
{
    private Connection $connection;
    private InsertTagHandler $handler;
    private InsertTagParser $insertTagParser;
    private LoggerInterface $logger;
    private SimpleTokenParser $simpleTokenParser;

    private array $internalRegistry = [];

    public function __construct(Connection $connection, InsertTagHandler $handler, InsertTagParser $insertTagParser, LoggerInterface $logger, SimpleTokenParser $simpleTokenParser)
    {
        $this->connection = $connection;
        $this->handler = $handler;
        $this->insertTagParser = $insertTagParser;
        $this->logger = $logger;
        $this->simpleTokenParser = $simpleTokenParser;
    }

    /**
     * @Hook("outputFrontendTemplate")
     */
    public function onOutputFrontendTemplate(string $buffer): string
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['tl_inserttags'])) {
            return $buffer;
        }

        $tags = preg_split('/{{(custom::[^}]+)}}/', $buffer, -1, PREG_SPLIT_DELIM_CAPTURE);
        $buffer = '';

        for ($_rit = 0, $total = \count($tags); $_rit < $total; $_rit += 2) {
            $buffer .= $tags[$_rit];
            $tag = $tags[$_rit + 1];

            // Skip empty tags
            if (!\strlen($tag)) {
                continue;
            }

            $chunks = explode('::', $tag);
            $records = $this->connection->fetchAllAssociative('SELECT * FROM tl_inserttags WHERE tag=? AND cacheOutput=? ORDER BY sorting', [$chunks[1], 1]);

            foreach ($records as $record) {
                if (!$this->handler->isTagValid($record)) {
                    continue;
                }

                ++$this->internalRegistry[$tag];

                $buffer .= $this->simpleTokenParser->parse($this->insertTagParser->replaceInline($record['replacement']), $chunks);

                break;
            }

            $buffer .= '{{'.$tag.'}}';
        }

        return $buffer;
    }

    /**
     * @Hook("replaceInsertTags")
     */
    public function onReplaceInsertTags(string $tag)
    {
        if ($this->internalRegistry[$tag] > 50) {
            $this->logger->log(
                LogLevel::ERROR,
                sprintf('WARNING: InsertTag "%s" caused an endless loop!', $tag),
                ['contao' => new ContaoContext(__METHOD__, TL_ERROR)]
            );

            return '';
        }

        $chunks = explode('::', $tag);

        if ('custom' !== $chunks[0]) {
            return false;
        }

        $records = $this->connection->fetchAllAssociative('SELECT * FROM tl_inserttags WHERE tag=? AND cacheOutput=? ORDER BY sorting', [$chunks[1], '']);

        foreach ($records as $record) {
            if (!$this->handler->isTagValid($record)) {
                continue;
            }

            ++$this->internalRegistry[$tag];

            return $this->simpleTokenParser->parse($this->insertTagParser->replaceInline($record['replacement']), $chunks);
        }

        return '';
    }
}
