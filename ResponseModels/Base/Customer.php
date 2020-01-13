<?php

namespace Inessa\ResponseModels\Base;

class Customer {

	/**
	 * @setMethod setNumber
	 * @attribute number
	 * @var string
	 */
	protected $number;

	/**
	 * @setMethod setClient
	 * @attribute client
	 * @var string
	 */
	protected $client;

	function getClient() {
		return $this->client;
	}

	function getNumber() {
		return $this->number;
	}

	function setClient($client) {
		$this->client = $client;
	}

	function setNumber($number) {
		$this->number = $number;
	}

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}

}
