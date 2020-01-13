<?php

namespace Inessa\RequestModels\Base;
use Inessa\RequestModels\Base\Attributes;

/*
    Endpoint for all nodes;
    contains value and attributes of a node
 */
class BasicNode implements Attributes{
    /**
     * @param string
     */
    protected $value;
    /**
     * @param array
     */
    protected $attributes = array();

    public function __construct($value = ""){
        $this->setValue($value);
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }

    /**
     * [addAttribute description]
     * @param string $attributeKey
     * @param string $attributeValue
     */
    public function addAttribute($attributeKey, $attributeValue)
    {
        $this->attributes[$attributeKey] = $attributeValue;
		return $this;
    }
    /**
     * @param  string $attributeKey
     * @return mixed  [returns either a string or false if attribute could not be found]
     */
    public function getAttribute($attributeKey)
    {
        if(isset($this->attributes[$attributeKey])){
            return $this->attributes[$attributeKey];
        }
        return false;
    }
    /**
     * @return array
     */
    public function getAttributes(){
        return $this->attributes;
    }
    /**
     * @return boolean
     */
    public function hasAttributes(){
        return count($this->attributes) > 0;
    }
}
