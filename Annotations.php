<?php

namespace Inessa;

class Annotations{

    private static $instance = null;
    /**
     * @var boolean
     */
    private $ignore = false;
    /**
     * @var string
     */
    private $setMethod = null;
    /**
     * @var string
     */
    private $getMethod = null;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $nodeObject = null;
    /**
     * @var string
     */
    private $rootNode;
    private $attribute = false;
    /**
     * @var string
     */
    private $attributeName;
    /**
     * @var string
     */
    private $nodeName;
    /**
     * @var string
     */
    private $variableType = "";

    /**
     * parses a provived php documentation block
     *
     * @param  string $docBlock
     */
    static public function parse($docBlock){
        self::$instance = new self();
        if (preg_match('#\s*\*\s*@ignore\s+([^*]*)#s', $docBlock, $matches)) {
           self::$instance->setIgnore(true);
        }
        if (preg_match('#\s*\*\s*@setMethod\s+([^*]*)#s', $docBlock, $matches)) {
            self::$instance->setSetMethod(trim($matches[1]));
        }
        if (preg_match('#\s*\*\s*@attribute\s+([^*]*)#s', $docBlock, $matches)) {
            self::$instance->setAttribute(true);
            if($matches[1]){
                self::$instance->setAttributeName(trim($matches[1]));
            }
        }
        if (preg_match('#\s*\*\s*@nodeObject\s+([^*]*)#s', $docBlock, $matches)) {
            self::$instance->setNodeObject(trim($matches[1]));
        }
        if (preg_match('#\s*\*\s*@nodeName\s+([^*]*)#s', $docBlock, $matches)) {
            self::$instance->setNodeName(trim($matches[1]));
        }
        if (preg_match('#\s*\*\s*@var\s+([^*]*)#s', $docBlock, $matches)) {
            self::$instance->setVariableType(trim($matches[1]));
        }
    }

    /**
     * @return string
     */
    public static function getInstance() {
		return self::$instance;
	}
    /**
     * @param string $setMethod
     */
    public function setSetMethod($setMethod){
        $this->setMethod = $setMethod;
    }
    /**
     * @return string
     */
    static public function getSetMethod(){
        return self::$instance->setMethod;
    }
    /**
     * @return boolean
     */
    static public function hasSetMethod(){
        return self::$instance->setMethod != null ? true : false;
    }

    /**
     * @param boolean $ignore
     */
    public function setIgnore($ignore){
        $this->ignore = $ignore;
    }
    /**
     * @return boolean
     */
    static public function doIgnore(){
        return self::$instance->ignore;
    }
    /**
     * @param string $attribute
     */
    public function setAttribute($attribute){
        $this->attribute = $attribute;
    }
    /**
     * @return boolean
     */
    static public function hasAttribute(){
        return self::$instance->attribute;
    }
    /**
     * @param string $nodeObject
     */
    public function setNodeObject($nodeObject){
        $this->nodeObject = $nodeObject;
    }
    /**
     * @return string
     */
    static public function getNodeObject(){
        return self::$instance->nodeObject;
    }

    static public function hasNodeObject(){
        return self::$instance->nodeObject != null ? true : false;
    }
    /**
     * @param string $nodeName
     */
    public function setNodeName($nodeName){
        $this->nodeName = $nodeName;
    }
    /**
     * @return string
     */
    static public function getNodeName(){
        return self::$instance->nodeName;
    }
    /**
     * @return boolean
     */
    static public function hasNodeName(){
        return self::$instance->nodeName != null ? true : false;
    }
    /**
     * @param string $attributeName
     */
    public function setAttributeName($attributeName){
        $this->attributeName = $attributeName;
    }
    /**
     * @return string
     */
    static public function getAttributeName(){
        return self::$instance->attributeName;
    }
    /**
     * @param string $variableType
     */
    public function setVariableType($variableType){
        $this->variableType = $variableType;
    }
    /**
     * @return string
     */
    static public function getVariableType(){
        return self::$instance->variableType;
    }
}

?>
