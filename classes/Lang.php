<?php
/**
 */

namespace Dev;

class Lang
{
	/**
	 * Set the language
	 *
	 * @param string $key Is the path, separated by dot[.]. For example tl_news.some.path
	 *                    will get you &$GLOBALS['TL_LANG'][tl_news][some][path]
	 * @param mixed $value
	 */
	public static function set($key, $value)
	{
		$arr = &self::decodePath($key, true);
		$arr = $value;
	}

	/**
	 * @param string $key Is the path, separated by dot[.].
	 * For example tl_news.some.path will get you &$GLOBALS['TL_LANG'][tl_news][some][path]
	 * @return mixed
	 */
	public static function &get($key)
	{
		return self::decodePath($key, false);
	}

	
	/**
	 * @param $path
	 * @param bool $createPath
	 * @param string $separator
	 * @return mixed
	 */
	private static function &decodePath($path, $createPath = true, $separator = '.')
	{
		$path = explode($separator, $path);
		$res = &$GLOBALS['TL_LANG'];
		foreach ($path as $part) {
			if(!isset($res[$part])){
				if($createPath) {
					$res[$part] = array();
				} else {
					return null;
					
				}
			}
			$res = &$res[$part];
		}
		return $res;


	}

}