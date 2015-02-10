<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 27.1.15
 * Time: 11:00
 */

namespace Dev\Dca;

/**
 * Class DcaField
 *
 * The fields array defines the columns of a table. Depending on these settings,
 * the Contao core engine decides which type of form field to load, whether a user
 * is allowed to access a certain field and whether a field can be used as sort or
 * filter criteria.
 *
 * @package Contao
 */
class Field
{

	const TYPE_RADIO = 'radio';
	const TYPE_TEXT =  'text';// Text field
	const TYPE_PASSWORD =  'password';// Password field
	const TYPE_TEXTAREA = 'textarea';// Textarea
	const TYPE_SELECT = 'select';// Drop-down menu
	const TYPE_CHECKBOX = 'checkbox';// Checkbox
	const TYPE_RADIO_TABLE = 'radioTable';// Table with images and radio buttons
	const TYPE_IMAGE_SIZE = 'imageSize';// Two text fields with drop-down menu
	const TYPE_INPUT_UNIT = 'inputUnit';// Text field with small unit drop-down menu
	const TYPE_TRBL = 'trbl';// Four text fields with a small unit drop-down menu
	const TYPE_CHMOD = 'chmod';// CHMOD table
	const TYPE_PAGE_TREE = 'pageTree';// Page tree
	const TYPE_FILE_TREE = 'fileTree';// File tree
	const TYPE_TABLE_WIZARD = 'tableWizard';// Table wizard
	const TYPE_TIME_PERIOD ='timePeriod';// Text field with drop-down menu
	const TYPE_LIST_WIZARD = 'listWizard';// List wizard
	const TYPE_OPTION_WIZARD = 'optionWizard';// Option wizard
	const TYPE_MODULE_WIZARD = 'moduleWizard';// Module wizard
	const TYPE_CHECKBOX_WIZARD = 'checkboxWizard';// Checkbox Wizard
	
	/**
	 * Field name
	 * @var string
	 */
	private $field = '';

	/**
	 * Set auto the reference to label on assignment
	 *
	 * @var bool
	 */
	private $auto_label = true;

	/**
	 * Field label. Typically a reference to the global language array.
	 *
	 * &$GLOBALS['TL_LANG'][...
	 *
	 * @var string|array
	 */
	public $label = null;

	/**
	 * If true the field will be excluded for non-admins.
	 * It can be enabled in the user group module (allowed excluded fields).
	 * @var bool
	 */
	public $exclude = false;

	/**
	 * If true the field will be included in the search menu (see "sorting records" -> "panelLayout").
	 *
	 * @var bool
	 */
	public $search = null;

	/**
	 * If true the field will be included in the sorting menu (see "sorting records" -> "panelLayout").
	 *
	 * @var bool
	 */
	public $sorting = null;

	/**
	 * If true the field will be included in the filter menu (see "sorting records" -> "panelLayout").
	 *
	 * @var bool
	 */
	public $filter = null;

	/**
	 * Sorting mode
	 *
	 * 1 Sort by initial letter ascending
	 * 2 Sort by initial letter descending
	 * 3 Sort by initial X letters ascending (see length)
	 * 4 Sort by initial X letters descending (see length)
	 * 5 Sort by day ascending
	 * 6 Sort by day descending
	 * 7 Sort by month ascending
	 * 8 Sort by month descending
	 * 9 Sort by year ascending
	 * 10 Sort by year descending
	 * 11 Sort ascending
	 * 12 Sort descending
	 *
	 * @var int
	 */
	public $flag = null;

	/**
	 * Sorting length
	 *
	 * Allows to specify the number of characters that are used to build sorting groups (flag 3 and 4).
	 *
	 * @var int
	 */
	public $length = null;

