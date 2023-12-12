<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle\Migration;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Contao\StringUtil;
use Doctrine\DBAL\Connection;

class DuplicateRecordsMigration extends AbstractMigration
{
    public function __construct(
        private readonly Connection $connection,
        private readonly ContaoFramework $framework,
    ) {
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['tl_inserttags'])) {
            return false;
        }

        return $this->connection->fetchOne('SELECT COUNT(*) AS total FROM tl_inserttags GROUP BY tag HAVING total > 1') > 0;
    }

    public function run(): MigrationResult
    {
        $this->framework->initialize();

        $tags = $this->connection->fetchFirstColumn('SELECT tag, COUNT(*) AS total FROM tl_inserttags GROUP BY tag HAVING total > 1');

        foreach ($tags as $tag) {
            $records = $this->connection->fetchAllAssociative('SELECT * FROM tl_inserttags WHERE tag=? AND (limitpages=? OR protected=?)', [$tag, 1, 1]);
            $replacement = [];

            foreach ($records as $record) {
                $pages = $record['limitpages'] ? (array) StringUtil::deserialize($record['pages']) : [];
                $comments = [];
                $replacementPages = [];

                // Generate replacement for pages
                foreach ($pages as $page) {
                    $pageTitle = $this->connection->fetchOne('SELECT title FROM tl_page WHERE id=?', [$page]);

                    if (false !== $pageTitle) {
                        $comments[] = sprintf('# Page ID %s is %s', $page, $pageTitle);
                        $replacementPages[] = $record['includesubpages'] ? sprintf('%s in page.trail', $page) : sprintf('page.id == %s', $page);
                    }
                }

                $groups = $record['protected'] ? (array) StringUtil::deserialize($record['groups']) : [];
                $replacementGroups = [];

                // Generate replacement for member groups
                foreach ($groups as $group) {
                    $groupTitle = $this->connection->fetchOne('SELECT title FROM tl_page WHERE id=?', [$group]);

                    if (false !== $groupTitle) {
                        $comments[] = sprintf('# Member group ID %s is %s', $group, $groupTitle);
                        $replacementGroups[] = sprintf('%s in member.groups', $group);
                    }
                }

                $statementChunks = [];

                if (\count($replacementGroups) > 0) {
                    $statementChunks[] = sprintf('member and (%s)', implode(' or ', $replacementGroups));
                }

                if (\count($replacementPages) > 0) {
                    if (\count($statementChunks) > 0) {
                        $statementChunks[] = sprintf('(%s)', implode(' or ', $replacementPages));
                    } else {
                        $statementChunks[] = sprintf('%s', implode(' or ', $replacementPages));
                    }
                }

                if (\count($statementChunks) > 0) {
                    $replacement[] = implode("\n", $comments);
                    $replacement[] = sprintf('{if %s}', implode(' and ', $statementChunks));
                    $replacement[] = $record['replacement'];
                    $replacement[] = '{endif}';
                    $replacement[] = '';
                }
            }

            // Remove the last empty line from the array
            array_pop($replacement);

            $this->connection->delete('tl_inserttags', ['tag' => $tag]);

            $this->connection->insert('tl_inserttags', [
                'tstamp' => time(),
                'tag' => $tag,
                'replacement' => implode("\n", $replacement),
                'disableRTE' => true,
            ]);
        }

        return $this->createResult(true);
    }
}
