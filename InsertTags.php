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


class InsertTags extends Frontend
{

	/**
	 * Current object instance (Singleton)
	 * @var object
	 */
	private static $objInstance;


	/**
	 * Prevent cloning of the object (Singleton)
	 */
	final private function __clone() {}


	/**
	 * Return the current object instance (Singleton)
	 * @return object
	 */
	public static function getInstance()
	{
		if (!is_object(self::$objInstance))
		{
			self::$objInstance = new InsertTags();
		}

		return self::$objInstance;
	}


	/**
	 * Replace tags in outputFrontendTemplate and outputBackendTemplate functions.
	 *
	 * @access public
	 * @param string $strBuffer
	 * @param string $strTemplate
	 * @return string
	 */
	public function replaceCachedTags($strBuffer, $strTemplate)
	{
		if (basename($_SERVER['REQUEST_URI']) == 'install.php' || !$this->Database->tableExists('tl_inserttags') || !$this->Database->fieldExists('sorting', 'tl_inserttags'))
			return $strBuffer;

		$tags = preg_split('/{{(custom::[^}]+)}}/', $strBuffer, -1, PREG_SPLIT_DELIM_CAPTURE);

		$strBuffer = '';

		for($_rit=0; $_rit<count($tags); $_rit=$_rit+2)
		{
			$strBuffer .= $tags[$_rit];
			$strTag = $tags[$_rit+1];

			// Skip empty tags
			if (!strlen($strTag))
			{
				continue;
			}

			$arrTag = explode('::', $strTag);

			$objTags = $this->Database->prepare("SELECT * FROM tl_inserttags WHERE tag=? AND backend=? " . (TL_MODE == 'FE' ? "AND cacheOutput='1'" : "") . " ORDER BY sorting")
									  ->execute($arrTag[1], (TL_MODE == 'BE' ? '1' : ''));

			while( $arrRow = $objTags->fetchAssoc() )
			{
				if ($this->validateTag($arrRow))
				{
					$GLOBALS['INSERTAGS'][$strTag]++;
					$strBuffer .= $this->parseSimpleTokens($this->replaceInsertTags($arrRow['replacement']), $arrTag);
					break;
				}
			}

			$strBuffer .= '{{' . $strTag . '}}';
		}

		return $strBuffer;
	}


	/**
	 * Replace tags for replaceInsertTags function.
	 *
	 * This currently only works in frontend (backend is not cached anyway...).
	 *
	 * @access public
	 * @param mixed $strTag
	 * @return void
	 */
	public function replaceDynamicTags($strTag)
	{
		if ($GLOBALS['INSERTAGS'][$strTag] > 50)
		{
			$this->log('WARNING: InsertTag "' . $strTag . '" caused an endless loop!', 'InsertTags replaceDynamicTags()', TL_ERROR);
			return '';
		}

		$arrTag = explode('::', $strTag);

		if ($arrTag[0] !== 'custom')
			return false;

		$objTags = $this->Database->prepare("SELECT * FROM tl_inserttags WHERE tag=? AND backend='' AND cacheOutput='' ORDER BY sorting")
								  ->execute($arrTag[1]);

		while( $arrRow = $objTags->fetchAssoc() )
		{
			if ($this->validateTag($arrRow))
			{
				$GLOBALS['INSERTAGS'][$strTag]++;
				return $this->parseSimpleTokens($this->replaceInsertTags($arrRow['replacement']), $arrTag);
			}
		}

		return '';
	}


