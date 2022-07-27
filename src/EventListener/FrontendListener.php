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

use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Symfony\Component\HttpFoundation\RequestStack;
use Terminal42\InsertTagsBundle\InsertTagHandler;

class FrontendListener
{
    public function __construct(
        private InsertTagHandler $handler,
        private RequestStack $requestStack,
        private ScopeMatcher $scopeMatcher,
    )
    {
    }

    /**
     * @Hook("replaceInsertTags")
     */
    public function onReplaceInsertTags(string $tag)
    {
        $request = $this->requestStack->getCurrentRequest();

        if ($request !== null && $this->scopeMatcher->isFrontendRequest($request) && ($parsed = $this->handler->parseInsertTag($tag)) !== null) {
            return $parsed;
        }

        return false;
    }
}
