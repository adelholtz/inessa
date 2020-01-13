<?php

namespace Inessa\RequestModels\Trinity\PromotionCreate;

use Inessa\RequestModels\Base\BasicNode;
use Inessa\RequestModels\Trinity\PromotionCreate\Product;

class BillingEventPromotionCode {

	/**
	 * @getMethod getCustomer
	 * @setMethod setCustomer
	 * @type string
	 * @var BasicNode
	 */
	protected $customer;

	/**
	 * @nodeObject Inessa\RequestModels\Trinity\PromotionCreate\Product
	 * @getMethod getProduct
	 * @setMethod setProduct
	 * @var Product
	 */
	protected $product;

	/**
	 * @getMethod getObject
	 * @setMethod setObject
	 * @type string
	 * @var BasicNode
	 */
	protected $object;

	/**
	 * @getMethod getCode
	 * @setMethod setCode
	 * @type string
	 * @var BasicNode
	 * @ignore
	 */
	protected $code;

	function getCustomer() {
		return $this->customer;
	}

	function getProduct() {
		return $this->product;
	}

	function getObject() {
		return $this->object;
	}

	function getCode() {
		if (!empty($this->code)) {
			return $this->code;
		}
	}

	/**
	 * 
	 * @param string $customer
	 * @return BasicNode
	 */
	function setCustomer($customer = "") {
		$this->customer = new BasicNode($customer);
		return $this->customer;
	}

	function setProduct($product = "") {
		$this->product = $product;
	}

	function setObject($object = "") {
		$this->object = new BasicNode($object);
	}

	function setCode($code = "") {
		$this->code = new BasicNode($code);
	}

}
