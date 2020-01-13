<?php

namespace Inessa\ResponseModels\Base;
 
class Owner  {

	/**
	 * @setMethod setUser
	 * @getMethod getUser
	 * @type string
	 * @var BasicNode
	 */
	protected $user;

	/**
	 * @setMethod setContext
	 * @attribute context
	 * @var string
	 */
	protected $context; 
	
	

	function getUser() {
		return $this->user;
	}

	function getContext() {
		return $this->context;
	}

	function setUser($user = "") {
		$this->user = $user;
	}

	function setContext($context = "") {
		$this->context = $context;
	}

}
