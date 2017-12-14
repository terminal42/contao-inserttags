<?php

/**
 * inserttags extension for Contao Open Source CMS
 *
 * @copyright   Copyright (c) 2008-2014, terminal42 gmbh
 * @author         terminal42 gmbh <info@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @link       http://github.com/terminal42/contao-inserttags
 */


class InsertTagsExt extends Frontend
{
    /**
     * Current object instance (Singleton)
     * @var self
     */
    private static $objInstance;

    /**
     * Prevent cloning of the object (Singleton)
     */
    final private function __clone() {}

    /**
     * Return the current object instance (Singleton)
     *
     * @return object
     */
    public static function getInstance()
    {
        if (!is_object(self::$objInstance)) {
            self::$objInstance = new InsertTagsExt();
        }

        return self::$objInstance;
    }

    /**
     * Replace tags in outputFrontendTemplate and outputBackendTemplate functions.
     *
     * @param string $strBuffer
     *
     * @return string
     */
    public function replaceCachedTags($strBuffer)
    {
        if ('install.php' === basename($_SERVER['REQUEST_URI'])
            || !\Database::getInstance()->tableExists('tl_inserttags')
            || !\Database::getInstance()->fieldExists('sorting', 'tl_inserttags')
        ) {
            return $strBuffer;
        }

        $tags = preg_split('/{{(custom::[^}]+)}}/', $strBuffer, -1, PREG_SPLIT_DELIM_CAPTURE);

        $strBuffer = '';

        for ($_rit = 0, $total = count($tags); $_rit < $total; $_rit = $_rit + 2) {
            $strBuffer .= $tags[$_rit];
            $strTag = $tags[$_rit + 1];

            // Skip empty tags
            if (!strlen($strTag)) {
                continue;
            }

            $cacheOutput = 'FE' === TL_MODE ? "AND cacheOutput='1'" : "";
            $arrTag = explode('::', $strTag);

            $objTags = \Database::getInstance()
                ->prepare("SELECT * FROM tl_inserttags WHERE tag=? AND mode=? $cacheOutput ORDER BY sorting")
                ->execute($arrTag[1], TL_MODE)
            ;

            while ($arrRow = $objTags->fetchAssoc()) {
                if ($this->validateTag($arrRow)) {
                    $GLOBALS['INSERTAGS'][$strTag]++;
                    $strBuffer .= \StringUtil::parseSimpleTokens(
                        \Controller::replaceInsertTags($arrRow['replacement'], false),
                        $arrTag
                    );
                    break;
                }
            }

            $strBuffer .= '{{' . $strTag . '}}';
        }

        return $strBuffer;
    }

    /**
     * Replace tags for replaceInsertTags function.
     * This currently only works in frontend (backend is not cached anyway...).
     *
     * @param string $strTag
     *
     * @return bool|string
     */
    public function replaceDynamicTags($strTag)
    {
        if ($GLOBALS['INSERTAGS'][$strTag] > 50) {
            \System::log('WARNING: InsertTag "' . $strTag . '" caused an endless loop!', __METHOD__, TL_ERROR);

            return '';
        }

        $arrTag = explode('::', $strTag);

        if ($arrTag[0] !== 'custom') {
            return false;
        }

        $objTags = \Database::getInstance()
            ->prepare("SELECT * FROM tl_inserttags WHERE tag=? AND mode='FE' AND cacheOutput='' ORDER BY sorting")
            ->execute($arrTag[1])
        ;

        while ($arrRow = $objTags->fetchAssoc()) {
            if ($this->validateTag($arrRow)) {
                $GLOBALS['INSERTAGS'][$strTag]++;

                return \StringUtil::parseSimpleTokens(
                    \Controller::replaceInsertTags($arrRow['replacement'], false),
                    $arrTag
                );
            }
        }

        return '';
    }

