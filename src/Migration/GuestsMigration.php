<?php

namespace Terminal42\InsertTagsBundle\Migration;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Contao\StringUtil;
use Doctrine\DBAL\Connection;

class GuestsMigration extends AbstractMigration
{
    private Connection $connection;
    private ContaoFramework $framework;

    public function __construct(Connection $connection, ContaoFramework $framework)
    {
        $this->connection = $connection;
        $this->framework = $framework;
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tablesExist(['tl_inserttags'])) {
            return false;
        }

        $columns = $schemaManager->listTableColumns('guests');

        return isset($columns['guests']);
    }

    public function run(): MigrationResult
    {
        $this->framework->initialize();

        $records = $this->connection->fetchAllAssociative('SELECT id, protected, `groups` FROM tl_inserttags WHERE guests=?', [1]);

        foreach ($records as $record) {
            $groups = (array) StringUtil::deserialize($record['groups']);
            $groups[] = -1;

            $this->connection->update('tl_inserttags', ['protected' => 1, 'groups' => serialize($groups)], ['id' => $record['id']]);
        }

        $this->connection->executeStatement('
            ALTER TABLE
                tl_inserttags
            DROP COLUMN 
                guests
        ');

        return $this->createResult(true);
    }
}
