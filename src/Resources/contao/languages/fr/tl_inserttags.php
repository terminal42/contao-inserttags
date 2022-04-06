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
$GLOBALS['TL_LANG']['tl_inserttags']['tag'] = ['Insert-Tag', 'Saisissez votre Insert-tag.<br />Il sera possible d\'utiliser ce code en saisissant {{custom::votre-tag}}'];
$GLOBALS['TL_LANG']['tl_inserttags']['replacement'] = ['Affichage', 'Saisissez le texte qui sera affiché à la place de l\'insert-tag.'];
$GLOBALS['TL_LANG']['tl_inserttags']['disableRTE'] = ['Désactiver TinyMCE', 'Cochez la case pour désactiver l\'éditeur TinyMCE.'];
$GLOBALS['TL_LANG']['tl_inserttags']['description'] = ['Description', 'Saisissez une description pour ce tag afin de vous aider à les différencier.'];
$GLOBALS['TL_LANG']['tl_inserttags']['cacheOutput'] = ['Laisser le tag hors du cache', 'Cochez la case si vous souhaitez que le tag soit appliqué avant que Contao ne mette en cache la page.'];
$GLOBALS['TL_LANG']['tl_inserttags']['limitpages'] = ['Limiter aux pages', 'Cochez cette case si vous souhaitez que votre tag soit limité à certaines pages.'];
$GLOBALS['TL_LANG']['tl_inserttags']['pages'] = ['Pages', 'Sélectionnez les pages concernées par le tag courant.'];
$GLOBALS['TL_LANG']['tl_inserttags']['includesubpages'] = ['Inclure des sous-pages', 'Cochez cette case si vous souhaitez que le tag soit appliqué aux sous-pages également.'];
$GLOBALS['TL_LANG']['tl_inserttags']['protected'] = ['Protéger le tag', 'Cochez pour ne permettre qu\'à certains groupes de membre.'];
$GLOBALS['TL_LANG']['tl_inserttags']['groups'] = ['Groupes de membres autorisés', 'Les groupes cochés seront autorisés à voir le tag.'];
$GLOBALS['TL_LANG']['tl_inserttags']['guests'] = ['Ne montrer qu\'aux visiteurs', 'Cochez la case pour faire disparaître le tag à la vue des personnes connectées.'];

// Buttons
$GLOBALS['TL_LANG']['tl_inserttags']['new'] = ['Créer un tag', 'Créer un nouveau tag'];
$GLOBALS['TL_LANG']['tl_inserttags']['edit'] = ['Editer le tag', 'Editer le tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['copy'] = ['Dupliquer le tag', 'Dupliquer le tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['cut'] = ['Déplacer le tag', 'Déplacer le tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['delete'] = ['Supprimer le tag', 'Supprimer le tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['show'] = ['Détails du tag', 'Détails du tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['pasteafter'] = ['Copier après', 'Copier après le tag ID %s'];
$GLOBALS['TL_LANG']['tl_inserttags']['pasteinto'] = ['Copier au début', 'Copier au début'];

// Legends
$GLOBALS['TL_LANG']['tl_inserttags']['tag_legend'] = 'Tag & Affichage';
$GLOBALS['TL_LANG']['tl_inserttags']['limit_legend'] = 'Limites';
$GLOBALS['TL_LANG']['tl_inserttags']['expert_legend'] = 'Options supplémentaires (expert)';
