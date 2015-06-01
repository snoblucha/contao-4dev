<?php
/**
 * Managing the $GLOBALS['TL_CTE'] array
 *
 */

namespace Dev;

/**
 * Class CTE ContentElement class for adding new content elements.
 * @package Dev
 */
class CTE {
	const TYPE_MEDIA = 'media';
	const TYPE_TEXTS = 'texts';
	const TYPE_LINKS = 'links';
	const TYPE_IMAGES = 'images';
	const TYPE_FILES = 'files';
	const TYPE_INCLUDES = 'includes';

	/**
	 * Adds content element to the $GLOBALS['TL_CTE'] array
	 *
	 * @param String $type One of the class consts eg. TYPE_MEDIA
	 * @param String $name Key in the array
	 * @param String $class class to use, has to be descendant of ContentElement
	 */
	public static function add( $type, $name, $class ) {
		array_insert( $GLOBALS['TL_CTE'][$type], count( $GLOBALS['TL_CTE'][ $type ] ), array(
			$name => $class
		) );
	}

	/**
	 * Sets the content element in the $GLOBALS['TL_CTE'] array
	 *
	 * @param String $type One of the class consts eg. TYPE_MEDIA
	 * @param String $name Key in the array
	 * @param String $class class to use, has to be descendant of ContentElement
	 */
	public static function set( $type, $name, $class ) {
		$GLOBALS['TL_CTE']['media'][ $type ][ $name ] = $class;
	}

	/**
	 * Unsets the content element.
	 *
	 * @param String $type
	 * @param String $name
	 */
	public static function remove( $type, $name ) {
		unset( $GLOBALS['TL_CTE']['media'][ $type ][ $name ] );
	}


}