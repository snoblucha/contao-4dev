<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 23.3.15
 * Time: 12:50
 */

namespace Dev\Dca;


use Dev\Dca\Table\Config;
use Dev\Dca\Table\Listing;

class Table {

	/**
	 * @var Config
	 */
	private $config;
	private $table_name;
	private $listing;

	function __construct( $table_name ) {
		$this->table_name = $table_name;
		$this->load();

	}

	public static function factory($table_name){
		return new Table($table_name);
	}

	private function load() {
		if(!isset($GLOBALS['TL_DCA'][$this->table_name])){
			$GLOBALS['TL_DCA'][$this->table_name] = array(
				'palettes' => array(),
				'list' => array(),
				'sort' => array(),
				'fields' => array(),
				'config' => array(),
			);
		}
		$this->config = Config::factory( $this->table_name );
		$this->listing = new Table\Listing( $this->table_name );

		if ( !isset( $GLOBALS['TL_DCA'][$this->table_name]['fields'] ) ) {
			$GLOBALS['TL_DCA'][$this->table_name]['fields'] = array();
		}
	}

	public function save() {
		if ( !isset( $GLOBALS['TL_DCA'][$this->table_name] ) ) {
			$GLOBALS['TL_DCA'][$this->table_name] = array();
		}

		$this->config->save();
		$this->listing->save();
	}

	/**
	 * Get the config
	 *
	 * @return Config
	 */
	public function getConfig() {
		return $this->config;
	}

	/**
	 * @return string
	 */
	public function getTableName() {
		return $this->table_name;
	}


	/**
	 * Add a field to the table
	 *
	 * @param DcaField|Field $field
	 *
	 * @return $this
	 */
	public function addField( Field $field ) {

		if ( $field->label === null && $field->isAutoLabel() ) {
			$field->label = &$GLOBALS['TL_LANG'][$this->table_name][$field->getField()];
		}
		$GLOBALS['TL_DCA'][$this->table_name]['fields'][$field->getField()] = $field->toArray();
		return $this;
	}

	public function getDefArray() {
		return $GLOBALS['TL_DCA'][$this->table_name];
	}

	/**
	 * @return Listing
	 */
	public function getListing() {
		return $this->listing;
	}

	/**
	 * Adds $items in front of the $before in palette in $table
	 *
	 * @param string $before
	 * @param string|Field $items
	 * @param string $palette
	 * @param string $separator
	 * @internal param string $table
	 */
	public function paletteAddBefore( $before, $items, $palette = 'default', $separator = ',' ) {
		if ( $items instanceof Field ) {
			$items = $items->getField();
		}
		$this->paletteReplace( $palette, $before, implode( $separator, array( $items, $before ) ) );
	}

	/**
	 * Adds $items in front of the $before in palette in $table
	 * @param $after
	 * @param string|Field $items Items to add
	 * @param string $palette
	 * @param string $separator
	 */
	public function paletteAddAfter( $after, $items, $palette = 'default', $separator = ',' ) {
		if ( $items instanceof Field ) {
			$items = $items->getField();
		}
		$this->paletteReplace( $palette, $after, implode( $separator, array( $after, $items ) ) );
	}

	/**
	 * Replace in palette
	 * @param string $palette palette name, probably 'default'
	 * @param string $replace what to replace
	 * @param string $newContent new content.
	 */
	public function paletteReplace( $palette, $replace, $newContent ) {
		$GLOBALS['TL_DCA'][$this->table_name]['palettes'][$palette] = str_replace( $replace, $newContent, $GLOBALS['TL_DCA'][$this->table_name]['palettes'][$palette] );
	}

	/**
	 * Set the palette
	 *
	 * @param string $content  {Title};field1,field3;field4;field4
	 * @param string $palette
	 */
	public function setPalette($content, $palette = 'default'){
		$GLOBALS['TL_DCA'][$this->table_name]['palettes'][$palette] = $content;
	}

	/**
	 * @return mixed
	 */
	public function &getPalettesArray() {

		return $GLOBALS['TL_DCA'][$this->table_name]['palettes'];
	}


}