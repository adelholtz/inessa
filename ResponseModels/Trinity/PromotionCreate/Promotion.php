<?php

namespace Inessa\ResponseModels\Trinity\PromotionCreate;

use Inessa\ResponseModels\Trinity\PromotionCreate\BillingEventPromotionCode;

class Promotion {

	/**
	 * @setMethod setLabel
	 * @var string
	 */
	protected $label;

	/**
	 * @setMethod setCode
	 * @var string
	 */
	protected $code;

	/**
	 * @nodeObject Inessa\ResponseModels\Trinity\PromotionCreate\BillingEventPromotionCode	 
	 * 
	 * @setMethod addBilling_event_promotion_code
	 * @var BillingEventPromotionCode[]
	 */
	protected $billing_event_promotion_code = [];

	/**
	 * @nodeObject Inessa\ResponseModels\Base\Owner	 
	 * 
	 * @setMethod setOwner
	 * @var Owner
	 */
	protected $owner;

	/**
	 * @nodeObject Inessa\ResponseModels\Base\Updater	 
	 * 
	 * @setMethod setUpdater
	 * @var Updater
	 */
	protected $updater;

	/**
	 * @setMethod setCreated
	 * @var string
	 */
	protected $created;

	/**
	 * @setMethod setUpdated
	 * @var string
	 */
	protected $updated;

	/**
	 * @setMethod setId
	 * @attribute id
	 * @var string
	 */
	protected $id;

	/**
	 * @setMethod setOncePerCustomer
	 * @attribute code
	 * @var string
	 */
	protected $oncePerCustomer;

	function getId() {
		return $this->id;
	}

	function getOncePerCustomer() {
		return $this->oncePerCustomer;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setOncePerCustomer($oncePerCustomer) {
		$this->oncePerCustomer = $oncePerCustomer;
	}

	function getLabel() {
		return $this->label;
	}

	function getCode() {
		return $this->code;
	}

	function getBilling_event_promotion_code() {
		return $this->billing_event_promotion_code;
	}

	function getOwner() {
		return $this->owner;
	}

	function getUpdater() {
		return $this->updater;
	}

	function getCreated() {
		return $this->created;
	}

	function getUpdated() {
		return $this->updated;
	}

	function setLabel($label) {
		$this->label = $label;
	}

	function setCode($code) {
		$this->code = $code;
	}

	function setBilling_event_promotion_code($billing_event_promotion_code) {
		$this->billing_event_promotion_code = $billing_event_promotion_code;
	}

	function setOwner($owner) {
		$this->owner = $owner;
	}

	function setUpdater($updater) {
		$this->updater = $updater;
	}

	function setCreated($created) {
		$this->created = $created;
	}

	function setUpdated($updated) {
		$this->updated = $updated;
	}

	function addBilling_event_promotion_code(BillingEventPromotionCode $billingEvent) {
		array_push($this->billing_event_promotion_code, $billingEvent);
	}

}
