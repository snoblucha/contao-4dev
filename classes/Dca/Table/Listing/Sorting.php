<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 25.3.15
 * Time: 13:51
 */

namespace Dev\Dca\Table\Listing;


class Sorting {

	/**
	 * Records are not sorted
	 */
	const MODE_NOT_SORTED = 0;
	/**
	 *  Records are sorted by a fixed field
	 */
	const MODE_FIXED_FIELD = 1;
	/**
	 * Records are sorted by a switchable field
	 */
	const MODE_SWITCHABLE_FIELD = 2;
	/**
	 * Records are sorted by the parent table
	 */
	const MODE_PARENT_TABLE = 3;
	/**
	 * Displays the child records of a parent record (see style sheets module)
	 */
	const MODE_DISPLAY_CHILD_RECORDS = 4;
	/**
	 * Records are displayed as tree (see site structure)
	 */
	const MODE_DISPLAY_AS_TREE = 5;
	/**
	 * Displays the child records within a tree structure (see articles module)
	 */
	const MODE_DISPLAY_WITHIN_TREE = 6;


	const FLAG_BY_INITIAL_LETTER_ASC = 1;
	const FLAG_BY_INITIAL_LETTER_DESC = 2;
	const FLAG_BY_INITIAL_TWO_LETTER_ASC = 3;
	const FLAG_BY_INITIAL_TWO_LETTER_DESC = 4;
	const FLAG_BY_DAY_ASC = 5;
	const FLAG_BY_DAY_DESC = 6;
	const FLAG_BY_MONTH_ASC = 7;
	const FLAG_BY_MONTH_DESC = 8;
	const FLAG_BY_YEAR_ASC = 9;
	const FLAG_BY_YEAR_DESC = 10;
	const FLAG_ASC = 11;
	const FLAG_DESC = 12;

	const PANEL_LAYOUT_SEARCH = 'search';
	const PANEL_LAYOUT_SORT = 'sort';
	const PANEL_LAYOUT_FILTER = 'filter';
	const PANEL_LAYOUT_LIMIT = 'limit';

	private $table_name;
	private $mode;
	private $flag;
	private $panelLayout;
	private $fields = array();
	private $headerFields = array();
	private $icon;
	private $root;
	private $filter;
	private $disableGrouping;
	private $paste_button_callback;
	private $child_record_callback;
	private $child_record_class;

	/**
	 * Sort constructor.
	 * @param string $table_name
	 */
	public function __construct( $table_name ) {
		$this->table_name = $table_name;
		$this->load();
	}

	/**
	 * Sorting mode. @see SORT_* consts
	 *
	 * @param integer $mode
	 * @return $this
	 */
	public function mode( $mode ) {
		$this->mode = $mode;
		return $this;
	}


	/**
	 * Records are not sorted. @see FLAG_* consts
	 * @param mixed $flag
	 * @return $this
	 */
	public function flag( $flag ) {
		$this->flag = $flag;
		return $this;
	}

	/**
	 * Panel layout
	 * - search show the search records menu
	 * - sort show the sort records menu
	 * - filter show the filter records menu
	 * - limit show the limit records menu.
	 *
	 * Separate options with comma (= space) and semicolon (= new line) like sort,filter;search,limit.
	 *
	 * @param string $panelLayout
	 * @return $this
	 */
	public function panelLayout( $panelLayout ) {
		$this->panelLayout = $panelLayout;
		return $this;
	}

	/**
	 * Default sorting
	 *
	 * One or more fields that are used to sort the table.
	 * @param array $fields
	 * @return $this
	 */
	public function fields( $fields ) {
		$this->fields = $fields;
		return $this;
	}

	/**
	 * One or more fields that will be shown in the header element (sorting mode 4 only).
	 *
	 * @param array $headerFields
	 * @return $this
	 */
	public function headerFields( $headerFields ) {
		$this->headerFields = $headerFields;
		return $this;
	}

	/**
	 * Path to an icon that will be shown on top of the tree (sorting mode 5 and 6 only).
	 *
	 * @param string $icon
	 * @return $this
	 */
	public function icon( $icon ) {
		$this->icon = $icon;
		return $this;
	}

	/**
	 * IDs of the root records (pagemounts). This value usually takes care of itself.
	 *
	 * @param array $root
	 * @return $this
	 */
	public function root( $root ) {
		$this->root = $root;
		return $this;
	}

	/**
	 * Allows you to add custom filters as arrays, e.g. array('status=?', 'active').
	 *
	 * @param array $filter
	 * @return $this
	 */
	public function filter( $filter ) {
		$this->filter = $filter;
		return $this;
	}

	/**
	 * Allows you to disable the group headers in list view and parent view.
	 *
	 * @param boolean $disableGrouping
	 * @return $this
	 */
	public function disableGrouping( $disableGrouping ) {
		$this->disableGrouping = $disableGrouping;
		return $this;
	}

	/**
	 * This function will be called instead of displaying the default paste buttons. Please specify as array('Class', 'Method').
	 *
	 * @param callable $paste_button_callback
	 * @return $this
	 */
	public function pasteButtonCallback( $paste_button_callback ) {
		$this->paste_button_callback = $paste_button_callback;
		return $this;
	}

	/**
	 * This function will be called to render the child elements (sorting mode 4 only). Please specify as array('Class', 'Method').
	 *
	 * @param callable $child_record_callback
	 * @return $this;
	 */
	public function childRecordCallback( $child_record_callback ) {
		$this->child_record_callback = $child_record_callback;
		return $this;
	}

	/**
	 * Allows you to add a CSS class to the parent view elements.
	 *
	 * @param mixed $child_record_class
	 * @return $this
	 */
	public function childRecordClass( $child_record_class ) {
		$this->child_record_class = $child_record_class;
		return $this;
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

	public function load(){
		if(isset($GLOBALS['TL_DCA'][ $this->table_name ]['list']['sorting'])){
			$def = $GLOBALS['TL_DCA'][ $this->table_name ]['list']['sorting'];
			foreach ( $def as $k => $v ) {
				$this->$k = $v;
			}

		}
	}

	public function save(){
		$GLOBALS['TL_DCA'][ $this->table_name ]['list']['sorting'] = $this->toArray();
	}


}