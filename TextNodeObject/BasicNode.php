<?php

namespace Inessa\TextNodeObject;

class BasicNode{

    protected $value;

    public function setValue($value){
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }

}
