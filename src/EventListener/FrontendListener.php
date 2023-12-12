<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Terminal42\InsertTagsBundle\InsertTagHandler;

class FrontendListener
{
    public function __construct(
        private InsertTagHandler $handler,
        private RequestStack $requestStack,
        private ScopeMatcher $scopeMatcher,
    ) {
    }

    #[AsHook('replaceInsertTags')]
    public function onReplaceInsertTags(string $tag): string|false
    {
        $request = $this->requestStack->getCurrentRequest();

        if (null !== $request && $this->scopeMatcher->isFrontendRequest($request) && ($parsed = $this->handler->parseInsertTag($tag)) !== null) {
            return $parsed;
        }

        return false;
    }
}
