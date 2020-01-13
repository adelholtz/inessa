<?php

namespace Inessa\ResponseModels\Base;

class BasicListInquire extends Base {

	/**
	 *
	 * @setMethod setSummary
	 * @var integer
	 */
	protected $summary;

	function getSummary() {
		return $this->summary;
	}

	function setSummary($summary) {
		$this->summary = $summary;
	}

}

?>
