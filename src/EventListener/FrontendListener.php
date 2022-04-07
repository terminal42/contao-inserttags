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
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\CoreBundle\String\SimpleTokenParser;
use Doctrine\DBAL\Connection;
use Terminal42\InsertTagsBundle\InsertTagHandler;

class FrontendListener
{
    private Connection $connection;
    private InsertTagHandler $handler;
    private InsertTagParser $insertTagParser;
    private SimpleTokenParser $simpleTokenParser;

    public function __construct(Connection $connection, InsertTagHandler $handler, InsertTagParser $insertTagParser, SimpleTokenParser $simpleTokenParser)
    {
        $this->connection = $connection;
        $this->handler = $handler;
        $this->insertTagParser = $insertTagParser;
        $this->simpleTokenParser = $simpleTokenParser;
    }

    /**
     * @Hook("replaceInsertTags")
     */
    public function onReplaceInsertTags(string $tag)
    {
        $chunks = explode('::', $tag);

        if ('custom' !== $chunks[0]) {
            return false;
        }

        $records = $this->connection->fetchAllAssociative('SELECT * FROM tl_inserttags WHERE tag=? ORDER BY sorting', [$chunks[1]]);

        foreach ($records as $record) {
            if (!$this->handler->isTagValid($record)) {
                continue;
            }

            return $this->simpleTokenParser->parse($this->insertTagParser->replaceInline($record['replacement']), $chunks);
        }

        return '';
    }
}
