<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 23.3.15
 * Time: 12:50
 */

namespace Dev\Dca;


use Dev\Dca\Table\Config;

class Table {

	/**
	 * @var Config
	 */
	private $config;
	private $table_name;

	function __construct( $table_name ) {
		$this->table_name = $table_name;
		$this->load();

	}

	private function load() {
		$this->config = Config::factory( $this->table_name );

		if(!isset($GLOBALS['TL_DCA'][ $this->table_name ]['fields'])){
			$GLOBALS['TL_DCA'][ $this->table_name ]['fields'] = array();
		}
	}

	public function save() {
		if ( ! isset( $GLOBALS['TL_DCA'][ $this->table_name ] ) ) {
			$GLOBALS['TL_DCA'][ $this->table_name ] = array();
		}

		$this->config->save();
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
	 */
	public function addField( Field $field ) {

		if ( $field->label === null && $field->isAutoLabel() ) {
			$field->label = &$GLOBALS['TL_LANG'][ $this->table_name ][ $field->getField() ];
		}
		$GLOBALS['TL_DCA'][ $this->table_name ]['fields'][ $field->getField() ] = $field->toArray();

	}

	public function getDefArray(){
		return $GLOBALS['TL_DCA'][ $this->table_name ];
	}


}