<?php

namespace Inessa\RequestModels\Base;

class Task {

	/**
	 * @setMethod setCode
	 * @getMethod getCode
	 * @type string
	 * @var BasicNode 
	 */
	protected $code;

	function getCode() {
		return $this->code;
	}

	function setCode($code) {
		$this->code = new BasicNode($code);
	}
}

?>
