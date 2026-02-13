<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DC_Table;
use Doctrine\DBAL\Connection;

class DcaListener
{
    public function __construct(private readonly Connection $connection)
    {
    }

    #[AsCallback(table: 'tl_inserttags', target: 'fields.replacement.attributes')]
    #[AsCallback(table: 'tl_inserttags', target: 'fields.replacementNot.attributes')]
    public function disableRte(array $attributes, DC_Table $dc): array
    {
        if ($dc->getActiveRecord()['disableRTE'] ?? false) {
            unset($attributes['rte']);
        }

        return $attributes;
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
