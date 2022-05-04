<?php

declare(strict_types=1);

/*
 * This file is part of terminal42/contao-inserttags.
 *
 * (c) terminal42
 *
 * @license MIT
 */

// Fields
$GLOBALS['TL_LANG']['tl_inserttags']['tag'] = ['Insert tag', 'Please enter your insert tag.<br>You can use this tag in any content element using {{custom::your-tag}}'];
$GLOBALS['TL_LANG']['tl_inserttags']['replacement'] = ['Replacement', 'Enter the content you want to replace the insert tag with. See help wizard for more detailed description.'];
$GLOBALS['TL_LANG']['tl_inserttags']['replacementNot'] = ['Replacement if conditions are not met', 'Here you can enter the content you want to replace the insert tag with if the below conditions are not met.'];
$GLOBALS['TL_LANG']['tl_inserttags']['disableRTE'] = ['Disable TinyMCE', 'Please check here if you want to disable TinyMCE rich text editor.'];
$GLOBALS['TL_LANG']['tl_inserttags']['description'] = ['Description', 'You can enter a description for this insert tag to be able to differentiate same tags from each other.'];
$GLOBALS['TL_LANG']['tl_inserttags']['limitpages'] = ['Limit pages', 'Please check here, if you want to limit this insert tag to certain pages.'];
$GLOBALS['TL_LANG']['tl_inserttags']['pages'] = ['Pages', 'Please choose the pages you want to limit this insert tag to.'];
$GLOBALS['TL_LANG']['tl_inserttags']['includesubpages'] = ['Include subpages', 'Please check here if you want this insert tag to be applied on subpages of your select, too.'];
$GLOBALS['TL_LANG']['tl_inserttags']['protected'] = ['Protect insert tag', 'Show the inserttag to certain member groups only.'];
$GLOBALS['TL_LANG']['tl_inserttags']['groups'] = ['Allowed member groups', 'These groups will be able to see the insert tag.'];

// Buttons
$GLOBALS['TL_LANG']['tl_inserttags']['new'] = ['Create Tag', 'Create a new Insert tag'];
$GLOBALS['TL_LANG']['tl_inserttags']['edit'] = ['Edit Tag', 'Edit Insert tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['copy'] = ['Duplicate Tag', 'Duplicate Insert tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['cut'] = ['Move Tag', 'Move Tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['delete'] = ['Delete Tag', 'Delete Insert tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['show'] = ['Tag details', 'Show details of Insert tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['pasteafter'] = ['Paste after', 'Paste after tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['pasteinto'] = ['Paste into', 'Paste on top'];

// Legends
$GLOBALS['TL_LANG']['tl_inserttags']['tag_legend'] = 'Tag & Replacement';
$GLOBALS['TL_LANG']['tl_inserttags']['limit_legend'] = 'Limits';
