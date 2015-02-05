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
 * Table tl_inserttags
 */
$GLOBALS['TL_DCA']['tl_inserttags'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'enableVersioning'				=> true,
		'label'							=> &$GLOBALS['TL_LANG']['MOD']['inserttags'][0],
		'onload_callback'				=> array
		(
			array('tl_inserttags', 'disableRTE'),
		),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'						=> 5,
			'fields'					=> array('sorting'),
			'flag'						=> 1,
			'panelLayout'				=> 'filter;search,limit',
			'paste_button_callback'		=> array('tl_inserttags', 'pasteTag'),
            'icon'						=> 'system/modules/inserttags/html/icon.gif',

		),
		'label' => array
		(
			'fields'					=> array('tag'),
			'format'					=> '%s',
			'label_callback'			=> array('tl_inserttags', 'labelCallback'),
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'					=> 'act=select',
				'class'					=> 'header_edit_all',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_inserttags']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'copy' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_inserttags']['copy'],
				'href'					=> 'act=paste&mode=copy',
				'icon'					=> 'copy.gif',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"',
			),
			'cut' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_inserttags']['cut'],
				'href'					=> 'act=paste&mode=cut',
				'icon'					=> 'cut.gif',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"',
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_inserttags']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_inserttags']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'					=> array('timing', 'useCondition', 'limitpages', 'limitLanguages', 'useCounter', 'protected'),
		'default'						=> '{tag_legend},tag,description,replacement,disableRTE;{limit_legend},limitpages,limitLanguages,guests,protected;{advanced_legend:hide},timing,useCondition,useCounter;{expert_legend:hide},mode,cacheOutput',
	),

	// Subpalettes
	'subpalettes' => array
	(
		'timing'						=> 'start_date,start_time,end_date,end_time',
		'limitpages'					=> 'pages,includesubpages',
		'limitLanguages'				=> 'languages',
		'useCondition'					=> 'conditionType,conditionFormula,conditionQuery,conditionValue',
		'useCounter'					=> 'counterValue,counterDefault,counterRepeat',
		'protected'						=> 'groups',
	),

	// Fields
	'fields' => array
	(
		'tag' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['tag'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'nospace'=>true, 'tl_class'=>'w50')
		),
		'replacement' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['replacement'],
			'inputType'					=> 'textarea',
			'exclude'					=> true,
			'search'					=> true,
			'eval'						=> array('rte'=>'tinyMCE', 'allowHtml'=>true, 'tl_class'=>'clr'),
		),
		'disableRTE' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['disableRTE'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('submitOnChange'=>true),
		),
		'description' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['description'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'search'					=> true,
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'timing' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['timing'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('submitOnChange'=>true, 'tl_class'=>'clr'),
		),
		'start_date' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['start_date'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('multiple'=>true, 'size'=>3, 'rgxp'=>'digit', 'maxlength'=>4, 'tl_class'=>'w50'),
		),
		'start_time' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['start_time'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('multiple'=>true, 'size'=>2, 'rgxp'=>'digit', 'maxlength'=>2, 'tl_class'=>'w50'),
		),
		'end_date' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['end_date'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('multiple'=>true, 'size'=>3, 'rgxp'=>'digit', 'maxlength'=>4, 'tl_class'=>'w50'),
		),
		'end_time' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['end_time'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('multiple'=>true, 'size'=>2, 'rgxp'=>'digit', 'maxlength'=>2, 'tl_class'=>'w50'),
		),
		'limitpages' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['limitpages'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('submitOnChange'=>true, 'tl_class'=>'clr'),
		),
		'pages' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['pages'],
			'inputType'					=> 'pageTree',
			'exclude'					=> true,
			'eval'						=> array('fieldType'=>'checkbox', 'multiple'=>true),
		),
		'includesubpages' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['includesubpages'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('tl_class'=>'clr'),
		),
		'limitLanguages' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['limitLanguages'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('submitOnChange'=>true, 'tl_class'=>'clr'),
		),
		'languages' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['languages'],
			'inputType'					=> 'select',
			'exclude'					=> true,
			'options'					=> $this->getLanguages(),
			'eval'						=> array('multiple'=>true, 'size'=>'10'),
		),
		'mode' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['mode'],
			'default'                   			=> 'FE',
			'inputType'					=> 'radio',
			'exclude'					=> true,
			'filter'					=> true,
			'options'					=> array('FE', 'BE'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_inserttags'],
		),
		'cacheOutput' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['cacheOutput'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
		),
		'useCondition' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['useCondition'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('submitOnChange'=>true, 'tl_class'=>'clr'),
		),
		'conditionType' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['conditionType'],
			'inputType'					=> 'select',
			'options'					=> array('text', 'database'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_inserttags'],
			'default'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50'),
		),
		'conditionQuery' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['conditionQuery'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('maxlength'=>255, 'decodeEntities'=>true, 'tl_class'=>'long'),
		),
		'conditionFormula' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['conditionFormula'],
			'inputType'					=> 'select',
			'options'					=> array('eq', 'neq', 'lt', 'gt', 'elt', 'egt', 'starts', 'ends', 'contains', 'istarts', 'iends', 'icontains'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_inserttags'],
			'exclude'					=> true,
			'eval'						=> array('tl_class'=>'w50'),
		),
		'conditionValue' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['conditionValue'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'long'),
		),
		'useCounter' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['useCounter'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('submitOnChange'=>true, 'tl_class'=>'clr'),
		),
		'counterValue' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['counterValue'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('rgxp'=>'digit', 'maxlength'=>5, 'mandatory'=>true, 'tl_class'=>'w50'),
		),
		'counterDefault' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['counterDefault'],
			'inputType'					=> 'text',
			'exclude'					=> true,
			'eval'						=> array('rgxp'=>'digit', 'maxlength'=>5, 'mandatory'=>true, 'tl_class'=>'w50'),
		),
		'counterRepeat' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['counterRepeat'],
			'inputType'					=> 'checkbox',
			'exclude'					=> true,
			'filter'					=> true,
			'eval'						=> array('tl_class'=>'clr'),
		),
		'protected' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['protected'],
			'exclude'					=> true,
			'filter'					=> true,
			'inputType'					=> 'checkbox',
			'eval'						=> array('submitOnChange'=>true),
		),
		'groups' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['groups'],
			'exclude'					=> true,
			'inputType'					=> 'checkbox',
			'foreignKey'				=> 'tl_member_group.name',
			'eval'						=> array('multiple'=>true),
		),
		'guests' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_inserttags']['guests'],
			'exclude'					=> true,
			'filter'					=> true,
			'inputType'					=> 'checkbox',
		),
	)
);


