<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Inessa\RequestModels\Trinity\PromotionCreate;
 
use Inessa\RequestModels\Trinity\PromotionCreate\Promotion;


class PromotionCreate  {

	/**
	 * @nodeObject Inessa\RequestModels\Trinity\PromotionCreate\Promotion
	 * @getMethod getPromotion
	 * @setMethod setPromotion
	 * @type Promotion
	 * @var Promotion
	 */
	protected $promotion;


	function getPromotion() {
		return $this->promotion;
	}

	function setPromotion(Promotion $promotion) {
		$this->promotion = $promotion;
	}

}
