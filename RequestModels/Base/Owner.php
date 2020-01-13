<?php

namespace Inessa\RequestModels\Base;

class Owner {
	/**
	 * @setMethod setUser
	 * @getMethod getUser
	 * @var string 
	 */
	protected $user;
	/**
	 * @setMethod setContext
	 * @getMethod getContext
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
