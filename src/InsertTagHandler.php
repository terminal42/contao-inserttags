<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle;

use Codefog\HasteBundle\Formatter;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\Database;
use Contao\FrontendUser;
use Contao\PageModel;
use Contao\StringUtil;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class InsertTagHandler
{
    private array $cache = [];

    public function __construct(
        private readonly Connection $connection,
        private readonly Parser $parser,
        private readonly RequestStack $requestStack,
        private readonly AuthorizationCheckerInterface $authorizationChecker,
        private readonly TokenStorageInterface $tokenStorage,
        private readonly Formatter $formatter,
    ) {
    }

    public function parseInsertTag(string $tag): string|null
    {
        $chunks = explode('::', $tag);

        if ('custom' !== $chunks[0]) {
            return null;
        }

        $record = $this->getTagRecord($chunks[1] ?? '');

        if (null === $record) {
            return null;
        }

        $user = $this->getFrontendUser();
        $pageModel = $this->getPageModel();

        // Generate the evaluation tokens
        $tokens = [
            'member' => $user,
            'page' => $pageModel,
        ];

        // Generate the member replacement tokens
        if (null !== $user) {
            foreach ($user->getData() as $k => $v) {
                $tokens['member_'.$k] = $this->formatter->dcaValue('tl_member', $k, $v);
            }
        }

        // Generate the page replacement tokens
        if (null !== $pageModel) {
            foreach ($pageModel->row() as $k => $v) {
                $tokens['page_'.$k] = $this->formatter->dcaValue('tl_page', $k, $v);
            }
        }

        // Return the "replacement not" if tag is found but does not validate
        if (!$this->isTagValid($record)) {
            return $this->parser->parse((string) $record['replacementNot'], $tokens);
        }

        return $this->parser->parse((string) $record['replacement'], $tokens);
    }

    private function getTagRecord(string $tag): array|null
    {
        if (!\array_key_exists($tag, $this->cache)) {
            $this->cache[$tag] = $this->connection->fetchAssociative('SELECT * FROM tl_inserttags WHERE tag=?', [$tag]);
        }

        return $this->cache[$tag] ?: null;
    }

    /**
     * Check if a tag should be applied (rules, pages).
     */
    private function isTagValid(array $record): bool
    {
        if (!$this->validateProtection($record) || !$this->validateLimitPages($record)) {
            return false;
        }

        return true;
    }

    private function validateProtection(array $record): bool
    {
        if (!$record['protected']) {
            return true;
        }

        return $this->authorizationChecker->isGranted(ContaoCorePermissions::MEMBER_IN_GROUPS, StringUtil::deserialize($record['groups'], true));
    }

    private function validateLimitPages(array $record): bool
    {
        if (!$record['limitpages']) {
            return true;
        }

        // The page model is not available
        $currentPage = $this->getPageModel();

        if (null === $currentPage) {
            return false;
        }

        $pageIds = StringUtil::deserialize($record['pages']);

        if (!\is_array($pageIds)) {
            return false;
        }

        // Validate only if there is a page model
        $pageIds = array_map(\intval(...), $pageIds);
        $currentPageId = (int) $currentPage->id;

        if (!\in_array($currentPageId, $pageIds, true)) {
            if (!$record['includesubpages']) {
                return false;
            }

            $parentIds = array_map(\intval(...), Database::getInstance()->getParentRecords($currentPageId, 'tl_page'));

            if (0 === \count(array_intersect($pageIds, $parentIds))) {
                return false;
            }
        }

        return true;
    }

    private function getPageModel(): PageModel|null
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request instanceof Request) {
            return null;
        }

        $pageModelOrId = $request->attributes->get('pageModel');

        if ($pageModelOrId instanceof PageModel) {
            return $pageModelOrId;
        }

        if (isset($GLOBALS['objPage'])) {
            if ($GLOBALS['objPage'] instanceof PageModel) {
                return $GLOBALS['objPage'];
            }
            if (is_numeric($GLOBALS['objPage'])) {
                return PageModel::findById((int) $GLOBALS['objPage']);
            }
            if (is_numeric($pageModelOrId)) {
                return PageModel::findById((int) $pageModelOrId);
            }
        }

        return null;
    }

    private function getFrontendUser(): FrontendUser|null
    {
        $user = $this->tokenStorage->getToken()?->getUser();

        return $user instanceof FrontendUser ? $user : null;
    }
}
