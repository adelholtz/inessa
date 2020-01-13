<?php

namespace Inessa\RequestModels\Base;

class View implements Attributes{
	/**
	 * @setMethod setChildren
	 * @getMethod getChildren
	 * @type integer
	 * @var BasicNode
	 */
	protected $children;
	/**
	 * @setMethod setOffset
	 * @getMethod getOffset
	 * @type integer
	 * @var BasicNode
	 */
	protected $offset;
	/**
	 * @setMethod setLimit
	 * @getMethod getLimit
	 * @type integer
	 * @var BasicNode
	 */
	protected $limit;

	protected $attributes;

	public function __construct(){
		$this->setChildren();
		$this->setOffset();
		$this->setLimit();
	}

	function getChildren() {
		return $this->children;
	}

	function getOffset() {
		return $this->offset;
	}

	function getLimit() {
		return $this->limit;
	}
	/**
	 * @param integer $children
	 * @return BasicNode
	 */
	function setChildren($children = 0) {
		$this->children = new BasicNode($children);
		return $this->children;
	}
	/**
	 * @param integer $offset
	 * @return BasicNode
	 */
	function setOffset($offset = 0) {
		$this->offset = new BasicNode($offset);
		return $this->offset;
	}
	/**
	 * @param integer $limit
	 * @return BasicNode
	 */
	function setLimit($limit = 25) {
		$this->limit = new BasicNode($limit);
		return $this->limit;
	}

	/**
	 * [addAttribute description]
	 * @param string $attributeKey
	 * @param string $attributeValue
	 */
	public function addAttribute($attributeKey, $attributeValue)
    {
        $this->attributes[$attributeKey] = $attributeValue;
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

?>
