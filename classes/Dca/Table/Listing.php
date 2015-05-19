<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 25.3.15
 * Time: 13:49
 */

namespace Dev\Dca\Table;


use Dev\Dca\Table\Listing\Label;
use Dev\Dca\Table\Listing\Operation;
use Dev\Dca\Table\Listing\Sorting;

class Listing {
	/**
	 * @var Sorting
	 */
	private $sorting;
	private $label;
	private $table_name;

	private $operations = array();
	private $global_operations = array();

	/**
	 * @param string $table_name
	 * @return Listing
	 */
	public static function factory( $table_name ) {
		return new Listing( $table_name );
	}

	/**
	 * Listing constructor.
	 * @param $table_name
	 */
	public function __construct( $table_name ) {
		$this->table_name = $table_name;
		$this->sorting = new Sorting( $table_name );
		$this->label = new Label( $table_name );
		if ( !isset( $GLOBALS['TL_DCA'][$this->table_name]['list'] ) ) {
			$GLOBALS['TL_DCA'][$this->table_name]['list'] = array();
		}
		$this->loadOperations();
	}


	private function loadOperations() {
		if ( !isset( $GLOBALS['TL_DCA'][$this->table_name]['list']['global_operations'] ) ) {
			$GLOBALS['TL_DCA'][$this->table_name]['list']['global_operations'] = array();
		}
		if ( !isset( $GLOBALS['TL_DCA'][$this->table_name]['list']['operations'] ) ) {
			$GLOBALS['TL_DCA'][$this->table_name]['list']['operations'] = array();
		}
		foreach ( $GLOBALS['TL_DCA'][$this->table_name]['list']['global_operations'] as $k => $v ) {
			$this->global_operations[$k] = Operation::factory( $this->table_name, $k, true );
		}
		foreach ( $GLOBALS['TL_DCA'][$this->table_name]['list']['operations'] as $k => $v ) {
			$this->operations[$k] = Operation::factory( $this->table_name, $k, false );
		}

	}


	public function save() {
		$this->sorting->save();
		$this->label->save();
		foreach ( $this->operations as $operation ) {
			$operation->save();
		}
		foreach ( $this->global_operations as $operation ) {
			$operation->save();
		}

	}

	/**
	 * @return Sorting
	 */
	public function getSort() {
		return $this->sorting;
	}

	/**
	 * @return Label
	 */
	public function getLabel() {
		return $this->label;
	}


	/**
	 * Get the operation. Do not forget to call save()
	 *
	 * The operations array is divided into two sections: global operations that relate
	 * to all records at once (e.g. editing multiple records) and regular operations that
	 * relate to a particular record only (e.g. editing or deleting a record).
	 *
	 * @param $operation
	 * @param bool $global Is it a global operation
	 * @return Operation
	 */
	public function operation( $operation, $global = false ) {
		if ( $global ) {
			if ( !isset( $this->global_operations[$operation] ) ) {
				$this->global_operations[$operation] = Operation::factory( $this->table_name, $operation, $global );
			}
			return $this->global_operations[$operation];
		} else {
			if ( !isset( $this->operations[$operation] ) ) {
				$this->operations[$operation] = Operation::factory( $this->table_name, $operation, $global );
			}
			return $this->operations[$operation];
		}

	}

	public function enableDefaultOperations( $filter = array() ) {
		$operations = array(
			'edit' => array
			(
				'label' => &$GLOBALS['TL_LANG'][$this->table_name]['edit'],
				'href' => 'act=edit',
				'icon' => 'edit.gif'
			),
			'copy' => array
			(
				'label' => &$GLOBALS['TL_LANG'][$this->table_name]['copy'],
				'href' => 'act=paste&amp;mode=copy',
				'icon' => 'copy.gif'
			),
			'cut' => array
			(
				'label' => &$GLOBALS['TL_LANG'][$this->table_name]['cut'],
				'href' => 'act=paste&amp;mode=cut',
				'icon' => 'cut.gif'
			),
			'delete' => array
			(
				'label' => &$GLOBALS['TL_LANG'][$this->table_name]['delete'],
				'href' => 'act=delete',
				'icon' => 'delete.gif',
				'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label' => &$GLOBALS['TL_LANG'][$this->table_name]['show'],
				'href' => 'act=show',
				'icon' => 'show.gif'
			)
		);
		foreach ( $operations as $operation => $def ) {
			if ( in_array( $operation, $filter ) ) {
				continue;
			}

			$o = $this->operation( $operation, false );
			$o->href( $def['href'] )
			  ->icon( $def['icon'] )
			  ->attributes( $def['attributes'] ?: '' )
			  ->label( $def['label'] );


		}

	}


}