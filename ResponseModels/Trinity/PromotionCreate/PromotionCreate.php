<?php

namespace Inessa\ResponseModels\Trinity\PromotionCreate;

use Inessa\ResponseModels\Base\Base;

class PromotionCreate extends Base {
 
	/**
	 * @nodeObject Inessa\ResponseModels\Trinity\PromotionCreate\Result	 
	 * 
	 * @setMethod setResult
	 * @var Result
	 */
	protected $result;
	
	function getResult() {
		return $this->result;
	}

	function setResult($result) {
		$this->result = $result;
	} 

}
