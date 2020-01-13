<?php

namespace Inessa\ResponseModels\Trinity\PromotionCreate;

class BillingEventPromotionCode {

	/**
	 * @nodeObject Inessa\ResponseModels\Trinity\PromotionCreate\Product
	 * 
	 * @setMethod setProduct
	 * @var Product
	 */
	protected $product;

	/**
	 * @setMethod setObject
	 * @var string
	 */
	protected $object;

	/**
	 * @nodeObject Inessa\ResponseModels\Base\Customer
	 * 
	 * @setMethod setCustomer
	 * @var Customer
	 */
	protected $customer;

	/**
	 * @setMethod setCode
	 * @var string
	 */
	protected $code;

	/**
	 * @nodeObject Inessa\ResponseModels\Base\Owner
	 * 	 
	 * @setMethod setOwner
	 * @var string
	 */
	protected $owner;

	/**
	 * @nodeObject Inessa\ResponseModels\Base\Updater	 
	 * 
	 * @setMethod setUpdater
	 * @var string
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

	function getId() {
		return $this->id;
	}

	function setId($id) {
		$this->id = $id;
	}

	function getProduct() {
		return $this->product;
	}

	function getObject() {
		return $this->object;
	}

	function getCustomer() {
		return $this->customer;
	}

	function getCode() {
		return $this->code;
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

	function setProduct($product) {
		$this->product = $product;
	}

	function setObject($object) {
		$this->object = $object;
	}

	function setCustomer($customer) {
		$this->customer = $customer;
	}

	function setCode($code) {
		$this->code = $code;
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

}
