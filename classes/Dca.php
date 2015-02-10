<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 16.1.15
 * Time: 14:05
 */

namespace Dev;


class Dca
{

	/**
	 * Add a field to the table
	 *
	 * @param string $table
	 * @param DcaField $field
	 */
	public static function addField($table, Dca\Field $field)
	{
		if ($field->label === null && $field->isAutoLabel()) {
			$field->label = &$GLOBALS['TL_LANG'][$table][$field->getField()];
		}
		
		$GLOBALS['TL_DCA'][$table]['fields'][$field->getField()] = $field->toArray();

		
	}

	/**
	 * Adds $items in front of the $before in palette in $table
	 *
	 * @param string $table
	 * @param string $before
	 * @param string|Dca\Field $items
	 * @param string $palette
	 * @param string $separator
	 */
	public static function paletteAddBefore($table, $before, $items, $palette = 'default', $separator = ',')
	{
		if ($items instanceof Dca\Field) {
			$items = $items->getField();
		}
		self::paletteReplace($table, $palette, $before, implode($separator, array($items, $before)));
	}

	/**
	 * Adds $items in front of the $before in palette in $table
	 * @param string $table
	 * @param string $before
	 * @param string|Dca\Field $items Items to add
	 * @param string $palette
	 * @param string $separator
	 */
	public static function paletteAddAfter($table, $before, $items, $palette = 'default', $separator = ',')
	{
		if ($items instanceof Dca\Field) {
			$items = $items->getField();
		}
		self::paletteReplace($table, $palette, $before, implode($separator, array($before, $items)));
	}

	/**
	 * Replace in palette
	 * @param string $table
	 * @param string $palette palette name, probably 'default'
	 * @param string $replace what to replace
	 * @param string $newContent new content.
	 */
	public static function paletteReplace($table, $palette, $replace, $newContent)
	{
		$GLOBALS['TL_DCA'][$table]['palettes'][$palette] = str_replace($replace, $newContent, $GLOBALS['TL_DCA'][$table]['palettes'][$palette]);
	}
}