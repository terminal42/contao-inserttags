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

use Contao\Config;
use Contao\Database;
use Contao\FrontendUser;
use Contao\PageModel;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class InsertTagHandler
{
    private RequestStack $requestStack;
    private TokenStorageInterface $tokenStorage;

    public function __construct(RequestStack $requestStack, TokenStorageInterface $tokenStorage)
    {
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Check if a tag should be applied (rules, pages).
     */
    public function isTagValid(array $record): bool
    {
        if (Config::get('disableInsertTags')) {
            return false;
        }

        // Show for guests only, but member logged in
        if ($record['guests'] && ($user = $this->getFrontendUser()) !== null) {
            return false;
        }

        // Show to members only
        if ($record['protected']) {
            $user = $user ?? $this->getFrontendUser();

            // no member logged in
            if (null === $user) {
                return false;
            }

            $tagGroups = StringUtil::deserialize($record['groups']);
            $userGroups = StringUtil::deserialize($user->groups);

            // No groups available or member not in group
            if (
                !\is_array($tagGroups)
                || 0 === \count($tagGroups)
                || !\is_array($userGroups)
                || 0 === \count($userGroups)
                || 0 === \count(array_intersect($tagGroups, $userGroups))
            ) {
                return false;
            }
        }

        // Limit pages
        if ($record['limitpages']) {
            $pages = StringUtil::deserialize($record['pages']);

            if (!\is_array($pages)) {
                return false;
            }

            $allPages = $pages;

            if ($record['includesubpages']) {
                $subpages = Database::getInstance()->getChildRecords($pages, 'tl_page');
                $allPages = array_merge($allPages, $subpages);
            }

            $allPages = array_unique(array_map('intval', $allPages));

            if (($request = $this->requestStack->getCurrentRequest()) === null || !$request->attributes->has('pageModel')) {
                return false;
            }

            /** @var PageModel $pageModel */
            $pageModel = $request->attributes->get('pageModel');
            $pageModel->loadDetails();

            if (!\in_array((int) $pageModel->id, $allPages, true)) {
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

        return is_a($user, FrontendUser::class) ? $user : null;
    }
}
