<?php
namespace Inessa;
use DOMNode;
use ArrayAccess;
use ReflectionClass;
use Inessa\AbstractBuilder;

class XMLArrayBuilder extends AbstractBuilder
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

        $json = array();
        foreach ($elements as $element) {
            $nodes = $element->childNodes;
            if ($nodes->length == 0) {
                continue;
            }
            $json = $this->loopNodes($nodes, $reflection, $baseInstance, $json);
        }

        return $json;
    }

    /**
     * Loop through all nodes given in DOMNodeList ,write to $json Array
     * and return it.
     *
     * @param  DOMNodeList          $nodes
     * @param  ReflectionClass      $reflection
     * @param  ReflectioInstance    $instance
     * @param  array                $json
     * @return array
     */
    public function loopNodes(\DOMNodeList $nodes, \ReflectionClass $reflection, $instance, $json = array())
    {
        foreach ($nodes as $node) {
            // in case a certain node has not been defined in this instance
            // skip the parsing of this level of the current node
            // check for child nodes and proceed with parsing them
            if (!$reflection->hasProperty($node->nodeName)) {
                if ($node->hasChildNodes()) {
                    $childNodes = $node->childNodes;
                    $json = $this->loopNodes($childNodes, $reflection, $instance, $json);
                }
                continue;
            }
            $prop = $reflection->getProperty($node->nodeName);
            $docComment = $prop->getDocComment();
            Annotations::parse($docComment);
            $variableType = Annotations::getVariableType();
            if(!$this->isValidNode($docComment)){
                continue;
            }
            if ($node->hasChildNodes()) {
                $childNodes = $node->childNodes;

                if ($childNodes->length > 1) {
                    if (Annotations::hasNodeObject()) {
                        $nodeValue = $this->processNodeAsObject($node, $childNodes);
                    } else {
                        // skip undefined nodes
                        continue;
                    }
                }else{
                    $nodeValue = $this->processDOMNode($node, $reflection, $instance);
                }
            }else{
                $nodeValue = $this->processDOMNode($node, $reflection, $instance);
            }

            if(!in_array($variableType,array("integer","string"))){
              $json[$node->nodeName][] = !empty($nodeValue)?$nodeValue:"";
            }else{
              $json[$node->nodeName] = $nodeValue;
            }
        }

        return $json;
    }

    /**
     * process given DOMNode and return contents(value, attributes) as array
     *
     * @param  DOMNODE $node
     * @param  ReflectionClass $reflection
     * @param  Object $instance
     * @return array
     */
    private function processDOMNode($node, $reflection, $instance){
        if (Annotations::hasNodeObject()) {
            return $this->processNodeAsObject($node);
        }else{
            return $this->createBasicNodeArray($node, $reflection, $instance);
        }
    }

    /**
     * interpretes given DOMNode as a specific Object given
     * through annotations by @nodeObject
     *
     * @param  DOMNode  $node
     * @param  DOMNode[] $childNodes
     * @return array
     */
    private function processNodeAsObject($node, $childNodes = null){
        $nodeObjectName = Annotations::getNodeObject();
        $nodeReflection = new \ReflectionClass($nodeObjectName);
        $nodeInstance = $nodeReflection->newInstance();

        if(!empty($childNodes)){
            $json = $this->loopNodes($childNodes, $nodeReflection, $nodeInstance, array());
            if($node->hasAttributes()){
                $this->pushAttributesToNodeArray($node, $nodeReflection, $nodeInstance, $json);
            }
            return $json;
        }else{
            return $this->createBasicNodeArray($node, $nodeReflection, $nodeInstance);
        }
    }

    /**
     * Simply creates a basic array for given DOMNode
     * example:
     *  [
     *      "value" => "value",
     *      "attr1" => "attr1"
     *       ...
     *  ]
     *
     * @param  DOMNode $node
     * @return array
     */
    private function createBasicNodeArray($node, $reflection, $instance){
        $basicNodeArray = array();
        $basicNodeArray["value"] = !empty($node->nodeValue)?$node->nodeValue:"";
        if($node->hasAttributes()){
            $this->pushAttributesToNodeArray($node, $reflection, $instance, $basicNodeArray);
        }

        return $basicNodeArray;
    }

    /**
     *
     * @param  DOMNode $node
     * @param  array $basicNodeArray
     */
    private function pushAttributesToNodeArray($node, $nodeReflection, $nodeInstance, &$basicNodeArray){
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
                $basicNodeArray[$attribute->nodeName] = $attribute->nodeValue;
            }
        }
    }
}
