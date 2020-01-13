<?php

namespace Inessa\ResponseModels\Base;

class UpdatedBy {
	/**
	 * @setMethod setUser
	 * @var string
	 */
	protected $user;
	/**
	 * @setMethod setContext
	 * @var string
	 */
	protected $context;

	function getUser() {
		return $this->user;
	}

	function getContext() {
		return $this->context;
	}

	function setUser($user) {
		$this->user = $user;
	}

	function setContext($context) {
		$this->context = $context;
	}
}

?>
