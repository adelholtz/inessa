<?php

namespace Inessa\ResponseModels\Base;

class Status {
	/**
	 * @setMethod setCode
	 * @var string 
	 */
	protected $code;
	/**
	 * @setMethod setType
	 * @var string
	 */
	protected $type;
	/**
	 * @setMethod setText
	 * @var string
	 */
	protected $text;

	function getCode() {
		return $this->code;
	}

	function getType() {
		return $this->type;
	}

	function getText() {
		return $this->text;
	}

	function setCode($code) {
		$this->code = $code;
	}

	function setType($type) {
		$this->type = $type;
	}

	function setText($text) {
		$this->text = $text;
	}

}

?>
