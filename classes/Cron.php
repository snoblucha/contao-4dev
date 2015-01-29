<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 16.1.15
 * Time: 14:08
 */

namespace Dev;


/**
 *
 * Class Cron
 *
 * Interface for $GLOBALS['TL_CRON']
 *
 * @package Contao
 */
class Cron
{

    /**
     * Adds hourly Cron job
     *
     * @param $callback - valid PHP callback
     * @params $tag Optionaly name a task
     */
    public static function hourly($callback, $tag = null)
    {
        self::_set('hourly', $callback, $tag);
    }
    
    /**
     * Adds daily Cron job
     *
     * @param $callback - valid PHP callback
     * @params $tag Optionaly name a task
     */
    public static function daily($callback, $tag = null)
    {
        self::_set('daily', $callback, $tag);
    }
    
    /**
     * Adds minutely Cron job
     *
     * @param $callback - valid PHP callback
     * @params $tag Optionaly name a task
     */
    public static function minutely($callback, $tag = null)
    {
        self::_set('minutely', $callback, $tag);
    }


    private static function _set($type, $callback, $tag = null)
    {
        if ($tag) {
            $GLOBALS['TL_CRON'][$type][$tag] = $callback;
        } else {
            $GLOBALS['TL_CRON'][$type][] = $callback;
        }
    }


}