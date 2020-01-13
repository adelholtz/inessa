<?php

namespace Inessa\ResponseModels\Trinity\PromotionCreate;

class Article {

	/**
	 * @setMethod setLabel
	 * @attribute label
	 * @var string
	 */
	protected $label;

	/**
	 * @setMethod setType
	 * @attribute type
	 * @var string
	 */
	protected $type;

	function getLabel() {
		return $this->label;
	}

	function setLabel($label) {
		$this->label = $label;
	}

	function getType() {
		return $this->type;
	}

	function setType($type) {
		$this->type = $type;
	}

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}

}
