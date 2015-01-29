<?php
/**
 * 4Dev
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2014 Petr Snobl
 *
 * @package 4Dev
 * @author  Petr Snobl@Lebrija invest s.r.o.
 * @link    http://lebrija.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Dev',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Hybrids
	'Dev\Cron' => 'system/modules/4dev/classes/Cron.php',
	'Dev\Dca' => 'system/modules/4dev/classes/Dca.php',
	'Dev\Lang' => 'system/modules/4dev/classes/Lang.php',
	'Dev\Hook' => 'system/modules/4dev/classes/Hook.php',
	'Dev\Config' => 'system/modules/4dev/classes/Config.php',
	'Dev\Javascript' => 'system/modules/4dev/classes/Javascript.php',
	'Dev\Css' => 'system/modules/4dev/classes/Css.php',
	'Dev\Dca\Field' => 'system/modules/4dev/classes/Dca/Field.php',
	'Dev\Dca\Evaluation' => 'system/modules/4dev/classes/Dca/Evaluation.php',

));
