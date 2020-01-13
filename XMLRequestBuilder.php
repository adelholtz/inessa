<?php

namespace Inessa;

class XMLRequestBuilder {

	/**
	 *
	 * @var \DOMDocument
	 */
	private $domDocument;
	/**
	 * Base Model of the XML Structure we want to generate
	 * @var Obj
	 */
	private $model = false;
	/**
	 *
	 * @param \DOMDocument $domDocument
	 */
	public function __construct(\DOMDocument $domDocument) {
		$domDocument->formatOutput = true;
		$newNode = $domDocument->createElement('request');
		$domDocument->appendChild($newNode);
		$this->domDocument = $domDocument;
	}
	/**
	 *
	 * @param Obj $model
	 */
	public function useModel($model) {
		$this->model = $model;
	}

	/**
	 *
	 * @param type $model
	 * @return type
	 */
	public function build($model = false) {
		if($model){
			$this->model = $model;
		}
		$reflection = new \ReflectionClass(get_class($this->model));
		$properties = $reflection->getProperties();
		if (count($properties) > 0) {
			try{
				$this->loopProperties($properties, $this->domDocument->firstChild, $this->model);
			}catch(InessaException $ex){
				print_r($ex->inessaErrorMessage());
				die;
			}

		}

		return $this->domDocument->saveXML();
	}

	/**
	 *
	 * @param array $properties
	 * @param DOMNode $node
	 * @param Obj $model
	 */
	public function loopProperties($properties,\DOMNode $node, $model) {
		foreach ($properties as $prop) {
			$docComment = $prop->getDocComment();
			if (preg_match('#\s*\*\s*@ignore\s+([^*]*)#s', $docComment, $matches)) {
				continue;
			}
			// check if this property itself is another nodeObject
			// if it is, we have to go down a level deeper and use the corresponding object to get the data for this node
			// $matches[2] -> @nodeObject
			if (preg_match('#\s*\*\s*@nodeObject\s+([^*]*)#s', $docComment, $matches)) {
				$reflection = new \ReflectionClass(trim($matches[1]));
				$properties = $reflection->getProperties();
				if (count($properties) > 0) {
					// $methodMatches[2] -> getMethod
					if (!preg_match('#\s*\*\s*@getMethod\s+([^*]*)#s', $docComment, $methodMatches)) {
						continue;
					}
					$getMethod = trim($methodMatches[1]);

					// handling an array of objects
					if (preg_match('#\s*\*\s*@type\sarray\s+([^*]*)#s', $docComment, $arrayMatches)) {
						foreach($model->$getMethod() as $m){
							$newNode = $this->domDocument->createElement($prop->getName());
							$this->addAttributesToNode($model, $newNode);
							$node->appendChild($newNode);
							$this->loopProperties($properties, $newNode, $m);
						}
						continue;
					}

					$newNode = $this->domDocument->createElement($prop->getName());
					$this->addAttributesToNode($model, $newNode);
					$node->appendChild($newNode);

					$this->loopProperties($properties, $newNode, $model->$getMethod());
				}
				continue;
			}
			// check for getMethod and if it is a cdataNode
			// $methodMatches[2] -> getMethod
			// isset($methodMatches[4]) -> cdataNode
			if (!preg_match('#(\s*\*\s*@getMethod\s+([^*]*))(\s*\*\s*(@cdataNode)\s+([^*]*))?#s', $docComment, $methodMatches)) {
				continue;
			}

			$this->addAttributesToNode($model, $node);

			$getMethod = trim($methodMatches[2]);
			// special handling for array structures
			if (preg_match('#\s*\*\s*@type\sarray\s+([^*]*)#s', $docComment, $arrayMatches)) {
				$items = $model->$getMethod();
				foreach ($items as $item) {
					// just generate and append the new node to the current node
					$this->appendNode($node, $prop->getName(), $item, isset($methodMatches[4]));
				}
				continue;
			}

			// just generate and append the new node to the current node
			$this->appendNode($node, $prop->getName(), $model->$getMethod(), isset($methodMatches[4]));
		}
	}

	/**
	 * just generate and append the new node to the current node
	 *
	 * @param DOMNode $parentNode
	 * @param string $nodeName
	 * @param BasicNode $basicNode
	 * @param boolean $isCdataBlock
	 */
	private function appendNode($parentNode, $nodeName, $basicNode, $isCdataBlock = false){
		if ($isCdataBlock) {
			$newNode = $this->domDocument->createElement($nodeName);
			$newNode->appendChild($this->domDocument->createCDATASection($basicNode->getValue()));
		} else {
			$newNode = $this->domDocument->createElement($nodeName);
			if(!empty($basicNode) || $basicNode === 0){
				if(gettype($basicNode) != "object"){
					throw new InessaException($parentNode, $nodeName, $basicNode,
						"Expected basicNode to be an object. Got something else instead.");
				}
				$textNode = $this->domDocument->createTextNode((string)$basicNode->getValue());
				$this->addAttributesToNode($basicNode, $newNode);
				$newNode->appendChild($textNode);
			}
		}
		$parentNode->appendChild($newNode);
	}

	/**
	 *
	 * @param Object $instance
	 * @param DOMNode $node
	 */
	private function addAttributesToNode($instance, $node){
		if(method_exists($instance, "hasAttributes") && $instance->hasAttributes()){
			foreach($instance->getAttributes() as $attributeKey => $attributeValue){
				$attr = $this->domDocument->createAttribute((string)$attributeKey);
				$attr->value = (string) $attributeValue;
				$node->appendChild($attr);
			}
		}
	}
}

?>
