<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle\EventListener;

use Composer\InstalledVersions;
use Composer\Semver\VersionParser;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DC_Table;
use Contao\Input;
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
        /** @phpstan-ignore-next-line */
        if (method_exists($dc, 'getActiveRecord') && ($dc->getActiveRecord()['disableRTE'] ?? false)) {
            unset($attributes['rte']);
        }

        return $attributes;
    }

    #[AsCallback(table: 'tl_inserttags', target: 'config.onload')]
    public function onLoadCallback(DC_Table $dc): void
    {
        // Contao 5.1 introduced the attributes callback which we'll use instead because it also works in edit-multiple
        if (
            /** @phpstan-ignore-next-line */
            method_exists($dc, 'getActiveRecord')
            && class_exists(InstalledVersions::class)
            && class_exists(VersionParser::class)
            && InstalledVersions::satisfies(new VersionParser(), 'contao/core-bundle', '^5.1')
        ) {
            return;
        }

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
