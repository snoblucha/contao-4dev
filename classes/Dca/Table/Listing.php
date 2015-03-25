<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 25.3.15
 * Time: 13:49
 */

namespace Dev\Dca\Table;


use Dev\Dca\Table\Listing\Sort;

class Listing {
	/**
	 * @var Sort
	 */
	private $sort;
	private $table_name;

	/**
	 * Listing constructor.
	 * @param $table_name
	 */
	public function __construct( $table_name ) {
		$this->table_name = $table_name;
		$this->sort = new Sort($table_name);
	}

	public function save(){
		$this->sort->save();
	}

	/**
	 * @return Sort
	 */
	public function getSort() {
		return $this->sort;
	}



}