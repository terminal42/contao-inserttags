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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_inserttags']['tag']				= array('Insert-Tag', 'Saisissez votre Insert-tag.<br />Il sera possible d\'utiliser ce code en saisissant {{custom::votre-tag}}');
$GLOBALS['TL_LANG']['tl_inserttags']['replacement']		= array('Affichage', 'Saisissez le texte qui sera affiché à la place de l\'insert-tag.');
$GLOBALS['TL_LANG']['tl_inserttags']['disableRTE']		= array('Désactiver TinyMCE', 'Cochez la case pour désactiver l\'éditeur TinyMCE.');
$GLOBALS['TL_LANG']['tl_inserttags']['description']		= array('Description', 'Saisissez une description pour ce tag afin de vous aider à les différencier.');
$GLOBALS['TL_LANG']['tl_inserttags']['timing']			= array('Limiter la durée d\'affichage', 'Cochez la case pour faire en sorte que le tag ne fonctionne que pendant une période donnée');
$GLOBALS['TL_LANG']['tl_inserttags']['start_date']		= array('Date de départ', 'Saisissez la date de début d\'affichage du tag (jour / mois / année).<br />Il est possible d\'ignorer les champs (comme l\'année).');
$GLOBALS['TL_LANG']['tl_inserttags']['start_time']		= array('Heure de départ', 'Saisissez l\'heure de début d\'affichage du tag (Heures / minutes).');
$GLOBALS['TL_LANG']['tl_inserttags']['end_date']		= array('Date de fin', 'Saisissez la date de fin d\'affichage du tag (jour / mois / année).');
$GLOBALS['TL_LANG']['tl_inserttags']['end_time']		= array('Heure de fin', 'Saisissez l\'heure de fin d\'affichage du tag (Heures / minutes)).');
$GLOBALS['TL_LANG']['tl_inserttags']['mode']			= array('Appliquer le tag à', 'Sélectionnez la valeur souhaitée, selon votre envie d\'appliquer ce tag au Front Office, au Back Office ou aux deux (en laissant vide).');
$GLOBALS['TL_LANG']['tl_inserttags']['cacheOutput']		= array('Laisser le tag hors du cache', 'Cochez la case si vous souhaitez que le tag soit appliqué avant que Contao ne mette en cache la page.');
$GLOBALS['TL_LANG']['tl_inserttags']['useCondition']	= array('Condition', 'Cochez cette case si votre tag doit s\'afficher selon certaines conditions.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionType']	= array('Type de requête', 'Si vous sélectionnez "Base de données", veuillez saisir une requête SQL valide. Le premier résultat de la première ligne récupérée sera retourné. Vous pouvez utiliser des tags dans votre requête.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionQuery']	= array('Requête', 'Saisissez votre requête. Cela peut être un insert-tag Contao par exemple');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionFormula']= array('Signe mathématique', 'Veuillez choisir un signe pour comparer le résultat à la requête.');
$GLOBALS['TL_LANG']['tl_inserttags']['conditionValue']	= array('Valeur', 'Saisir la valeur que vous souhaitez comparer');
$GLOBALS['TL_LANG']['tl_inserttags']['limitpages']		= array('Limiter aux pages', 'Cochez cette case si vous souhaitez que votre tag soit limité à certaines pages.');
$GLOBALS['TL_LANG']['tl_inserttags']['pages']			= array('Pages', 'Sélectionnez les pages concernées par le tag courant.');
$GLOBALS['TL_LANG']['tl_inserttags']['includesubpages']	= array('Inclure des sous-pages', 'Cochez cette case si vous souhaitez que le tag soit appliqué aux sous-pages également.');
$GLOBALS['TL_LANG']['tl_inserttags']['limitLanguages']	= array('Limiter aux langages', 'Cochez cette case si vous souhaiter limiter le tag à certaines langues.');
$GLOBALS['TL_LANG']['tl_inserttags']['languages']		= array('Langues', 'Choisissez les langages concernés par le tag courant.');
$GLOBALS['TL_LANG']['tl_inserttags']['useCounter']		= array('Utiliser un compteur', 'Ajoutez un compteur qui permettera d\'afficher le tag après un certain nombre d\'appels.');
$GLOBALS['TL_LANG']['tl_inserttags']['counterValue']	= array('Valeur courante', 'Il s\'agit de la valeur courante existante. Vous devriez saisir ceci depuis le début, ce compteur sera décrémenté de 1 à chaque usage du tag.');
$GLOBALS['TL_LANG']['tl_inserttags']['counterDefault']	= array('Valeur par défaut', 'Saisissez la valeur par défaut. Le compteur va revenir à cette valeur quand la répétition est activée et que la valeur courante est à 0.');
$GLOBALS['TL_LANG']['tl_inserttags']['counterRepeat']	= array('Répéter le compteur', 'Cochez cette case si vous souhaitez que le compteur se répéte.');
$GLOBALS['TL_LANG']['tl_inserttags']['protected']		= array('Protéger le tag', 'Cochez pour ne permettre qu\'à certains groupes de membre.');
$GLOBALS['TL_LANG']['tl_inserttags']['groups']			= array('Groupes de membres autorisés', 'Les groupes cochés seront autorisés à voir le tag.');
$GLOBALS['TL_LANG']['tl_inserttags']['guests']			= array('Ne montrer qu\'aux visiteurs', 'Cochez la case pour faire disparaître le tag à la vue des personnes connectées.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_inserttags']['eq']				= 'égal à';
$GLOBALS['TL_LANG']['tl_inserttags']['neq']				= 'différent de';
$GLOBALS['TL_LANG']['tl_inserttags']['lt']				= 'inférieur à';
$GLOBALS['TL_LANG']['tl_inserttags']['gt']				= 'supérieur à';
$GLOBALS['TL_LANG']['tl_inserttags']['elt']				= 'inférieur ou égal à';
$GLOBALS['TL_LANG']['tl_inserttags']['egt']				= 'supérieur ou égal à';
$GLOBALS['TL_LANG']['tl_inserttags']['starts']			= 'démarre avec (sensible à la casse)';
$GLOBALS['TL_LANG']['tl_inserttags']['ends']			= 'se termine avec (sensible à la casse)';
$GLOBALS['TL_LANG']['tl_inserttags']['contains']		= 'contient (sensible à la casse)';
$GLOBALS['TL_LANG']['tl_inserttags']['istarts']			= 'démarre avec (non-sensible à la casse)';
$GLOBALS['TL_LANG']['tl_inserttags']['iends']			= 'se termine avec (non-sensible à la casse)';
$GLOBALS['TL_LANG']['tl_inserttags']['icontains']		= 'contient (non-sensible à la casse)';
$GLOBALS['TL_LANG']['tl_inserttags']['fe']				= 'Front Office';
$GLOBALS['TL_LANG']['tl_inserttags']['be']				= 'Back Office';
$GLOBALS['TL_LANG']['tl_inserttags']['text']			= 'Texte';
$GLOBALS['TL_LANG']['tl_inserttags']['database']		= 'Base de données';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_inserttags']['new']      		= array('Créer un tag', 'Créer un nouveau tag');
$GLOBALS['TL_LANG']['tl_inserttags']['edit']     		= array('Editer le tag', 'Editer le tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['copy']     		= array('Dupliquer le tag', 'Dupliquer le tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['cut']        		= array('Déplacer le tag', 'Déplacer le tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['delete']   		= array('Supprimer le tag', 'Supprimer le tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['show']     		= array('Détails du tag', 'Détails du tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['pasteafter'] 		= array('Copier après', 'Copier après le tag ID %s');
$GLOBALS['TL_LANG']['tl_inserttags']['pasteinto']  		= array('Copier au début', 'Copier au début');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_inserttags']['tag_legend']			= 'Tag & Affichage';
$GLOBALS['TL_LANG']['tl_inserttags']['limit_legend']		= 'Limites';
$GLOBALS['TL_LANG']['tl_inserttags']['advanced_legend']		= 'Options avancées';
$GLOBALS['TL_LANG']['tl_inserttags']['expert_legend']		= 'Options supplémentaires (expert)';

