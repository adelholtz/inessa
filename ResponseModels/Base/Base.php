<?php

namespace Inessa\ResponseModels\Base;
use Inessa\XMLObjectBuilder;
use Inessa\XMLArrayBuilder;
use Nette\Object;
use Symfony\Component\Yaml\Yaml;

class Base {
	/**
	 *
	 * @var XMLObjectBuilder
	 */
	private $xmlOB;
	/**
	 * @ignore
	 * @var array
	 */
	private $objs = [];
	/**
	 * @nodeObject Inessa\ResponseModels\Base\Status
	 * @setMethod setStatus
	 * @var \Inessa\ResponseModels\Base\Status
	 */
	protected $status;
	/**
	 * @setMethod setStid
	 * @var string
	 */
	protected $stid;

	public function __construct() {

	}

	/**
	 * Returns an Object/Instance representation of the supplied $xmlString
	 *
	 * @param  string $xmlString [valid xml as string]
	 * @return Object            [instance that called ->parse()]
	 */
	public function parse($xmlString){
		$this->xmlOB = new XMLObjectBuilder(new \DOMDocument());
		$this->xmlOB->loadXML($xmlString);
		return $this->xmlOB->parse($this);
	}
	/**
	 * Returns a string containing the JSON representation
	 * of the supplied $xmlString
	 *
	 * @param  string $xmlString [valid xml as string]
	 * @return string            [JSON format]
	 */
	public function parseJson($xmlString){
		$this->xmlOB = new XMLArrayBuilder(new \DOMDocument());
		$this->xmlOB->loadXML($xmlString);
		return json_encode($this->xmlOB->parse($this));
	}
	/**
	 * Returns an array	of the supplied $xmlString
	 *
	 * @param  string $xmlString [valid xml as string]
	 * @return array
	 */
	public function parseArray($xmlString){
		$this->xmlOB = new XMLArrayBuilder(new \DOMDocument());
		$this->xmlOB->loadXML($xmlString);
		return $this->xmlOB->parse($this);
	}
	/**
	 * https://symfony.com/doc/current/components/yaml.html
	 *
	 * Returns a string containing the YAML representation
	 * of the supplied $xmlString.
	 *
	 * @param  string $xmlString [valid xml as string]
	 * @return string            [YAML]
	 */
	public function parseYaml($xmlString){
		$this->xmlOB = new XMLArrayBuilder(new \DOMDocument());
		$this->xmlOB->loadXML($xmlString);
		return Yaml::dump($this->xmlOB->parse($this), 2, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
	}

	/**
	 *
	 * @return \Inessa\ResponseModels\Base\Status
	 */
	function getStatus() {
		return $this->status;
	}
	/**
	 *
	 * @param \Inessa\ResponseModels\Base\Status $status
	 */
	function setStatus(Status $status) {
		$this->status = $status;
	}
	/**
	 *
	 * @return array
	 */
	function getObjs() {
		return $this->objs;
	}
	/**
	 *
	 * @param array $objs
	 */
	function setObjs($objs) {
		$this->objs = $objs;
	}
	public function addObj($obj){
		array_push($this->objs, $obj);
	}
	/**
	 *
	 * @return string
	 */
	function getStid() {
		return $this->stid;
	}
	/**
	 *
	 * @param string $stid
	 */
	function setStid($stid) {
		$this->stid = $stid;
	}
}

?>
