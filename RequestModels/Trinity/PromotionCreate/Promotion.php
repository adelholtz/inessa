<?php

namespace Inessa\RequestModels\Trinity\PromotionCreate;
use Inessa\RequestModels\Base\BasicNode;
use Inessa\RequestModels\Trinity\PromotionCreate\BillingEventPromotionCode;

class Promotion {


	/**
	 * @getMethod getLabel
	 * @setMethod setLabel
	 * @type string
	 * @var BasicNode
	 */
	protected $label;


	/**
	 * @nodeObject Inessa\RequestModels\Trinity\PromotionCreate\BillingEventPromotionCode
	 *
	 * @getMethod getBilling_event_promotion_code
	 * @setMethod setBilling_event_promotion_code
	 * @type array
	 * @var BillingEventPromotionCode[]
	 */
	protected $billing_event_promotion_code;

	function getLabel() {
		return $this->label;
	}

	function getBilling_event_promotion_code() {
		return $this->billing_event_promotion_code;
	}

    function addBilling_event_promotion_code(BillingEventPromotionCode $billing_event_promotion_code) {
        $this->billing_event_promotion_code[] = $billing_event_promotion_code;
    }

	function setLabel($label) {
        $this->label = new BasicNode($label);
	}

	function setBilling_event_promotion_code(BillingEventPromotionCode $billing_event_promotion_code) {
        $this->billing_event_promotion_code = $billing_event_promotion_code;
	}




}
