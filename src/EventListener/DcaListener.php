<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\Input;
use Doctrine\DBAL\Connection;

class DcaListener
{
    public function __construct(private readonly Connection $connection)
    {
    }

    #[AsCallback(table: 'tl_inserttags', target: 'config.onload')]
    public function onLoadCallback(DataContainer $dc): void
    {
        // Disable rich text editor if checkbox is set
        if ('edit' === Input::get('act')) {
            $disableRTE = $this->connection->fetchOne("SELECT disableRTE FROM {$dc->table} WHERE id=?", [$dc->id]);

            if ($disableRTE) {
                unset($GLOBALS['TL_DCA'][$dc->table]['fields']['replacement']['eval']['rte'], $GLOBALS['TL_DCA'][$dc->table]['fields']['replacementNot']['eval']['rte']);
            }
        }
    }

    #[AsCallback(table: 'tl_inserttags', target: 'fields.groups.options')]
    public function onGroupsOptionsCallback(): array
    {
        $options = [-1 => &$GLOBALS['TL_LANG']['MSC']['guests']];
        $records = $this->connection->fetchAllAssociative('SELECT id, name FROM tl_member_group ORDER BY name');

        foreach ($records as $record) {
            $options[$record['id']] = $record['name'];
        }

        return $options;
    }
}
