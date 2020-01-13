<?php

namespace Inessa\ResponseModels\AutoDNS;
use Inessa\TextNodeObject\Changed;

class Zone{
	/**
	 * @setMethod setAmity
	 * @attribute amity_union
	 * @var string
	 */
	protected $amityUnion;

	/**
	 * @nodeObject Inessa\TextNodeObject\Changed
	 * @setMethod setChanged
	 * @var Changed
	 */
	protected $changed;
	/**
	 * @setMethod setCreated
	 */
	public $created;
	/**
	 * @setMethod setName
	 * @getMethod getName
	 * @var string
	 */
	protected $name;
	/**
	 * @setMethod setMainip
	 * @var string
	 */
	protected $mainip;
	/**
	 * @setMethod setPrimary
	 * @var string
	 */
	protected $primary;
	/**
	 * @setMethod setSecondary1
	 * @var string
	 */
	protected $secondary1;
	/**
	 * @setMethod setDomainsafe
	 * @var string
	 */
	protected $domainsafe;
	/**
	 * @setMethod setOwner
	 * @nodeObject Inessa\RequestModels\Base\Owner
	 * @var Owner
	 */
	protected $owner;
	/**
	 * @setMethod setUpdated_by
	 * @nodeObject Inessa\ResponseModels\Base\UpdatedBy
	 * @var UpdatedBy
	 */
	protected $updated_by;
	/**
	 * @setMethod setSystem_ns
	 * @var string
	 */
	protected $system_ns;
	/**
	 * @setMethod setNs_action
	 * @var string
	 */
	protected $ns_action;

	function getChanged() {
		return $this->changed;
	}

	function getCreated() {
		return $this->created;
	}

	function getName() {
		return $this->name;
	}

	function getMainip() {
		return $this->mainip;
	}

	function getPrimary() {
		return $this->primary;
	}

	function getSecondary1() {
		return $this->secondary1;
	}

	function getDomainsafe() {
		return $this->domainsafe;
	}

	function getOwner() {
		return $this->owner;
	}

	function getUpdated_by() {
		return $this->updated_by;
	}

	function getSystem_ns() {
		return $this->system_ns;
	}

	function getNs_action() {
		return $this->ns_action;
	}

	function setChanged($changed) {
		$this->changed = $changed;
	}

	function setCreated($created) {
		$this->created = $created;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setMainip($mainip) {
		$this->mainip = $mainip;
	}

	function setPrimary($primary) {
		$this->primary = $primary;
	}

	function setSecondary1($secondary1) {
		$this->secondary1 = $secondary1;
	}

	function setDomainsafe($domainsafe) {
		$this->domainsafe = $domainsafe;
	}

	function setOwner($owner) {
		$this->owner = $owner;
	}

	function setUpdated_by($updated_by) {
		$this->updated_by = $updated_by;
	}

	function setSystem_ns($system_ns) {
		$this->system_ns = $system_ns;
	}

	function setNs_action($ns_action) {
		$this->ns_action = $ns_action;
	}

	public function setAmity($amityUnion){
		$this->amityUnion = $amityUnion;
	}
	public function getAmity(){
		return $this->amityUnion;
	}
}

?>
