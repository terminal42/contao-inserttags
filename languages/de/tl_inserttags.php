<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_inserttags']['tag']				= array('Platzhalter', 'Bitte geben Sie den Platzhalter ein.<br />Sie können diesen Platzhalter in einem beliebigen Inhaltselement als {{custom::platzhalter}} verwenden.');
$GLOBALS['TL_LANG']['tl_inserttags']['replacement']		= array('Ersatz', 'Geben Sie den Inhalt ein, durch den der Platzhalter ersetzt werden soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['disableRTE']		= array('TinyMCE deaktivieren', 'Bitte klicken Sie hier wenn der TinyMCE Editor deaktiviert werden soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['description']		= array('Beschreibung', 'Sie können eine Beschreibung zu diesem Platzhalter eingeben, um Ihn von gleichen Platzhaltern unterscheiden zu können.');
$GLOBALS['TL_LANG']['tl_inserttags']['timing']			= array('Zeitsteuerung', 'Sie können diesen Platzhalter zeitgesteuert einsetzten. Wenn Sie mehrere gleiche Platzhalter mit verschiedenen Zeiteinstellungen haben, können Sie so eine zeitgesteuerte Darstellung realisieren.');
$GLOBALS['TL_LANG']['tl_inserttags']['start_date']		= array('Startdatum', 'Tragen Sie das Startdatum in die Felder ein (Tag / Monat / Jahr).<br />Sie können einzelne Felder leer lassen, um diesen Wert zu ignorieren.');
$GLOBALS['TL_LANG']['tl_inserttags']['start_time']		= array('Startzeit', 'Tragen Sie die Startzeit in die Felder ein (Stunde / Minute).');
$GLOBALS['TL_LANG']['tl_inserttags']['end_date']		= array('Enddatum', 'Tragen Sie das Enddatum in die Felder ein (Tag / Monat / Jahr).');
$GLOBALS['TL_LANG']['tl_inserttags']['end_time']		= array('Endzeit', 'Tragen Sie die Endzeit in die Felder ein (Stunde / Minute).');
$GLOBALS['TL_LANG']['tl_inserttags']['backend']			= array('Platzhalter anwenden im', 'Bitte wählen Sie ob dieser Platzhalter im Front- oder Backend angewendet werden soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['cacheOutput']		= array('Ausgabe zwischenspeichern', 'Klicken Sie hier, wenn dieser Platzhalter vor dem TYPOlight Cache einer Seite angewendet werden soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['useCondition']	= array('Bedingung', 'Klicken Sie hier, wenn Sie dieses Feld nur unter gewissen Bedingungen verwenden wollen.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionType']	= array('Abfrage-Typ', 'Wenn Sie "Datenbank" wählen, geben Sie eine SQL Abfrage in das Feld ein. Sie können innerhalb der Abfrage wiederum Platzhalter verwenden.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionQuery']	= array('Abfrage', 'Geben Sie die Abfrage ein. Dies kann z.B. ein TYPOlight Insert-Tag sein.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionFormula']= array('Formel', 'Wählen Sie eine Formel für den Vergleich zwischen Abfrage und Wert.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionValue']	= array('Wert', 'Geben Sie den Wert ein, dem die Abfragen entsprechen soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['limitpages']		= array('Seiten limitiert', 'Klicken Sie hier, wenn Sie diesen Platzhalter auf gewisse Seiten limitieren wollen.');
$GLOBALS['TL_LANG']['tl_inserttags']['pages']			= array('Seiten', 'Wählen Sie die Seiten, auf welchen dieser Platzhalter angewendet werden soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['includesubpages']	= array('Auf Unterseiten anwenden', 'Klicken Sie hier, wenn dieser Platzhalter auch auf Unterseiten der Auswahl angewendet werden soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['limitLanguages']	= array('Sprachen limitieren', 'Klicken Sie hier, wenn Sie diesen Platzhalter auf gewisse Sprachen limitieren wollen.');
$GLOBALS['TL_LANG']['tl_inserttags']['languages']		= array('Sprachen', 'Wählen Sie die Sprachen für die dieser Platzhalter angewendet werden soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['useCounter']		= array('Zähler benutzen', 'Fügen Sie einen Zähler hinzu, um den Platzhalter erst anzuzeigen wenn der Zähler auf 0 ist.');
$GLOBALS['TL_LANG']['tl_inserttags']['counterValue']	= array('Aktueller Wert', 'Dies ist der aktuelle Wert des Zählers. Diese Zahl wird bei jedem Einsatz des Platzhalters um 1 verkleinert.');
$GLOBALS['TL_LANG']['tl_inserttags']['counterDefault']	= array('Standardwert', 'Geben Sie den Standardwert für den Zähler ein, auf den der "Aktuelle Wert" zurückgestellt wird (falls Sie die Wiederholung aktivieren).');
$GLOBALS['TL_LANG']['tl_inserttags']['counterRepeat']	= array('Zähler wiederholen', 'Wählen Sie hier wenn der Zähler nach ablauf wieder auf den Standardwert zurückgesetzt werden soll.');
$GLOBALS['TL_LANG']['tl_inserttags']['protected']		= array('Platzhalter schützen', 'Den Platzhalter nur bestimmten Gruppen anzeigen.');
$GLOBALS['TL_LANG']['tl_inserttags']['groups']			= array('Erlaubte Mitgliedergruppen', 'Diese Gruppen können den Platzhalter sehen.');
$GLOBALS['TL_LANG']['tl_inserttags']['guests']			= array('Nur Gästen anzeigen', 'Den Platzhalter verstecken sobald ein Mitglied angemeldet ist.');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_inserttags']['eq']				= 'gleich';
$GLOBALS['TL_LANG']['tl_inserttags']['neq']				= 'ungleich';
$GLOBALS['TL_LANG']['tl_inserttags']['lt']				= 'kleiner als';
$GLOBALS['TL_LANG']['tl_inserttags']['gt']				= 'grösser als';
$GLOBALS['TL_LANG']['tl_inserttags']['elt']				= 'kleiner gleich';
$GLOBALS['TL_LANG']['tl_inserttags']['egt']				= 'grösser gleich';
$GLOBALS['TL_LANG']['tl_inserttags']['starts']			= 'beginnt mit (Gross-/Kleinschreibung beachten)';
$GLOBALS['TL_LANG']['tl_inserttags']['ends']			= 'endet mit (Gross-/Kleinschreibung beachten)';
$GLOBALS['TL_LANG']['tl_inserttags']['contains']		= 'enthält (Gross-/Kleinschreibung beachten)';
$GLOBALS['TL_LANG']['tl_inserttags']['istarts']			= 'beginnt mit (Gross-/Kleinschreibung ignorieren)';
$GLOBALS['TL_LANG']['tl_inserttags']['iends']			= 'endet mit (Gross-/Kleinschreibung ignorieren)';
$GLOBALS['TL_LANG']['tl_inserttags']['icontains']		= 'enthält (Gross-/Kleinschreibung ignorieren)';
$GLOBALS['TL_LANG']['tl_inserttags']['fe']				= 'Frontend';
$GLOBALS['TL_LANG']['tl_inserttags']['be']				= 'Backend';
$GLOBALS['TL_LANG']['tl_inserttags']['text']			= 'Text';
$GLOBALS['TL_LANG']['tl_inserttags']['database']		= 'Datenbank';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_inserttags']['new']      		= array('Neuen Platzhalter', 'Einen neuen Platzhalter erstellen');
$GLOBALS['TL_LANG']['tl_inserttags']['edit']     		= array('Platzhalter bearbeiten', 'Platzhalter ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_inserttags']['copy']     		= array('Platzhalter duplizieren', 'Platzhalter ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_inserttags']['cut']        		= array('Platzhalter verschieben', 'Platzhalter ID %s verschieben');
$GLOBALS['TL_LANG']['tl_inserttags']['delete']   		= array('Platzhalter löschen', 'Platzhalter ID %s löschen');
$GLOBALS['TL_LANG']['tl_inserttags']['show']     		= array('Platzhalterdetails', 'Die Details des Platzhalters ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_inserttags']['pasteafter'] 		= array('Danach einfügen', 'Nach dem Platzhalter ID %s einfügen');
$GLOBALS['TL_LANG']['tl_inserttags']['pasteinto']  		= array('Am Anfang einfügen', 'Am Anfang einfügen');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_inserttags']['tag_legend']			= 'Platzhalter & Ersatztext';
$GLOBALS['TL_LANG']['tl_inserttags']['limit_legend']		= 'Limitierungen';
$GLOBALS['TL_LANG']['tl_inserttags']['advanced_legend']		= 'Erweiterte Funktionen';
$GLOBALS['TL_LANG']['tl_inserttags']['expert_legend']		= 'Experten-Einstellungen';

