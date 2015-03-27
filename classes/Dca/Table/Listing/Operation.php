<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 26.3.15
 * Time: 9:17
 */

namespace Dev\Dca\Table\Listing;


class Operation {

	private $table_name;
	private $operation_name;

	private $label;
	private $href;
	private $class;
	private $attributes;
	private $icon;
	private $button_callback;

	private $global = false;

	/**
	 * Operation constructor.
	 * @param $table_name
	 * @param $operation_name
	 * @param bool $global is it a global operations
	 */
	public function __construct( $table_name, $operation_name, $global = false ) {
		$this->table_name = $table_name;
		$this->operation_name = $operation_name;
		$this->global = $global;
		$this->load();
	}

	public static function factory( $table_name, $operation_name, $global = false ) {
		return new Operation( $table_name, $operation_name, $global );
	}

	/**
	 * Button label. Typically a reference to the global language array.
	 *
	 * @param string /reference $label
	 * @return $this
	 */
	public function label( $label ) {
		$this->label = $label;
		return $this;
	}

	/**
	 * URL fragment that is added to the URI string when the button is clicked (e.g. act=editAll).
	 *
	 * @param mixed $href
	 * @return $this
	 */
	public function href( $href ) {
		$this->href = $href;
		return $this;
	}

	/**
	 * CSS class attribute of the button.
	 * * ONLY FOR GLOBAL OPERATION *
	 * @param string $class
	 * @return $this
	 */
	public function setClass( $class ) {
		$this->class = $class;
		return $this;
	}

	/**
	 * Additional attributes like event handler or style definitions.
	 *
	 * @param string $attributes
	 * @return $this
	 */
	public function attributes( $attributes ) {
		$this->attributes = $attributes;
		return $this;
	}

	/**
	 * Call a custom function instead of using the default button function. Please specify as array('Class', 'Method').
	 * called function($row, $href, $label, $title, $icon, $attributes)
	 *
	 * @param callable $button_callback
	 * @return $this
	 */
	public function buttonCallback( $button_callback ) {
		$this->button_callback = $button_callback;
		return $this;
	}

	/**
	 * Path and filename of the icon.
	 *
	 * @param mixed $icon
	 * @return $this
	 */
	public function icon( $icon ) {
		$this->icon = $icon;
		return $this;
	}

	public function toArray() {
		$raw = get_object_vars( $this );
		$res = array();
		foreach ( $raw as $key => $value ) {
			$real_key = trim( str_replace( '*', '', $key ) );
			if ( in_array( $real_key, array( 'table_name', 'operation_name', $this->global ? 'icon' : 'class' ) ) ) {
				continue;
			}
			$res[$real_key] = $this->$real_key;
		}

		return $res;

	}

	public function load() {
		$operation_key = $this->global ? 'global_operations' : 'operations';
		if ( isset( $GLOBALS['TL_DCA'][$this->table_name]['list'][$operation_key][$this->operation_name] ) ) {
			$def = $GLOBALS['TL_DCA'][$this->table_name]['list'][$operation_key][$this->operation_name];
			foreach ( $def as $k => $v ) {
				$this->$k = $v;
			}
		}
	}

	public function save() {
		$operation_key = $this->global ? 'global_operations' : 'operations';
		$GLOBALS['TL_DCA'][$this->table_name]['list'][$operation_key][$this->operation_name] = $this->toArray();
	}

}