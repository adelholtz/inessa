<?php

namespace Inessa\RequestModels\Base;

interface Attributes {
    /**
     * [addAttribute description]
     * @param string $attributeKey
     * @param string $attributeValue
     */
    public function addAttribute($attributeKey, $attributeValue);
    // {
    //     $this->attributes[$attributeKey] = $attributeValue;
    // }
    /**
     * @param  string $attributeKey
     * @return mixed  [returns either a string or false if attribute could not be found]
     */
    public function getAttribute($attributeKey);
    // {
    //     return $this->attributes[$attributeKey];
    // }
    /**
     * @return array
     */
    public function getAttributes();
    // {
    //     return $this->attributes;
    // }
    /**
     * @return boolean
     */
    public function hasAttributes();
    // {
    //     return count($this->attributes) > 0;
    // }
}
