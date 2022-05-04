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

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\InsertTagsBundle\InsertTagHandler;

class FrontendListener
{
    public function __construct(private InsertTagHandler $handler) {}

    /**
     * @Hook("replaceInsertTags")
     */
    public function onReplaceInsertTags(string $tag)
    {
        if (($parsed = $this->handler->parseInsertTag($tag)) !== null) {
            return $parsed;
        }

        return false;
    }
}
