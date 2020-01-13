<?php

namespace Inessa\RequestModels\AutoDNS;
use Inessa\RequestModels\Base\ListInquire;

class ZoneListInquire extends ListInquire{

	public function __construct(){
		$this->setKeys(['comment','created','mainip','ns_action','ns_group','primary','secondary1','secondary2','secondary3','secondary4','secondary5','secondary6','secondary7','updated_by']);
	//	$this->addKey("pepsi")->addAttribute("test","blub2");

		$this->setCode('0205');
	}

}

?>
