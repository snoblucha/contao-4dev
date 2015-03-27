<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 25.3.15
 * Time: 14:22
 */

namespace Dev\Dca\Table\Listing;


class Label {

	private $table_name;
	private $fields;
	private $format;
	private $maxCharacters;
	private $group_callback;
	private $label_callback;

	/**
	 * Labels constructor.
	 * @param $table_name
	 */
	public function __construct( $table_name ) {
		$this->table_name = $table_name;
	}

	/**
	 * One or more fields that will be shown in the list (e.g. array('title', 'user_id:tl_user.name')).
	 * @param array $fields
	 * @return $this
	 */
	public function fields( $fields ) {
		$this->fields = $fields;
		return $this;
	}

	/**
	 * HTML string used to format the fields that will be shown (e.g. %s).
	 *
	 * @param mixed $format
	 * @return $this
	 */
	public function format( $format ) {
		$this->format = $format;
		return $this;
	}

	/**
	 * Maximum number of characters of the label.
	 * @param integer $maxCharacters
	 * @return $this
	 */
	public function maxCharacters( $maxCharacters ) {
		$this->maxCharacters = $maxCharacters;
		return $this;
	}

	/**
	 * Call a custom function instead of using the default group header function.
	 * @param callable $group_callback
	 * @return $this
	 */
	public function groupCallback( $group_callback ) {
		$this->group_callback = $group_callback;
		return $this;
	}

	/**
	 * Call a custom function instead of using the default label function.
	 *
	 * @param callable $label_callback
	 * @return $this
	 */
	public function labelCallback( $label_callback ) {
		$this->label_callback = $label_callback;
		return $this;
	}

	public function load(){
		if(isset($GLOBALS['TL_DCA'][ $this->table_name ]['list']['labels'])){
			$def = $GLOBALS['TL_DCA'][ $this->table_name ]['list']['labels'];
			foreach ( $def as $k => $v ) {
				$this->$k = $v;
			}

		}
	}

	public function toArray() {
		$raw = get_object_vars( $this );
		$res = array();
		foreach ( $raw as $key => $value ) {
			$real_key = trim( str_replace( '*', '', $key ) );
			if ( in_array( $real_key, array( 'table_name' ) ) ) {
				continue;
			}
			$res[$real_key] = $this->$real_key;
		}

		return $res;

	}

	public function save(){
		$GLOBALS['TL_DCA'][ $this->table_name ]['list']['label'] = $this->toArray();
	}


}