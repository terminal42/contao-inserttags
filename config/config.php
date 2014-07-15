<?php

/**
 * inserttags extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2008-2014, terminal42 gmbh
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/terminal42/contao-inserttags
 */


/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['inserttags'] = array
(
	'tables'	=> array('tl_inserttags'),
	'icon'		=> 'system/modules/inserttags/html/icon.gif',
);


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][]	= array('InsertTags', 'replaceCachedTags');
$GLOBALS['TL_HOOKS']['outputBackendTemplate'][]		= array('InsertTags', 'replaceCachedTags');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]			= array('InsertTags', 'replaceDynamicTags');