class tl_inserttags extends Backend
{

	public function labelCallback($arrRow)
	{
		$label = $arrRow['tag'];

		if ($arrRow['useCondition'] && (strlen($arrRow['conditionQuery']) && strlen($arrRow['conditionValue'])))
		{
			$label .= '<span style="color:#b3b3b3; padding-left:10px;">'.$arrRow['conditionQuery'].' '.$this->operatorForFormula($arrRow['conditionFormula']).' '.$arrRow['conditionValue'].'</span>';
		}

		if ($arrRow['timing'])
		{
			$start_date = deserialize($arrRow['start_date']);
			$start_time = deserialize($arrRow['start_time']);
			$end_date = deserialize($arrRow['end_date']);
			$end_time = deserialize($arrRow['end_time']);

			$start = str_replace(array('Y', 'm', 'd', 'H', 'i'), array((strlen($start_date[2]) ? '<span style="color:#FF0000">'.$start_date[2].'</span>' : date('Y')), (strlen($start_date[1]) ? '<span style="color:#FF0000">'.$start_date[1].'</span>' : date('m')), (strlen($start_date[0]) ? '<span style="color:#FF0000">'.$start_date[0].'</span>' : date('d')), (strlen($start_time[0]) ? '<span style="color:#FF0000">'.$start_time[0].'</span>' : date('H')), (strlen($start_time[1]) ? '<span style="color:#FF0000">'.$start_time[1].'</span>' : date('i'))), $GLOBALS['TL_CONFIG']['datimFormat']);

			$end = str_replace(array('Y', 'm', 'd', 'H', 'i'), array((strlen($end_date[2]) ? '<span style="color:#FF0000">'.$end_date[2].'</span>' : date('Y')), (strlen($end_date[1]) ? '<span style="color:#FF0000">'.$end_date[1].'</span>' : date('m')), (strlen($end_date[0]) ? '<span style="color:#FF0000">'.$end_date[0].'</span>' : date('d')), (strlen($end_time[0]) ? '<span style="color:#FF0000">'.$end_time[0].'</span>' : date('H')), (strlen($end_time[1]) ? '<span style="color:#FF0000">'.$end_time[1].'</span>' : date('i'))), $GLOBALS['TL_CONFIG']['datimFormat']);

			$label .= sprintf('<span style="color:#b3b3b3; padding-left:10px;">[%s - %s]</span>', $start, $end);
		}

		if (strlen($arrRow['description']))
		{
			$label .= '<span style="color:#b3b3b3; padding-left:10px;">('.$arrRow['description'].')</span>';
		}

		return '<img width="18" height="18" style="margin-left: 0px;" alt="" src="system/modules/inserttags/html/page.gif"/> ' . $label;
	}


