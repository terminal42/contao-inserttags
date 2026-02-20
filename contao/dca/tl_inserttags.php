<?php

use Contao\DataContainer;
use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_inserttags'] = [
    // Config
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'tag' => 'index',
            ],
        ],
    ],

    // List
    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_SORTED,
            'fields' => ['tag'],
            'flag' => DataContainer::SORT_INITIAL_LETTER_ASC,
            'panelLayout' => 'filter;search,limit',
        ],
        'label' => [
            'fields' => ['tag', 'description'],
            'format' => '%s <span class="tl_gray">[%s]</span>',
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
            'filter' => true,
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'nospace' => true, 'unique' => true, 'doNotCopy' => true, 'tl_class' => 'w50'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'replacement' => [
            'inputType' => 'textarea',
            'search' => true,
            'eval' => ['rte' => 'tinyMCE', 'allowHtml' => true, 'helpwizard' => true, 'tl_class' => 'clr', 'basicEntities' => true],
            'explanation' => 'customInsertTags',
            'sql' => ['type' => 'text', 'notnull' => false],
        ],
        'replacementNot' => [
            'inputType' => 'textarea',
            'search' => true,
            'eval' => ['rte' => 'tinyMCE', 'allowHtml' => true, 'helpwizard' => true, 'tl_class' => 'clr'],
            'explanation' => 'customInsertTags',
            'sql' => ['type' => 'text', 'notnull' => false],
        ],
        'disableRTE' => [
            'inputType' => 'checkbox',
            'filter' => true,
            'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
            'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
        ],
        'description' => [
            'inputType' => 'text',
            'search' => true,
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
        ],
        'limitpages' => [
            'inputType' => 'checkbox',
            'filter' => true,
            'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
            'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
        ],
        'pages' => [
            'inputType' => 'pageTree',
            'eval' => ['fieldType' => 'checkbox', 'multiple' => true, 'tl_class' => 'clr'],
            'sql' => ['type' => 'blob', 'notnull' => false],
        ],
        'includesubpages' => [
            'inputType' => 'checkbox',
            'filter' => true,
            'eval' => ['tl_class' => 'clr'],
            'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
        ],
        'protected' => [
            'filter' => true,
            'inputType' => 'checkbox',
            'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
            'sql' => "char(1) COLLATE ascii_bin NOT NULL default ''",
        ],
        'groups' => [
            'inputType' => 'checkbox',
            'eval' => ['multiple' => true, 'tl_class' => 'clr'],
            'sql' => ['type' => 'blob', 'notnull' => false],
        ],
    ],
];
