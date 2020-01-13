<?php

namespace Inessa\RequestModels\Base;

class BasicInquire extends Base{
	/**
	 * @nodeObject Inessa\RequestModels\Base\ListInquire
	 * @getMethod getTask
	 * @setMethod setTask
	 * @var Task
	 */
	protected $task;

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
	/**
	 *
	 * @param \Inessa\RequestModels\Base\Auth $auth
	 */
	function setAuth(Auth $auth) {
		$this->auth = $auth;
	}

	function getTask() {
		return $this->task;
	}
	/**
	 *
	 * @param \Inessa\RequestModels\Base\Task $task
	 */
	function setTask(Task $task) {
		$this->task = $task;
	}

}

?>
