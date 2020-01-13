<?php

namespace Inessa\ResponseModels\AutoDNS;

use Inessa\ResponseModels\Base\BasicListInquire;

class ZoneListInquire extends BasicListInquire {

	/**
	 * @setMethod addObj
	 * @nodeObject Inessa\ResponseModels\AutoDNS\Zone	 
	 * @var array
	 */
	protected $zone = [];

	function getZone() {
		return $this->zone;
	}

	function setZone($zone) {
		$this->zone = $zone;
	}

	public function addZone($zone){
		array_push($this->zone, $zone);
	}
}

?>
