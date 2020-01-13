<?php

namespace Inessa\ResponseModels\Trinity\PromotionCreate;

use Inessa\ResponseModels\Trinity\PromotionCreate\Promotion;

class ResData {
	
	/**
	 * @setMethod addPromotion
	 * @nodeObject Inessa\ResponseModels\Trinity\PromotionCreate\Promotion	 
	 * @var Promotion[]
	 */
	protected $promotion = [];
	

	function getPromotion() {
		return $this->promotion;
	}

	function setPromotion(Promotion $promotion) {
		$this->promotion = $promotion;
	}
	

	function addPromotion(Promotion $promotion) {
		array_push($this->promotion, $promotion);
	}

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}
}
