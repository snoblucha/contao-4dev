<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 27.1.15
 * Time: 12:50
 */

namespace Dev;


class Config
{
	/**
	 * Get config value
	 *
	 * @param $key
	 * @return mixed
	 */
	public static function get($key)
	{
		return $GLOBALS['TL_CONFIG'][$key];
	}

	/**
	 * Set the config value
	 * 
	 * @param $key
	 * @param $value
	 */
	public static function set($key, $value)
	{
		$GLOBALS['TL_CONFIG'][$key] = $value;
	}

	/**
	 * Get keys from $GLOBALS['TL_CONFIG']
	 * 
	 * @return array
	 */
	public static function keys()
	{
		return array_keys($GLOBALS['TL_CONFIG']);
	}

	/**
	 * Return all $GLOBALS['TL_CONFIG']
	 * @return array
	 */
	public static function all()
	{
		return $GLOBALS['TL_CONFIG'];

	}

}