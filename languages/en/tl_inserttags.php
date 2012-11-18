<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  terminal42 gmbh 2008-2012
 * @author     Andreas Schempp <andreas.schempp@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_inserttags']['tag']				= array('Insert-Tag', 'Please enter your insert-tag.<br />You can use this tag in any content element using {{custom::your-tag}}');
$GLOBALS['TL_LANG']['tl_inserttags']['replacement']		= array('Replacement', 'Enter the content you want to replace the insert-tag with.');
$GLOBALS['TL_LANG']['tl_inserttags']['disableRTE']		= array('Disable TinyMCE', 'Please check here if you want to disable TinyMCE rich text editor.');
$GLOBALS['TL_LANG']['tl_inserttags']['description']		= array('Description', 'You can enter a description for this insert tag to be able to differentiate same tags from each other.');
$GLOBALS['TL_LANG']['tl_inserttags']['timing']			= array('Timing', 'You can define a start and end date/time for this tag. If you create the same tag multiple times with different date/time, you can replace the insert tag depending on day/time value.');
$GLOBALS['TL_LANG']['tl_inserttags']['start_date']		= array('Start date', 'Please enter the start date for this tag (day / month / year).<br />You can leave fields empty to ignore these values (ex. year).');
$GLOBALS['TL_LANG']['tl_inserttags']['start_time']		= array('Start time', 'Please insert the start date for this tag (hour / minute).');
$GLOBALS['TL_LANG']['tl_inserttags']['end_date']		= array('End date', 'Please enter the end date for this tag (day / month / year).');
$GLOBALS['TL_LANG']['tl_inserttags']['end_time']		= array('End time', 'Please enter the end time for this tag (hour / minute).');
$GLOBALS['TL_LANG']['tl_inserttags']['backend']			= array('Apply InsertTag to', 'Please select if you want to apply this InsertTag to front- or backend.');
$GLOBALS['TL_LANG']['tl_inserttags']['cacheOutput']		= array('Cache Output', 'Please check here if you want to apply this InsertTag before TYPOlight caches the page.');
$GLOBALS['TL_LANG']['tl_inserttags']['useCondition']	= array('Condition', 'Please check here, if you want to use this insert tag on a certain condition.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionType']	= array('Query-Type', 'If you select database, enter a valid SQL query. The first field of the first result row will be returned. You can use insert tags in the query.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionQuery']	= array('Query', 'Please enter a query. This could be a TYPOlight insert tag for example.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionFormula']= array('Formula', 'Please choose a formula to compare query with value.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionValue']	= array('Value', 'Please enter the value your query should match.');
$GLOBALS['TL_LANG']['tl_inserttags']['limitpages']		= array('Limit pages', 'Please check here, if you want to limit this insert tag to certain pages.');
$GLOBALS['TL_LANG']['tl_inserttags']['pages']			= array('Pages', 'Please choose the pages you want to limit this insert tag to.');
$GLOBALS['TL_LANG']['tl_inserttags']['includesubpages']	= array('Include subpages', 'Please check here if you want this insert tag to be applied on subpages of your select, too.');
$GLOBALS['TL_LANG']['tl_inserttags']['limitLanguages']	= array('Limit languages', 'Check here if you want to limit this insert tag to certain languages.');
$GLOBALS['TL_LANG']['tl_inserttags']['languages']		= array('Languages', 'Choose the languages you want to limit this insert tag to.');
$GLOBALS['TL_LANG']['tl_inserttags']['useCounter']		= array('Use Counter', 'Add a counter to display this insert tag only after a certain amount of calls.');
$GLOBALS['TL_LANG']['tl_inserttags']['counterValue']	= array('Current value', 'This is the current counter value. You should adjust it in the beginning, and it will be decreased by 1 on every usage of this insert tag.');
$GLOBALS['TL_LANG']['tl_inserttags']['counterDefault']	= array('Default value', 'Enter the default value. The counter will jump back to this value when repeating has been enabled and value is 0.');
$GLOBALS['TL_LANG']['tl_inserttags']['counterRepeat']	= array('Repeat counter', 'Click here if you want to repeat this counter.');
$GLOBALS['TL_LANG']['tl_inserttags']['protected']		= array('Protect insert-tag', 'Show the inserttag to certain member groups only.');
$GLOBALS['TL_LANG']['tl_inserttags']['groups']			= array('Allowed member groups', 'These groups will be able to see the insert-tag.');
$GLOBALS['TL_LANG']['tl_inserttags']['guests']			= array('Show to guests only', 'Hide the insert-tag if a member is logged in.');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_inserttags']['eq']				= 'equals';
$GLOBALS['TL_LANG']['tl_inserttags']['neq']				= 'not equal';
$GLOBALS['TL_LANG']['tl_inserttags']['lt']				= 'less than';
$GLOBALS['TL_LANG']['tl_inserttags']['gt']				= 'greather than';
$GLOBALS['TL_LANG']['tl_inserttags']['elt']				= 'less than or equal to';
$GLOBALS['TL_LANG']['tl_inserttags']['egt']				= 'greather than or equal to';
$GLOBALS['TL_LANG']['tl_inserttags']['starts']			= 'starts with (case-sensitive)';
$GLOBALS['TL_LANG']['tl_inserttags']['ends']			= 'ends with (case-sensitive)';
$GLOBALS['TL_LANG']['tl_inserttags']['contains']		= 'contains (case-sensitive)';
$GLOBALS['TL_LANG']['tl_inserttags']['istarts']			= 'starts with (case-insensitive)';
$GLOBALS['TL_LANG']['tl_inserttags']['iends']			= 'ends with (case-insensitive)';
$GLOBALS['TL_LANG']['tl_inserttags']['icontains']		= 'contains (case-insensitive)';
$GLOBALS['TL_LANG']['tl_inserttags']['fe']				= 'Frontend';
$GLOBALS['TL_LANG']['tl_inserttags']['be']				= 'Backend';
$GLOBALS['TL_LANG']['tl_inserttags']['text']			= 'Text';
$GLOBALS['TL_LANG']['tl_inserttags']['database']		= 'Database';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_inserttags']['new']      		= array('Create Tag', 'Create a new Insert-Tag');
$GLOBALS['TL_LANG']['tl_inserttags']['edit']     		= array('Edit Tag', 'Edit Insert-Tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['copy']     		= array('Duplicate Tag', 'Duplicate Insert-Tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['cut']        		= array('Move Tag', 'Move Tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['delete']   		= array('Delete Tag', 'Delete Insert-Tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['show']     		= array('Tag details', 'Show details of Insert-Tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['pasteafter'] 		= array('Paste after', 'Paste after tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['pasteinto']  		= array('Paste into', 'Paste on top');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_inserttags']['tag_legend']			= 'Tag & Replacement';
$GLOBALS['TL_LANG']['tl_inserttags']['limit_legend']		= 'Limits';
$GLOBALS['TL_LANG']['tl_inserttags']['advanced_legend']		= 'Advanced options';
$GLOBALS['TL_LANG']['tl_inserttags']['expert_legend']		= 'Expert settings';

