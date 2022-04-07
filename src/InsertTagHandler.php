<?php

declare(strict_types=1);

/*
 * This file is part of terminal42/contao-inserttags.
 *
 * (c) terminal42
 *
 * @license MIT
 */

namespace Terminal42\InsertTagsBundle;

use Contao\Database;
use Contao\FrontendUser;
use Contao\PageModel;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class InsertTagHandler
{
    public function __construct(private RequestStack $requestStack, private TokenStorageInterface $tokenStorage) {}

    /**
     * Check if a tag should be applied (rules, pages).
     */
    public function isTagValid(array $record): bool
    {
        if (!$this->validateProtection($record) || !$this->validateLimitPages($record)) {
            return false;
        }

        return true;
    }

    /**
     * Validate the protection.
     */
    private function validateProtection(array $record): bool
    {
        if (!$record['protected']) {
            return true;
        }

        $groups = StringUtil::deserialize($record['groups']);

        // There are no groups
        if (!\is_array($groups) || 0 === \count($groups)) {
            return false;
        }

        $groups = array_map('\intval', $groups);
        $user = $this->getFrontendUser();

        // Allow anonymous users if the "guest" group is allowed
        if (null === $user) {
            return in_array(-1, $groups, true);
        }

        $userGroups = StringUtil::deserialize($user->groups);

        // Member is not in the group
        if (!\is_array($userGroups) || 0 === \count($userGroups) || 0 === \count(array_intersect($groups, $userGroups))) {
            return false;
        }

        return true;
    }

    /**
     * Validate the limit pages.
     */
    private function validateLimitPages(array $record): bool
    {
        if (!$record['limitpages']) {
            return true;
        }

        $pageIds = StringUtil::deserialize($record['pages']);

        if (!\is_array($pageIds)) {
            return false;
        }

        // The page model is not available
        if (($request = $this->requestStack->getCurrentRequest()) === null || !$request->attributes->has('pageModel')) {
            return false;
        }

        $pageIds = array_map('\intval', $pageIds);

        /** @var PageModel $currentPage */
        $currentPage = $request->attributes->get('pageModel');
        $currentPageId = (int) $currentPage->id;

        if (!in_array($currentPageId, $pageIds, true)) {
            if (!$record['includesubpages']) {
                return false;
            }

            $parentIds = array_map('\intval', Database::getInstance()->getParentRecords($currentPageId, 'tl_page'));

            if (count(array_intersect($pageIds, $parentIds)) === 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the frontend user.
     */
    private function getFrontendUser(): ?FrontendUser
    {
        $token = $this->tokenStorage->getToken();

        if (null === $token) {
            return null;
        }

        $user = $token->getUser();

        return ($user instanceof FrontendUser::class) ? $user : null;
    }
}
