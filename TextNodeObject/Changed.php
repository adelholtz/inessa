<?php

namespace Inessa\TextNodeObject;

class Changed{
    /**
     * @setMethod setValue
     * @var string
     */
    protected $value;
    /**
     * @setMethod setBlub
     * @attribute blub
     * @var string
     */
    protected $blub;

    public function getValue(){
        return $this->value;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function getBlub(){
        return $this->blub;
    }

    public function setBlub($blub){
        $this->blub = $blub;
    }

}
