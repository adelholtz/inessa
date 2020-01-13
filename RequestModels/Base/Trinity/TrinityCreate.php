<?php


namespace Inessa\RequestModels\Base\Trinity;

use Inessa\RequestModels\Base\Auth;
use Inessa\RequestModels\Base\Base;
use Inessa\RequestModels\Trinity\PromotionCreate\PromotionCreate;


class TrinityCreate extends Base  {

	/**
	 * @nodeObject Inessa\RequestModels\Trinity\PromotionCreate\PromotionCreate
	 * @getMethod getCreate
	 * @setMethod setCreate
	 * @var PromotionCreate
	 */

	protected $create = null;

	/**
	 * @nodeObject Inessa\RequestModels\Base\Auth
	 * @getMethod getAuth
	 * @setMethod setAuth
	 * @var Auth
	 */
	protected $auth = null;


	function getAuth() {
		if($this->auth == null){
			return new \Inessa\RequestModels\Base\Auth();
		}
		return $this->auth;
	}



	function setAuth(Auth $auth) {
		$this->auth = $auth;
	}


	function getCreate() {
		return $this->create;
	}


	function setCreate(PromotionCreate $create) {
		$this->create = $create;
	}



}
