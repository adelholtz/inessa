<?php

namespace Inessa;
use DOMNode;
use ReflectionClass;
use Inessa\Annotations;
use Inessa\ResponseModels\Base\BasicNode;
use Inessa\ResponseModels\Base\Attributes;

class XMLObjectBuilder extends AbstractBuilder
{

    public function parse($model = false)
    {
        if ($model) {
            $this->model = $model;
        }
        $objArr = [];

        $reflection = new \ReflectionClass(get_class($this->model));
        $baseInstance = $reflection->newInstance();
        $classComment = $reflection->getDocComment();
        if (!preg_match_all('#\s*\*\s*@rootNode\s+([^*]*)#s', $classComment, $rootNodeMatches, PREG_SET_ORDER)) {
            $rootNodeXPath = '/';
        } else {
            $rootNodeXPath = trim($rootNodeMatches[0][1]);
        }

        $xpath = new \DOMXPath($this->domDocument);
        $elements = $xpath->query($rootNodeXPath);

        foreach ($elements as $element) {
            $nodes = $element->childNodes;
            if ($nodes->length == 0) {
                continue;
            }
            $this->loopNodes($nodes, $reflection, $baseInstance);
        }

        return $baseInstance;
    }

    /**
     * Loop through all nodes given in DOMNodeList and write all values and Attributes
     * to Objects as defined in $reflection/$instance
     *
     * @param  DOMNodeList          $nodes
     * @param  ReflectionClass      $reflection
     * @param  ReflectionInstance   $instance
     * @param  array                $json
     * @return array
     */
    public function loopNodes(\DOMNodeList $nodes, \ReflectionClass $reflection, $instance, $json = array())
    {
        $nodeIndex = 0;
        foreach ($nodes as $node) {

            // in case a certain node has not been defined in this instance
            // skip the parsing of this level of the current node
            // check for child nodes and proceed with parsing them
            if (!$reflection->hasProperty($node->nodeName)) {
                if ($node->hasChildNodes()) {
                    $childNodes = $node->childNodes;
                    $this->loopNodes($childNodes, $reflection, $instance);
                }
                continue;
            }
            // basic constraint check
            // @setMethod has to be present
            $prop = $reflection->getProperty($node->nodeName);
            $docComment = $prop->getDocComment();
            Annotations::parse($docComment);
            $setMethod = Annotations::getSetMethod();
            if(!$this->isValidNode($docComment)){
                continue;
            }

            if ($node->hasChildNodes()) {
                $childNodes = $node->childNodes;
                if ($childNodes->length > 1) {
                    if (Annotations::hasNodeObject()) {
                        $nodeValue = $this->processNodeAsObject($node, $childNodes);
                    } else {
                        continue;
                    }
                }else {
					if (Annotations::hasNodeObject()) {
					 $nodeValue = $this->processDOMNode($node, $childNodes);
					}else{
						 $nodeValue = $this->processDOMNode($node);
					}
                }
            }else{
                $nodeValue = $this->processDOMNode($node);
            }

            $instance->$setMethod($nodeValue);
        }
    }

    /**
     * process given DOMNode and return contents (value, attributes)
     * in object format;
     * either as BasicNode or as an object provided by @nodeObject
     *
     * @param  DOMNode $node
     * @return Object (BasicNode|@nodeObject)
     */
    private function processDOMNode($node, $childNodes = null){
        if (Annotations::hasNodeObject()) {
            return $this->processNodeAsObject($node, $childNodes);
        }else{
            return $this->createBasicNodeObject($node);
        }
    }

    /**
     * interpretes given DOMNode as a specific Object provided by @nodeObject
     *
     * @param  DOMNode  $node
     * @return Object
     */
    private function processNodeAsObject($node, $childNodes = null){
        $nodeObjectName = Annotations::getNodeObject();
        $nodeReflection = new \ReflectionClass($nodeObjectName);
        $nodeInstance = $nodeReflection->newInstance();

        if(!empty($childNodes)){
            $this->loopNodes($childNodes, $nodeReflection, $nodeInstance);
        }else{
            $nodeInstance->setValue($node->nodeValue);
        }
        if($node->hasAttributes()){
            $this->handleAttributes($node, $nodeReflection, $nodeInstance);
        }
        return $nodeInstance;
    }

    /**
     * Simply create a BasicNode Object, set value and attributes and return it
     *
     * @param  DOMNode $node
     * @return Inessa\ResponseModels\Base\BasicNode
     */
    private function createBasicNodeObject($node){
        $basicNodeReflection = new \ReflectionClass("Inessa\TextNodeObject\BasicNode");
        $basicNodeInstance = $basicNodeReflection->newInstance();
        $basicNodeInstance->setValue($node->nodeValue);
        return $basicNodeInstance;
    }

    /**
     * Set Attributes of current DOMNode as properties of given Object($nodeInstance
     * )
     * @param  DOMNode $node
     * @param  ReflectionClass $nodeReflection
     * @param  Object $nodeInstance
     */
    private function handleAttributes($node, $nodeReflection, $nodeInstance){
        foreach($node->attributes as $attribute){
            if($nodeReflection->hasProperty($attribute->nodeName)){
                $property = $nodeReflection->getProperty($attribute->nodeName);
                Annotations::parse($property->getDocComment());
            }else{
                foreach($nodeReflection->getProperties() as $property){
                    Annotations::parse($property->getDocComment());
                    if(Annotations::getAttributeName() == $attribute->nodeName){
                        break;
                    }
                }
            }

            if (Annotations::hasAttribute()) {
                $setMethod = Annotations::getSetMethod();
                $nodeInstance->$setMethod($attribute->nodeValue);
            }
        }
    }
}
