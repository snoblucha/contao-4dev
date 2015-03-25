<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 24.3.15
 * Time: 9:37
 */

namespace Dev\Dca\Table;


use Dev\Dca\Table;

class Config {
	const DATA_CONTAINER_TABLE = 'Table';
	const DATA_CONTAINER_FILE = 'File';
	const DATA_CONTAINER_FOLDER = 'Folder';

	/**
	 * @var string
	 */
	private $table_name;

	/**
	 * @var String
	 */
	private $label;

	/**
	 * @var String
	 */
	private $ptable;
	/**
	 * @var Array
	 */
	private $ctable;

	/**
	 * @var string
	 */
	private $dataContainer = 'Table';

	/**
	 * @var bool
	 */
	private $closed = false;

	/**
	 * @var bool
	 */
	private $notEditable = false;

	/**
	 * @var bool
	 */
	private $notDeletable = false;

	/**
	 * @var bool
	 */
	private $switchToEdit = false;

	/**
	 * @var bool
	 */
	private $doNotCopyRecords = false;

	/**
	 * @var bool
	 */
	private $doNotDeleteRecords = false;

	/**
	 * @var array Callback function
	 */
	private $onload_callback = array();

	/**
	 * @var array Callback function
	 */
	private $onsubmit_callback = array();

	/**
	 * @var array Callback function
	 */
	private $ondelete_callback = array();

	/**
	 * @var array Callback function
	 */
	private $oncut_callback = array();

	/**
	 * @var array Callback function
	 */
	private $oncopy_callback = array();

	/**
	 * @var array Callback function
	 */
	private $onversion_callback = array();

	/**
	 * @var array Callback function
	 */
	private $onrestore_callback = array();

	/**
	 * @var array
	 */
	private $sql = array();

	function __construct( $table_name ) {
		$this->table_name = $table_name;
		$this->load();
	}


	/**
	 * The label is used with page or file trees and typically includes reference to the language array.
	 *
	 * @param String $label
	 *
	 * @return $this
	 */
	public function label( $label ) {
		$this->label = $label;

		return $this;
	}



	/**
	 * Name of the related parent table (table.pid = ptable.id).
	 *
	 * @param String $ptable
	 *
	 * @return $this
	 */
	public function ptable( $ptable ) {
		$this->ptable = $ptable;

		return $this;
	}



	/**
	 * Name of the related child tables (table.id = ctable.pid).
	 *
	 * @param String $ctable
	 *
	 * @return $this
	 */
	public function addCtable( $ctable ) {
		if ( ! is_array( $this->ctable ) ) {
			$this->ctable = array();
		}
		array_push( $this->ctable, $ctable );

		return $this;
	}
	/**
	 * Name of the related child tables (table.id = ctable.pid).
	 *
	 * @param Array $ctables
	 *
	 * @return $this
	 */
	public function ctable( $ctables ) {
		if ( ! is_array( $this->ctable ) ) {
			$this->ctable = array();
		}
		$this->ctable = $ctables ;

		return $this;
	}



