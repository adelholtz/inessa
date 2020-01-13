<?php

namespace Inessa\ResponseModels\Trinity\PromotionCreate;

use Inessa\ResponseModels\Base\Attributes;
use Inessa\ResponseModels\Base\AttributesTrait; 

class Result {

	/**
	 * @setMethod setText
	 * @var string
	 */
	protected $text;

	/**
	 * @nodeObject Inessa\ResponseModels\Trinity\PromotionCreate\ResData	 
	 * 
	 * @setMethod setResData
	 * @var ResData
	 */
	protected $resData;
	
	/**
	 * @setMethod setCode
	 * @attribute code
	 * @var string
	 */
	protected $code;
	
	/**
	 * @setMethod setType
	 * @attribute type
	 * @var string
	 */
	protected $type;
	
	
	
	function getCode() {
		return $this->code;
	}

	function getType() {
		return $this->type;
	}

	function setCode($code) {
		$this->code = $code;
	}

	function setType($type) {
		$this->type = $type;
	} 

	function getText() {
		return $this->text;
	}

	function setText($text) {
		$this->text = $text;
	}

	function getResData() {
		return $this->resData;
	}

	function setResData($resData) {
		$this->resData = $resData;
	}

}
