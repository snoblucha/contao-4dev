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
	 * @param string $key Key to add at desired location/name
	 */
	public static function add($path, $key = null)
	{
		if ($key) {
			$GLOBALS['TL_JAVASCRIPT'][$key] = $path;
		} else {
			$GLOBALS['TL_JAVASCRIPT'][$path] = $path;

		}
	}


}