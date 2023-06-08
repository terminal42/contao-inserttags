<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_inserttags'] = [
    // Config
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],

    // List
    'list' => [
        'sorting' => [
            'mode' => 1,
            'fields' => ['tag'],
            'flag' => 1,
            'panelLayout' => 'filter;search,limit',
        ],
        'label' => [
            'fields' => ['tag', 'description'],
            'format' => '%s <span class="tl_gray">(%s)</span>',
        ],
        'global_operations' => [
            'all' => [
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();"',
            ],
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'copy' => [
                'href' => 'act=copy',
                'icon' => 'copy.svg',
            ],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if (!confirm(\''.($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? '').'\')) return false; Backend.getScrollOffset();"',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],

    // Palettes
    'palettes' => [
        '__selector__' => ['limitpages', 'protected'],
        'default' => '{tag_legend},tag,description,replacement,replacementNot,disableRTE;{limit_legend},limitpages,protected',
    ],

    // Subpalettes
    'subpalettes' => [
        'limitpages' => 'pages,includesubpages',
        'protected' => 'groups',
    ],

    // Fields
    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'tag' => [
            'inputType' => 'text',
            'exclude' => true,
            'filter' => true,
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'nospace' => true, 'unique' => true, 'doNotCopy' => true, 'tl_class' => 'w50'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'replacement' => [
            'inputType' => 'textarea',
            'exclude' => true,
            'search' => true,
            'eval' => ['rte' => 'tinyMCE', 'allowHtml' => true, 'helpwizard' => true, 'tl_class' => 'clr'],
            'explanation' => 'customInsertTags',
            'sql' => ['type' => 'text', 'notnull' => false],
        ],
        'replacementNot' => [
            'inputType' => 'textarea',
            'exclude' => true,
            'search' => true,
            'eval' => ['rte' => 'tinyMCE', 'allowHtml' => true, 'helpwizard' => true, 'tl_class' => 'clr'],
            'explanation' => 'customInsertTags',
            'sql' => ['type' => 'text', 'notnull' => false],
        ],
        'disableRTE' => [
            'inputType' => 'checkbox',
            'exclude' => true,
            'filter' => true,
            'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
            'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
        ],
        'description' => [
            'inputType' => 'text',
            'exclude' => true,
            'search' => true,
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'limitpages' => [
            'inputType' => 'checkbox',
            'exclude' => true,
            'filter' => true,
            'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
            'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
        ],
        'pages' => [
            'inputType' => 'pageTree',
            'exclude' => true,
            'eval' => ['fieldType' => 'checkbox', 'multiple' => true, 'tl_class' => 'clr'],
            'sql' => ['type' => 'blob', 'notnull' => false],
        ],
        'includesubpages' => [
            'inputType' => 'checkbox',
            'exclude' => true,
            'filter' => true,
            'eval' => ['tl_class' => 'clr'],
            'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
        ],
        'protected' => [
            'exclude' => true,
            'filter' => true,
            'inputType' => 'checkbox',
            'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
            'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
        ],
        'groups' => [
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => ['multiple' => true, 'tl_class' => 'clr'],
            'sql' => ['type' => 'blob', 'notnull' => false],
        ],
    ],
];
