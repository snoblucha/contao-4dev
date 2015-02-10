<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 28.1.15
 * Time: 10:47
 */

namespace Dev;


/**
 * Javascript managment in Contao
 *
 * @package Dev
 */
class Javascript
{
	/**
	 * Add javascript to Contao
	 *
	 * @param string $path path to your javascript.
	 * @param bool $static File will combined into one contao's JS file. True by default.
	 * @param string $key Key to add at desired location/name
	 */
	public static function add($path, $static = true, $key = null)
	{
		if (version_compare(VERSION, '3', '>=') && $static) {
			$path .= '|static';
		}

		if ($key) {
			$GLOBALS['TL_JAVASCRIPT'][$key] = $path;
		} else {
			$GLOBALS['TL_JAVASCRIPT'][$path] = $path;

		}
	}


}