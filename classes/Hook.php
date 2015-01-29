<?php


namespace Dev;


/**
 * Class Hook
 *
 * Used as a proxy to $GLOBALS['TL_HOOKS'] array
 *
 * @package Dev
 */
class Hook
{

	/**
	 * Is Hook defined?
	 * @param string $name
	 * @return bool
	 */
	public static function isDefined($name)
	{
		return isset($GLOBALS['TL_HOOKS'][$name]);
	}

	/**
	 * Is hook empty?
	 * 
	 * @param string $name
	 * @return bool
	 */
	public static function notEmpty($name)
	{
		return self::isDefined($name) && count($GLOBALS['TL_HOOKS'][$name]) > 0;
	}

	/**
	 * Define a new hook if not defined already
	 *
	 * @param string $name
	 */
	public static function define($name)
	{
		if (!self::isDefined($name)) {
			$GLOBALS['TL_HOOKS'][$name] = array();
		}
	}

	/**
	 * Add a new callback to hook $name.
	 * @param string $name Hook name
	 * @param array $callback Valid callback
	 * @param string $hookName Optional name for hook key
	 */
	public static function add($name, $callback, $hookName = null)
	{
		if (!self::isDefined($name)) {
			self::define($name);
		}
		
		if ($hookName) {
			$GLOBALS['TL_HOOKS'][$name][$hookName] = $callback;
		} else {
			$GLOBALS['TL_HOOKS'][$name][] = $callback;

		}

	}

	/**
	 * Get all callbacks for hook
	 * @param string $name
	 * @return array
	 */
	public static function callbacks($name)
	{
		if (!self::isDefined($name)) {
			return array();
		} else {
			return $GLOBALS['TL_HOOKS'][$name];
		}
	}


}