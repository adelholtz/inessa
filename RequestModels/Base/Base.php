<?php

namespace Inessa\RequestModels\Base;

class Base {

	public function build(){
		$xmlRB = new \Inessa\XMLRequestBuilder(new \DOMDocument());
		return $xmlRB->build($this);
	}

}

?>
