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

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Contao\Input;
use Doctrine\DBAL\Connection;

class DcaListener
{
    public function __construct(private Connection $connection)
    {
    }

    /**
     * @Callback(table="tl_inserttags", target="config.onload")
     */
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

    /**
     * @Callback(table="tl_inserttags", target="list.label.label")
     */
    public function onLabelCallback(array $row): string
    {
        $label = $row['tag'];

        if (\strlen($row['description']) > 0) {
            $label .= sprintf('<span class="tl_gray">(%s)</span>', $row['description']);
        }

        return $label;
    }

    /**
     * @Callback(table="tl_inserttags", target="fields.groups.options")
     */
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
