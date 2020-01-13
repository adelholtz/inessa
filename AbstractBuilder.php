<?php
namespace Inessa;

abstract class AbstractBuilder{

  /*
	 * type \DOMDocument
	 */
	protected $domDocument;
	protected $model;

  public function __construct(\DOMDocument $domDocument) {
    $this->domDocument = $domDocument;
    return;
  }

  public function loadXML($xmlString){
    $this->domDocument->loadXML($xmlString);
  }

  public function useModel($model){
    $this->model = $model;
  }

  abstract public function parse();

  abstract public function loopNodes(\DOMNodeList $nodes, \ReflectionClass $reflection, $instance, $json = array());

  public function isValidNode($docComment){
      if(Annotations::doIgnore()){
          return false;
      }
      if(!Annotations::hasSetMethod()){
          return false;
      }

      return true;
  }

  public function getVariableType($docComment){
      if (!preg_match_all('#\s*\*\s*@var\s+([^*]*)#s', $docComment, $matches, PREG_SET_ORDER)) {
          return "";
      }

      return trim($matches[0][1]);
  }
}
