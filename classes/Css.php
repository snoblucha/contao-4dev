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
class Css
{
	/**
	 * Add javascript to Contao
	 *
	 * @param string $path path to your javascript.
	 */
	public static function add($path)
	{
		$GLOBALS['TL_CSS'][] = $path;
	}


}