	/**
	 * Field type
	 *
	 * 'text' Text field
	 * 'password' Password field
	 * 'textarea' Textarea
	 * 'select' Drop-down menu
	 * 'checkbox' Checkbox
	 * 'radio' Radio button
	 * 'radioTable' Table with images and radio buttons
	 * 'imageSize' Two text fields with drop-down menu
	 * 'inputUnit' Text field with small unit drop-down menu
	 * 'trbl' Four text fields with a small unit drop-down menu
	 * 'chmod' CHMOD table
	 * 'pageTree' Page tree
	 * 'fileTree' File tree
	 * 'tableWizard' Table wizard
	 * 'timePeriod' Text field with drop-down menu
	 * 'listWizard' List wizard
	 * 'optionWizard' Option wizard
	 * 'moduleWizard' Module wizard
	 * 'checkboxWizard' Checkbox Wizard
	 *
	 * @var string
	 */
	public $inputType = null;

	/**
	 * Options
	 *
	 * Options of a drop-down menu or radio button menu.
	 *
	 * @var array
	 */
	public $options = null;

	/**
	 * Callback function
	 *
	 *  Callback function that returns an array of options. Please specify as array('Class', 'Method').
	 *
	 * @var array
	 */
	public $options_callback = null;

	/**
	 * table.field
	 *
	 * Get options from a database table. Returns ID as key and the field you specify as value.
	 *
	 * @var string
	 */
	public $foreignKey = null;

	/**
	 * &$GLOBALS['TL_LANG']
	 *
	 * Array that holds the options labels. Typically a reference to the global language array.
	 *
	 * @var array
	 */
	public $reference = null;


	/**
	 * &$GLOBALS['TL_LANG'] (string)
	 *
	 * Array that holds the explanation. Typically a reference to the global language array.
	 *
	 * @var array
	 */
	public $explanation = null;

	/**
	 * Callback function
	 *
	 * Executes a custom function instead of using the default input field routine and passes the the DataContainer object and the label as arguments.
	 *
	 * @var array
	 */
	public $input_field_callback = null;

	/**
	 * Various configuration options. See next paragraph.
	 *
	 * Use DcaEval class
	 *
	 * @var array|Evaluation
	 */
	public $eval = array();

	/**
	 * Callback function
	 *
	 * Call a custom function and add its return value to the input field. Please specify as array('Class', 'Method').
	 *
	 * @var array
	 */
	public $wizard = null;

	/**
	 * Database field definition (string)
	 *
	 * Describes data type and its database configuration, e.g. varchar(255) NOT NULL default ''
	 *
	 * @var string
	 */
	public $sql = null;

	/**
	 * Configuration of relations (array)
	 *
	 * Describes relation to parent table (DcaRelation).
	 *
	 * @var array
	 */
	public $relation = null;

	/**
	 * These functions will be called when the field is loaded. Please specify each callback
	 * function as array('Class', 'Method'). Passes the field's value and the data container
	 * as arguments. Expects the field value as return value.
	 *
	 * @var array
	 */
	public $load_callback = null;


	/**
	 * These functions will be called when the field is saved. Please specify each callback
	 * function as array('Class', 'Method'). Passes the field's value and the data container
	 * as arguments. Expects the field value as return value. Throw an exception to
	 * display an error message.
	 *
	 * @var array
	 */
	public $save_callback = null;

	/**
	 *
	 * @param string $field Field name.
	 * @param array $params Params to set. Accepts only public variables of the class
	 * @param bool $auto_label Automatic label set up to $GLOBALS['']
	 */
	function __construct($field, $params = array(), $auto_label = true)
	{
		$this->field = $field;
		foreach ($params as $key => $value) {
			if (property_exists($this, $key)) {
				$this->$key = $value;

			}
		}

	}

	/**
	 * Get the array representation
	 * @return array
	 */
	public function toArray()
	{
		$vars = get_object_vars($this);
		$res = array();
		foreach ($vars as $var => $value) {

			if (!is_null($value)) {
				if (is_object($value) && method_exists($value, 'toArray')) { 
					// if have toArray method, then call it
					$value = $value->toArray();
				}
				$res[$var] = $value;
			}
		}
		return $res;
	}

