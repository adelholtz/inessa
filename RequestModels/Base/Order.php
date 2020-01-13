<?php

namespace Inessa\RequestModels\Base;

class Order {

	/**
	 * @setMethod setKey
	 * @getMethod getKey
	 * @type string
	 * @var BasicNode
	 */
	protected $key;
	/**
	 * @setMethod setMode
	 * @getMethod getMode
	 * @type string
	 * @var BasicNode
	 */
	protected $mode = 'ASC';

	public function __construct(){
		$this->setKey();
		$this->setMode();
	}
	/**
	 * @return BasicNode
	 */
	function getKey() {
		return $this->key;
	}
	/**
	 * @return BasicNode
	 */
	function getMode() {
		return $this->mode;
	}
	/**
	 * @param string $key
	 * @return BasicNode
	 */
	function setKey($key = "") {
		$this->key = new BasicNode($key);
		return $this->key;
	}
	/**
	 * @param string $mode
	 * @return BasicNode
	 */
	function setMode($mode = "") {
		$this->mode = new BasicNode($mode);
		return $this->mode;
	}

}

?>
