-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the Contao    *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


--
-- Table `tl_inserttags`
--

CREATE TABLE `tl_inserttags` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `type` varchar(255) NOT NULL default '',
  `tag` varchar(255) NOT NULL default '',
  `replacement` text NULL,
  `disableRTE` char(1) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `timing` char(1) NOT NULL default '',
  `start_date` varchar(255) NOT NULL default '',
  `start_time` varchar(255) NOT NULL default '',
  `end_date` varchar(255) NOT NULL default '',
  `end_time` varchar(255) NOT NULL default '',
  `limitpages` char(1) NOT NULL default '',
  `pages` blob NULL,
  `includesubpages` char(1) NOT NULL default '',
  `limitLanguages` char(1) NOT NULL default '',
  `languages` blob NULL,
  `mode` varchar(2) NOT NULL default '',
  `cacheOutput` char(1) NOT NULL default '',
  `useCondition` char(1) NOT NULL default '',
  `conditionType` varchar(255) NOT NULL default '',
  `conditionQuery` varchar(255) NOT NULL default '',
  `conditionFormula` varchar(255) NOT NULL default '',
  `conditionValue` varchar(255) NOT NULL default '',
  `useCounter` char(1) NOT NULL default '',
  `counterDefault` int(5) NOT NULL default '0',
  `counterValue` int(5) NOT NULL default '0',
  `counterRepeat` char(1) NOT NULL default '',
  `protected` char(1) NOT NULL default '',
  `groups` blob NULL,
  `guests` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

