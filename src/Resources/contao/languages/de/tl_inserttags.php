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
$GLOBALS['TL_LANG']['tl_inserttags']['tag'] = ['Platzhalter', 'Bitte geben Sie den Platzhalter ein.<br />Sie können diesen Platzhalter in einem beliebigen Inhaltselement als {{custom::platzhalter}} verwenden.'];
$GLOBALS['TL_LANG']['tl_inserttags']['replacement'] = ['Ersatz', 'Geben Sie den Inhalt ein, durch den der Platzhalter ersetzt werden soll.'];
$GLOBALS['TL_LANG']['tl_inserttags']['disableRTE'] = ['TinyMCE deaktivieren', 'Bitte klicken Sie hier wenn der TinyMCE Editor deaktiviert werden soll.'];
$GLOBALS['TL_LANG']['tl_inserttags']['description'] = ['Beschreibung', 'Sie können eine Beschreibung zu diesem Platzhalter eingeben, um Ihn von gleichen Platzhaltern unterscheiden zu können.'];
$GLOBALS['TL_LANG']['tl_inserttags']['limitpages'] = ['Seiten limitiert', 'Klicken Sie hier, wenn Sie diesen Platzhalter auf gewisse Seiten limitieren wollen.'];
$GLOBALS['TL_LANG']['tl_inserttags']['pages'] = ['Seiten', 'Wählen Sie die Seiten, auf welchen dieser Platzhalter angewendet werden soll.'];
$GLOBALS['TL_LANG']['tl_inserttags']['includesubpages'] = ['Auf Unterseiten anwenden', 'Klicken Sie hier, wenn dieser Platzhalter auch auf Unterseiten der Auswahl angewendet werden soll.'];
$GLOBALS['TL_LANG']['tl_inserttags']['protected'] = ['Platzhalter schützen', 'Den Platzhalter nur bestimmten Gruppen anzeigen.'];
$GLOBALS['TL_LANG']['tl_inserttags']['groups'] = ['Erlaubte Mitgliedergruppen', 'Diese Gruppen können den Platzhalter sehen.'];

// Buttons
$GLOBALS['TL_LANG']['tl_inserttags']['new'] = ['Neuen Platzhalter', 'Einen neuen Platzhalter erstellen'];
$GLOBALS['TL_LANG']['tl_inserttags']['edit'] = ['Platzhalter bearbeiten', 'Platzhalter ID %s bearbeiten'];
$GLOBALS['TL_LANG']['tl_inserttags']['copy'] = ['Platzhalter duplizieren', 'Platzhalter ID %s duplizieren'];
$GLOBALS['TL_LANG']['tl_inserttags']['cut'] = ['Platzhalter verschieben', 'Platzhalter ID %s verschieben'];
$GLOBALS['TL_LANG']['tl_inserttags']['delete'] = ['Platzhalter löschen', 'Platzhalter ID %s löschen'];
$GLOBALS['TL_LANG']['tl_inserttags']['show'] = ['Platzhalterdetails', 'Die Details des Platzhalters ID %s anzeigen'];
$GLOBALS['TL_LANG']['tl_inserttags']['pasteafter'] = ['Danach einfügen', 'Nach dem Platzhalter ID %s einfügen'];
$GLOBALS['TL_LANG']['tl_inserttags']['pasteinto'] = ['Am Anfang einfügen', 'Am Anfang einfügen'];

// Legends
$GLOBALS['TL_LANG']['tl_inserttags']['tag_legend'] = 'Platzhalter & Ersatztext';
$GLOBALS['TL_LANG']['tl_inserttags']['limit_legend'] = 'Limitierungen';
