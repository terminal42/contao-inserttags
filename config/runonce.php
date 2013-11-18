<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *
 * PHP version 5
 * @copyright  terminal42 gmbh 2013
 * @author     Andreas Schempp <andreas.schempp@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


class InsertTagsRunonce extends Controller
{

	/**
	 * Initialize the object
	 */
	public function __construct()
	{
		parent::__construct();

		// Fix potential Exception on line 0 because of __destruct method (see http://dev.contao.org/issues/2236)
		$this->import((TL_MODE=='BE' ? 'BackendUser' : 'FrontendUser'), 'User');
		$this->import('Database');
	}


	/**
	 * Execute all runonce files in module config directories
	 */
	public function run()
	{
        if ($this->Database->tableExists('tl_inserttags')
            && $this->Database->fieldExists('backend', 'tl_inserttags')
            && !$this->Database->fieldExists('mode', 'tl_inserttags')
        ) {
            $this->Database->query("ALTER TABLE tl_inserttags CHANGE COLUMN backend mode varchar(2) NOT NULL default ''");
            $this->Database->query("UPDATE tl_inserttags SET mode='BE' WHERE mode=''");
            $this->Database->query("UPDATE tl_inserttags SET mode='FE' WHERE mode='1'");
        }
	}
}


/**
 * Instantiate controller
 */
$objInsertTagsRunonce = new InsertTagsRunonce();
$objInsertTagsRunonce->run();
