<?php

namespace Inessa\RequestModels\Base;

class ListInquire extends Task implements Attributes
{
    /**
     * @getMethod getView
     * @setMethod setView
     * @nodeObject Inessa\RequestModels\Base\View
     * @var View
     */
    protected $view = null;
    /**
     * @getMethod getOrder
     * @setMethod setOrder
     * @nodeObject Inessa\RequestModels\Base\Order
     * @var Order
     */
    protected $order;
    /**
     * @setMethod setKeys
     * @getMethod getKeys
     * @type array
     * @var BasicNode[]
     */
    protected $key = [];

    protected $attributes;

    function getView()
    {
        if($this->view == null){
            return new View();
        }
        return $this->view;
    }

    function setView($view)
    {
        $this->view = $view;
    }

    function getOrder()
    {
        return $this->order;
    }


    public function createOrder($key, $mode)
    {
        $order = new Order();
        $order->setKey($key);
        $order->setMode($mode);
        $this->order = $order;
    }

    function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function addKey($key)
    {
        $this->key[$key] = new BasicNode($key);
		return $this->key[$key];
    }

	public function getKey($key){
		return $this->key[$key];
	}

    function getKeys()
    {
        return $this->key;
    }

    function setKeys($keys)
    {
        foreach($keys as $key){
            $this->addKey($key);
        }
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