    /**
     * Check if a tag should be applied (rules, date/time, pages).
     *
     * @param array $arrRow
     *
     * @return bool
     */
    private function validateTag($arrRow)
    {
        if ($GLOBALS['TL_CONFIG']['disableInsertTags']) {
            return false;
        }

        // Show to guests only, but member logged in
        if ($arrRow['guests'] && true === FE_USER_LOGGED_IN) {
            return false;
        }

        // Show to members only
        if ($arrRow['protected']) {

            // no member logged in
            if (true !== FE_USER_LOGGED_IN) {
                return false;
            }

            $arrTGroups = deserialize($arrRow['groups']);
            $arrMGroups = deserialize(\FrontendUser::getInstance()->groups);

            // No groups available or member not in group
            if (!is_array($arrTGroups)
                || !count($arrTGroups)
                || !is_array($arrMGroups)
                || !count($arrMGroups)
                || !count(array_intersect($arrTGroups, $arrMGroups))
            ) {
                return false;
            }
        }

        if ($arrRow['useCondition']) {
            $query = \Controller::replaceInsertTags($arrRow['conditionQuery'], false);

            switch ($arrRow['conditionType']) {
                case 'database':
                    try {
                        $query = \Database::getInstance()->execute($query)->fetchRow();
                        $query = $query[0];
                    } catch (Exception $e) {
                        // Something went wrong with the database query. Use as text instead
                        $query = \Controller::replaceInsertTags($arrRow['conditionQuery'], false);
                    }
                    break;
            }

            switch ($arrRow['conditionFormula']) {
                case 'neq':
                    if (($query != $arrRow['conditionValue']) === false) {
                        return false;
                    }
                    break;

                case 'lt':
                    if (($query < $arrRow['conditionValue']) === false) {
                        return false;
                    }
                    break;

                case 'gt':
                    if (($query > $arrRow['conditionValue']) === false) {
                        return false;
                    }
                    break;

                case 'elt':
                    if (($query <= $arrRow['conditionValue']) === false) {
                        return false;
                    }
                    break;

                case 'egt':
                    if (($query >= $arrRow['conditionValue']) === false) {
                        return false;
                    }
                    break;

                case 'starts':
                    if (strpos($query, $arrRow['conditionValue']) !== 0) {
                        return false;
                    }
                    break;

                case 'ends':
                    if (strrpos($query, $arrRow['conditionValue']) !== (strlen($query) - strlen($arrRow['conditionValue']))) {
                        return false;
                    }
                    break;

                case 'contains':
                    if (strpos($query, $arrRow['conditionValue']) === false) {
                        return false;
                    }
                    break;

                case 'istarts':
                    if (stripos($query, $arrRow['conditionValue']) !== 0) {
                        return false;
                    }
                    break;

                case 'iends':
                    if (strripos($query, $arrRow['conditionValue']) !== (strlen($query) - strlen($arrRow['conditionValue']))) {
                        return false;
                    }
                    break;

                case 'icontains':
                    if (stripos($query, $arrRow['conditionValue']) === false) {
                        return false;
                    }
                    break;

                case 'eq':
                default:
                    if (($query == $arrRow['conditionValue']) === false) {
                        return false;
                    }
                    break;
            }
        }


        if ($arrRow['timing']) {
            $now = time();
            $start_date = deserialize($arrRow['start_date']);
            $end_date = deserialize($arrRow['end_date']);
            $start_time = deserialize($arrRow['start_time']);
            $end_time = deserialize($arrRow['end_time']);

            $start = mktime(
                (strlen($start_time[0]) ? $start_time[0] : date('H')),
                (strlen($start_time[1]) ? $start_time[1] : date('i')),
                0,
                (strlen($start_date[1]) ? $start_date[1] : date('m')),
                (strlen($start_date[0]) ? $start_date[0] : date('d')),
                (strlen($start_date[2]) ? $start_date[2] : date('Y'))
            );

            $end = mktime(
                (strlen($end_time[0]) ? $end_time[0] : date('H')),
                (strlen($end_time[1]) ? $end_time[1] : (date('i') + 1)),
                59,
                (strlen($end_date[1]) ? $end_date[1] : date('m')),
                (strlen($end_date[0]) ? $end_date[0] : date('d')),
                (strlen($end_date[2]) ? $end_date[2] : date('Y'))
            );

            if ($now < $start || $now > $end) {
                return false;
            }
        }

        // Limit pages
        if ($arrRow['limitpages']) {
            $pages = deserialize($arrRow['pages'], true);
            $allpages = $pages;

            if ($arrRow['includesubpages']) {
                $subpages = \Database::getInstance()->getChildRecords($pages, 'tl_page');
                $allpages = array_merge($allpages, $subpages);
            }

            array_unique($allpages);

            global $objPage;
            if (!in_array($objPage->id, $allpages)) {
                return false;
            }
        }

        // Limit languages
        if ($arrRow['limitLanguages']) {
            $arrLanguages = deserialize($arrRow['languages']);

            if (is_array($arrLanguages) && !in_array($GLOBALS['TL_LANGUAGE'], $arrLanguages)) {
                return false;
            }
        }

        // Use the counter
        if ($arrRow['useCounter']) {
            if ($arrRow['counterValue'] == 0 && $arrRow['counterRepeat']) {
                \Database::getInstance()
                    ->prepare("UPDATE tl_inserttags SET counterValue=counterDefault WHERE id=?")
                    ->execute($arrRow['id'])
                ;
            } elseif ($arrRow['counterValue'] > 0) {
                \Database::getInstance()
                    ->prepare("UPDATE tl_inserttags SET counterValue=(counterValue-1) WHERE id=?")
                    ->execute($arrRow['id'])
                ;

                return false;
            }
        }

        return true;
    }
}

