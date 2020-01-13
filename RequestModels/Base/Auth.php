<?php

namespace Inessa\RequestModels\Base;
use Illuminate\Support\Facades\Session;
use Inessa\RequestModels\Base\BasicNode;

class Auth {
	/**
	 * @setMethod setUser
	 * @getMethod getUser
	 * @type string
	 * @var BasicNode
	 */
	protected $user = null;
	/**
	 * @setMethod setPassword
	 * @getMethod getPassword
	 * @cdataNode
	 * @type string
	 * @var BasicNode
	 */
	protected $password = null;
	/**
	 * @setMethod setContext
	 * @getMethod getContext
	 * @type string
	 * @var BasicNode
	 */
	protected $context = null;

	public function __construct(){
		$this->setUser();
		$this->setPassword();
		$this->setContext();
	}

	function getUser() {
		return $this->user;
	}

	function getPassword() {
		return $this->password;
	}

	function getContext() {
		return $this->context;
	}

	function setUser($user = "") {
		$this->user = new BasicNode($user);
	}

	function setPassword($password = "") {
		$this->password = new BasicNode($password);
	}

	function setContext($context = "") {
		$this->context = new BasicNode($context);
	}


}

?>