	/**
	 * Check if a tag should be applied (rules, date/time, pages).
	 *
	 * @access private
	 * @param mixed $arrRow
	 * @return void
	 */
	private function validateTag($arrRow)
	{
		if ($GLOBALS['TL_CONFIG']['disableInsertTags'])
		{
			return false;
		}

		// Show to guests only, but member logged in
		if ($arrRow['guests'] && FE_USER_LOGGED_IN)
		{
			return false;
		}

		// Show to members only
		if ($arrRow['protected'])
		{
			// no member logged in
			if (!FE_USER_LOGGED_IN)
				return false;

			$this->import('FrontendUser', 'User');

			$arrTGroups = deserialize($arrRow['groups']);
			$arrMGroups = deserialize($this->User->groups);

			// No groups available or member not in group
			if (!is_array($arrTGroups) || !count($arrTGroups) || !is_array($arrMGroups) || !count($arrMGroups) || !count(array_intersect($arrTGroups, $arrMGroups)))
				return false;
		}

		if ($arrRow['useCondition'])
		{
			$query = $this->replaceInsertTags($arrRow['conditionQuery']);

			switch( $arrRow['conditionType'] )
			{
				case 'database':
					try
					{
						// For some reason, = is escaped in the string!
						$query = trim(str_replace('&#61;', '=', $query));
						$query = trim(str_replace('&#40;', '(', $query));
						$query = trim(str_replace('&#41;', ')', $query));
						$query = $this->Database->prepare($query)->execute()->fetchRow();
						$query = $query[0];
					}

					// Something went wrong with the database query. Use as text instead
					catch(Exception $e)
					{
						$query = $this->replaceInsertTags($arrRow['conditionQuery']);
					}
					break;
			}

			switch( $arrRow['conditionFormula'] )
			{
				case 'neq':
					if (($query != $arrRow['conditionValue']) === false)
						return false;
					break;

				case 'lt':
					if (($query < $arrRow['conditionValue']) === false)
						return false;
					break;

				case 'gt':
					if (($query > $arrRow['conditionValue']) === false)
						return false;
					break;

				case 'elt':
					if (($query <= $arrRow['conditionValue']) === false)
						return false;
					break;

				case 'egt':
					if (($query >= $arrRow['conditionValue']) === false)
						return false;
					break;

				case 'starts':
					if (strpos($query, $arrRow['conditionValue']) !== 0)
						return false;
					break;

				case 'ends':
					if (strrpos($query, $arrRow['conditionValue']) !== (strlen($query) - strlen($arrRow['conditionValue'])))
						return false;
					break;

				case 'contains':
					if (strpos($query, $arrRow['conditionValue']) === false)
						return false;
					break;

				case 'istarts':
					if (stripos($query, $arrRow['conditionValue']) !== 0)
						return false;
					break;

				case 'iends':
					if (strripos($query, $arrRow['conditionValue']) !== (strlen($query) - strlen($arrRow['conditionValue'])))
						return false;
					break;

				case 'icontains':
					if (stripos($query, $arrRow['conditionValue']) === false)
						return false;
					break;

				case 'eq':
				default:
					if (($query == $arrRow['conditionValue']) === false)
						return false;
					break;
			}
		}


		if($arrRow['timing'])
		{
			$now = time();
			$start_date = deserialize($arrRow['start_date']);
			$end_date = deserialize($arrRow['end_date']);
			$start_time = deserialize($arrRow['start_time']);
			$end_time = deserialize($arrRow['end_time']);

			$start = mktime((strlen($start_time[0]) ? $start_time[0] : date('H')), (strlen($start_time[1]) ? $start_time[1] : date('i')), 0, (strlen($start_date[1]) ? $start_date[1] : date('m')), (strlen($start_date[0]) ? $start_date[0] : date('d')), (strlen($start_date[2]) ? $start_date[2] : date('Y')));

			$end = mktime((strlen($end_time[0]) ? $end_time[0] : date('H')), (strlen($end_time[1]) ? $end_time[1] : (date('i')+1)), 59, (strlen($end_date[1]) ? $end_date[1] : date('m')), (strlen($end_date[0]) ? $end_date[0] : date('d')), (strlen($end_date[2]) ? $end_date[2] : date('Y')));

			if ($now < $start || $now > $end)
				return false;
		}


		// Limit pages
		if ($arrRow['limitpages'])
		{
			$pages = deserialize($arrRow['pages'], true);
			$allpages = $pages;

			if ($arrRow['includesubpages'])
			{
				$subpages = $this->getChildRecords($pages, 'tl_page');
				$allpages = array_merge($allpages, $subpages);
			}

			array_unique($allpages);

			global $objPage;
			if (!in_array($objPage->id, $allpages))
				return false;
		}


		// Limit languages
		if ($arrRow['limitLanguages'])
		{
			$arrLanguages = deserialize($arrRow['languages']);

			if (is_array($arrLanguages) && !in_array($GLOBALS['TL_LANGUAGE'], $arrLanguages))
				return false;
		}


		// Use the counter
		if ($arrRow['useCounter'])
		{
			if ($arrRow['counterValue'] == 0 && $arrRow['counterRepeat'])
			{
				$this->Database->prepare("UPDATE tl_inserttags SET counterValue=counterDefault WHERE id=?")
							   ->execute($arrRow['id']);
			}
			elseif ($arrRow['counterValue'] > 0)
			{
				$this->Database->prepare("UPDATE tl_inserttags SET counterValue=(counterValue-1) WHERE id=?")
							   ->execute($arrRow['id']);

				return false;
			}
		}

		return true;
	}
}

