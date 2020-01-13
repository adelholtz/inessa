<?php

namespace Inessa\ResponseModels\Trinity\PromotionCreate;

class BusinessCase {

	/**
	 * @setMethod setLabel
	 * @attribute label
	 * @var string
	 */
	protected $label;

	/**
	 * @setMethod setValue
	 * @var string
	 */
	protected $value;

	function getLabel() {
		return $this->label;
	}

	function setLabel($label) {
		$this->label = $label;
	}

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}

}