	/**
	 * Data Container
	 * Table (database table), File (local configuration file) or Folder (file manager).
	 *
	 * @param string $dataContainer should be File|Table|Folder - eg. ::DATA_CONTAINER_TABLE
	 *
	 * @return $this
	 */
	public function dataContainer( $dataContainer ) {
		$this->dataContainer = $dataContainer;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isClosed() {
		return $this->closed;
	}

	/**
	 * If true, you cannot add further records to the table.
	 *
	 * @param boolean $closed false by default
	 *
	 * @return $this
	 */
	public function closed( $closed ) {
		$this->closed = $closed;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isNotEditable() {
		return $this->notEditable;
	}

	/**
	 * If true, the table cannot be edited. False by default.
	 *
	 * @param boolean $notEditable
	 *
	 * @return $this
	 */
	public function notEditable( $notEditable ) {
		$this->notEditable = $notEditable;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isNotDeletable() {
		return $this->notDeletable;
	}

	/**
	 * If true, records in the table cannot be deleted.
	 *
	 * @param boolean $notDeletable
	 *
	 * @return $this
	 */
	public function setNotDeletable( $notDeletable ) {
		$this->notDeletable = $notDeletable;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isSwitchToEdit() {
		return $this->switchToEdit;
	}

	/**
	 * Activates the "save and edit" button when a new record is added (sorting mode 4 only).
	 *
	 * @param boolean $switchToEdit
	 *
	 * @return $this
	 */
	public function switchToEdit( $switchToEdit ) {
		$this->switchToEdit = $switchToEdit;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isDoNotCopyRecords() {
		return $this->doNotCopyRecords;
	}

	/**
	 * If true, Contao will not duplicate records of the current table when a record of its parent table is duplicated.
	 *
	 * @param boolean $doNotCopyRecords
	 *
	 * @return $this
	 */
	public function doNotCopyRecords( $doNotCopyRecords ) {
		$this->doNotCopyRecords = $doNotCopyRecords;

		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isDoNotDeleteRecords() {
		return $this->doNotDeleteRecords;
	}

	/**
	 * If true, Contao will not delete records of the current table when a record of its parent table is deleted.
	 *
	 * @param boolean $doNotDeleteRecords
	 *
	 * @return $this
	 */
	public function doNotDeleteRecords( $doNotDeleteRecords ) {
		$this->doNotDeleteRecords = $doNotDeleteRecords;

		return $this;
	}

	/**
	 * Calls a custom function when a DataContainer is initialized and passes the DataContainer object as argument.
	 *
	 * @param array $onload_callback
	 *
	 * @return $this
	 */
	public function onloadCallback( $onload_callback ) {
		$this->onload_callback = $onload_callback;

		return $this;
	}


	/**
	 * Calls a custom function after a record has been updated and passes the DataContainer object as argument.
	 *
	 * @param array $onsubmit_callback
	 *
	 *
	 * @return $this
	 */
	public function onsubmitCallback( $onsubmit_callback ) {
		$this->onsubmit_callback = $onsubmit_callback;

		return $this;
	}


	/**
	 * Calls a custom function when a record is deleted and passes the DataContainer object as argument.
	 *
	 * @param array $ondelete_callback
	 *
	 * @return $this
	 */
	public function ondeleteCallback( $ondelete_callback ) {
		$this->ondelete_callback = $ondelete_callback;

		return $this;
	}



	/**
	 * Calls a custom function when a record is moved and passes the DataContainer object as argument. Added in version 2.8.2.
	 *
	 * @param array $oncut_callback
	 *
	 * @return $this
	 */
	public function oncutCallback( $oncut_callback ) {
		$this->oncut_callback = $oncut_callback;

		return $this;
	}


	/**
	 * Calls a custom function when a record is moved and passes the DataContainer object as argument. Added in version 2.8.2.
	 *
	 * @param array $oncopy_callback
	 *
	 * @return $this
	 */
	public function oncopyCallback( $oncopy_callback ) {
		$this->oncopy_callback = $oncopy_callback;

		return $this;
	}

	/**
	 * Calls a custom function when a new version of a record is created and passes the table, the insert ID and the DataContainer object as argument.
	 *
	 * @param array $onversion_callback
	 *
	 * @return $this
	 */
	public function onversionCallback( $onversion_callback ) {
		$this->onversion_callback = $onversion_callback;

		return $this;
	}


	/**
	 * Calls a custom function when a version of a record is restored and passes the insert ID, the table, the data array and the version as argument.
	 *
	 * @param array $onrestore_callback
	 *
	 * @return $this
	 */
	public function onrestoreCallback( $onrestore_callback ) {
		$this->onrestore_callback = $onrestore_callback;

		return $this;

	}


	/**
	 * Table configuration
	 * Describes table configuration, e.g. 'keys' => array ( 'id' => 'primary', 'pid' => 'index' )
	 *
	 * @param array $sql
	 *
	 * @return $this
	 */
	public function sql( $sql ) {
		$this->sql = $sql;

		return $this;
	}


	/**
	 * @param $table_name
	 *
	 * @return Config
	 */
	public static function factory( $table_name ) {
		$config = new Config( $table_name );

		return $config;
	}

	/**
	 * Loads the definition from the table
	 */
	private function load() {
		if ( ! isset( $GLOBALS['TL_DCA'][ $this->table_name ] ) ) {
			return;
		}
		$def  = $GLOBALS['TL_DCA'][ $this->table_name ]['config'];
		$keys = array_keys( $def );
		foreach ( $keys as $key ) {
			$this->$key = $def[ $key ];
		}
	}

	public function save() {
		$GLOBALS['TL_DCA'][ $this->table_name ]['config'] = $this->toArray();

	}

	public function toArray() {
		$raw = get_object_vars($this);
		$res = array();
		foreach ( $raw as $key => $value ) {
			$real_key = trim( str_replace( '*', '', $key ) );
			if ( in_array( $real_key, array( 'table_name' ) ) ) {
				continue;
			}
			$res[ $real_key ] = $this->$real_key;
		}

		return $res;

	}
}