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
	 * @param bool $static File will combined into one contao's JS file. True by default.
	 * @param string $media - all|print|screen ....
	 * @param null $key
	 */
	public static function add($path, $static = true, $media = 'all',  $key = null)
	{
		$path .= "|$media";
		if (version_compare(VERSION, '3', '>=') && $static) {
			$path .= '|static';
		}
		if ($key) {
			$GLOBALS['TL_CSS'][$key] = $path;
		} else {
			$GLOBALS['TL_CSS'][$path] = $path;
		}
	}


}