	/**
	 * @return string
	 */
	public function getField()
	{
		return $this->field;
	}

	/**
	 * Will be setting label to reference to TL_LANG.table_name.field array
	 *
	 * @return boolean
	 */
	public function isAutoLabel()
	{
		return $this->auto_label;
	}

	/**
	 * Should we set label to reference to TL_LANG.table_name.field array
	 *
	 * @param boolean $auto_label
	 */
	public function setAutoLabel($auto_label)
	{
		$this->auto_label = $auto_label;
	}

	/**
	 *
	 * @param string $field Field name/identificator
	 * @param $params array Optional
	 * @param bool $auto_label
	 * @return Field
	 */
	public static function factory($field, $params = array(), $auto_label = true)
	{
		return new Field($field, $params, $auto_label);
	}

	/**
	 * @param array|string $label
	 * @return $this
	 */
	public function label($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * If true the field will be excluded for non-admins.
	 * It can be enabled in the user group module (allowed excluded fields).
	 *
	 * @param boolean $exclude
	 * @return $this
	 */
	public function exclude($exclude)
	{
		$this->exclude = $exclude;
		return $this;
	}

	/**
	 * If true the field will be included in the search menu (see "sorting records" -> "panelLayout").
	 *
	 * @param boolean $search
	 * @return $this
	 */
	public function search($search)
	{
		$this->search = $search;
		return $this;
	}

	/**
	 * If true the field will be included in the sorting menu (see "sorting records" -> "panelLayout").
	 *
	 * @param boolean $sorting
	 * @return $this
	 */
	public function sorting($sorting)
	{
		$this->sorting = $sorting;
		return $this;
	}

	/**
	 * If true the field will be included in the filter menu (see "sorting records" -> "panelLayout").
	 *
	 * @param boolean $filter
	 * @return $this
	 */
	public function filter($filter)
	{
		$this->filter = $filter;
		return $this;
	}

	/**
	 * Sorting mode
	 *
	 * 1 Sort by initial letter ascending
	 * 2 Sort by initial letter descending
	 * 3 Sort by initial X letters ascending (see length)
	 * 4 Sort by initial X letters descending (see length)
	 * 5 Sort by day ascending
	 * 6 Sort by day descending
	 * 7 Sort by month ascending
	 * 8 Sort by month descending
	 * 9 Sort by year ascending
	 * 10 Sort by year descending
	 * 11 Sort ascending
	 * 12 Sort descending
	 *
	 * @param int $flag
	 * @return $this
	 */
	public function flag($flag)
	{
		$this->flag = $flag;
		return $this;
	}

	/**
	 * Sorting length
	 *
	 * Allows to specify the number of characters that are used to build sorting groups (flag 3 and 4).
	 *
	 * @param int $length
	 * @return $this
	 */
	public function length($length)
	{
		$this->length = $length;
		return $this;
	}

	/**
	 * 'text' Text field
	 * 'password' Password field
	 * 'textarea' Textarea
	 * 'select' Drop-down menu
	 * 'checkbox' Checkbox
	 * 'radio' Radio button
	 * 'radioTable' Table with images and radio buttons
	 * 'imageSize' Two text fields with drop-down menu
	 * 'inputUnit' Text field with small unit drop-down menu
	 * 'trbl' Four text fields with a small unit drop-down menu
	 * 'chmod' CHMOD table
	 * 'pageTree' Page tree
	 * 'fileTree' File tree
	 * 'tableWizard' Table wizard
	 * 'timePeriod' Text field with drop-down menu
	 * 'listWizard' List wizard
	 * 'optionWizard' Option wizard
	 * 'moduleWizard' Module wizard
	 * 'checkboxWizard' Checkbox Wizard
	 *
	 * @param string $inputType
	 * @return $this
	 */
	public function inputType($inputType)
	{
		$this->inputType = $inputType;
		return $this;
	}

	/**
	 * Options
	 *
	 * Options of a drop-down menu or radio button menu.
	 *
	 * @param array $options
	 * @return $this
	 */
	public function options($options)
	{
		$this->options = $options;
		return $this;
	}

	/**
	 * Callback function
	 *
	 *  Callback function that returns an array of options. Please specify as array('Class', 'Method').
	 *
	 * @param array $options_callback
	 * @return $this
	 */
	public function optionsCallback($options_callback)
	{
		$this->options_callback = $options_callback;
		return $this;
	}

	/**
	 * table.field
	 *
	 * Get options from a database table. Returns ID as key and the field you specify as value.
	 *
	 * @param string $foreignKey
	 * @return $this
	 */
	public function foreignKey($foreignKey)
	{
		$this->foreignKey = $foreignKey;
		return $this;
	}

	/**
	 * &$GLOBALS['TL_LANG']
	 *
	 * Array that holds the options labels. Typically a reference to the global language array.
	 *
	 * @param &array $reference
	 * @return $this
	 */
	public function reference($reference)
	{
		$this->reference = $reference;
		return $this;
	}

	/**
	 * &$GLOBALS['TL_LANG'] (string)
	 *
	 * Array that holds the explanation. Typically a reference to the global language array.
	 *
	 * @param array|string $explanation
	 * @return $this
	 */
	public function explanation($explanation)
	{
		$this->explanation = $explanation;
		return $this;
	}

	/**
	 * Callback function
	 *
	 * Executes a custom function instead of using the default input field routine and passes the the DataContainer object and the label as arguments.
	 *
	 * @param array $input_field_callback
	 * @return $this
	 */
	public function inputFieldCallback($input_field_callback)
	{
		$this->input_field_callback = $input_field_callback;
		return $this;
	}

	/**
	 * @param array|Evaluation $eval
	 * @return $this
	 */
	public function evaluation($eval)
	{
		$this->eval = $eval;
		return $this;
	}

	/**
	 * Callback function
	 *
	 * Call a custom function and add its return value to the input field. Please specify as array('Class', 'Method').
	 *
	 * @param array $wizard
	 * @return $this
	 */
	public function wizard($wizard)
	{
		$this->wizard = $wizard;
		return $this;
	}

	/**
	 * Database field definition (string)
	 *
	 * Describes data type and its database configuration, e.g. varchar(255) NOT NULL default ''
	 *
	 * @param string $sql
	 * @return $this
	 */
	public function sql($sql)
	{
		$this->sql = $sql;
		return $this;
	}

	/**
	 * Configuration of relations (array)
	 *
	 * Describes relation to parent table (DcaRelation).
	 *
	 * @param array $relation
	 * @return $this
	 */
	public function relation($relation)
	{
		$this->relation = $relation;
		return $this;
	}

	/**
	 * These functions will be called when the field is loaded. Please specify each callback
	 * function as array('Class', 'Method'). Passes the field's value and the data container
	 * as arguments. Expects the field value as return value.
	 *
	 * @param array $load_callback
	 * @return $this
	 */
	public function loadCallback($load_callback)
	{
		$this->load_callback = $load_callback;
		return $this;
	}


	/**
	 * Get the evaulation object
	 *
	 * @return array|Evaluation
	 */
	public function beginEval(){
		if($this->eval === null || is_array($this->eval)){
			$this->eval = Evaluation::factory($this);
		} else {
			$this->eval->setField($this);
		}
		
		return $this->eval;
		
	}

	/**
	 * These functions will be called when the field is saved. Please specify each callback
	 * function as array('Class', 'Method'). Passes the field's value and the data container
	 * as arguments. Expects the field value as return value. Throw an exception to
	 * display an error message.
	 *
	 * @param array $save_callback
	 * @return $this
	 */
	public function saveCallback($save_callback)
	{
		$this->save_callback = $save_callback;
		return $this;
	}

	function __toString()
	{
		return $this->getField();
	}


}


