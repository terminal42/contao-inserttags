<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Psr\Log\LoggerInterface;
use Terminal42\InsertTagsBundle\InsertTagHandler;

#[AsHook('replaceInsertTags')]
class InsertTagsListener
{
    public function __construct(
        private readonly InsertTagHandler $handler,
        private readonly LoggerInterface|null $logger = null,
    ) {
    }

    public function __invoke(string $tag): string|false
    {
        try {
            $parsed = $this->handler->parseInsertTag($tag);

            if (null === $parsed) {
                return false;
            }

            return $parsed;
        } catch (\Throwable $exception) {
            if (!$this->logger) {
                throw $exception;
            }

            $this->logger->error(
                \sprintf('Could not replace custom insert tag "%s": %s', $tag, $exception->getMessage()),
                [
                    'exception' => $exception,
                ],
            );
        }

        return false;
    }
}