	/**
	 * Return the paste button
	 * @param object
	 * @param array
	 * @param string
	 * @param boolean
	 * @param array
	 * @return string
	 */
	public function pasteTag(DataContainer $dc, $row, $table, $cr, $arrClipboard=false)
	{
		$this->import('BackendUser', 'User');

		$imagePasteAfter = $this->generateImage('pasteafter.gif', sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteafter'][1], $row['id']));
		$imagePasteInto = $this->generateImage('pasteinto.gif', sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteinto'][1], $row['id']));

		if ($row['id'] == 0)
		{
			return $cr ? $this->generateImage('pasteinto_.gif').' ' : '<a href="'.$this->addToUrl('act='.$arrClipboard['mode'].'&mode=2&pid='.$row['id'].'&id='.$arrClipboard['id']).'" title="'.specialchars(sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteinto'][1], $row['id'])).'" onclick="Backend.getScrollOffset();">'.$imagePasteInto.'</a> ';
		}

		return (($arrClipboard['mode'] == 'cut' && $arrClipboard['id'] == $row['id']) || $cr) ? $this->generateImage('pasteafter_.gif').' ' : '<a href="'.$this->addToUrl('act='.$arrClipboard['mode'].'&mode=1&pid='.$row['id'].'&id='.$arrClipboard['id']).'" title="'.specialchars(sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteafter'][1], $row['id'])).'" onclick="Backend.getScrollOffset();">'.$imagePasteAfter.'</a> ';
	}


	/**
	 * Find PHP operator for string operator
	 * @param  string
	 * @return string
	 */
	public function operatorForFormula($formula)
	{
		switch( $formula )
		{
			case 'eq':
				return '=';
				break;

			case 'neq':
				return '!=';
				break;

			case 'lt':
				return '<';
				break;

			case 'gt':
				return '>';
				break;

			case 'elt':
				return '<=';
				break;

			case 'egt':
				return '>=';
				break;
		}

		return $GLOBALS['TL_LANG']['tl_inserttags'][$formula] ? $GLOBALS['TL_LANG']['tl_inserttags'][$formula] : $formula;
	}


	/**
	 * Disable rich text editor if checkbox is set.
	 *
	 * @access public
	 * @param mixed $dc
	 * @return void
	 */
	public function disableRTE($dc)
	{
		if ($this->Input->get('act') == 'edit')
		{
			$objRow = $this->Database->prepare("SELECT * FROM tl_inserttags WHERE id=?")
									 ->execute($dc->id);

			if ($objRow->disableRTE)
			{
				unset($GLOBALS['TL_DCA']['tl_inserttags']['fields']['replacement']['eval']['rte']);
			}
		}
	}
}

