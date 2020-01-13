<?php

namespace Inessa;

class InessaException extends \Exception
{
    private $parentNode;
    private $nodeName;
    private $basicNode;
    private $inessaMessage;

    // Redefine the exception so message isn't optional
    public function __construct($parentNode, $nodeName, $basicNode,$message) {
        $this->parentNode = $parentNode;
        $this->nodeName = $nodeName;
        $this->basicNode = $basicNode;
        $this->inessaMessage = $message;

        // make sure everything is assigned properly
        parent::__construct("", 0, null);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function inessaErrorMessage() {
        echo
        "Inessa Exception:\n".
        "\tparentNode:".$this->parentNode->nodeName."\n".
        "\tnodeName:".$this->nodeName."\n".
        "\tbasicNodetype:".gettype($this->basicNode)."\n".
        "\tMesage:".$this->inessaMessage;
    }
}
