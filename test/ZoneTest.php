<?php

require_once("TestInit.php");

class ZoneTest extends \PHPUnit_Framework_TestCase {
	protected function setUp() {

	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

	public function testListInquire(){
		$expectedXML =
<<<XML
<request>
  <task>
    <view kit="kat">
      <children>0</children>
      <offset blub="test">0</offset>
      <limit>25</limit>
    </view>
    <order>
      <key>name</key>
      <mode>ASC</mode>
    </order>
	<key>comment</key>
    <key test="blub2">pepsi</key>
    <code>0205</code>
  </task>
  <auth>
    <user>testuser</user>
    <password><![CDATA[test12%]]></password>
    <context>100</context>
  </auth>
</request>
XML;

		/*
			<?xml version="1.0"?>
				<request>
					<task>
					</task>
				</request>
		 */
		$base = new \Inessa\RequestModels\Base\BasicInquire();

			/*
				<task>
					<view>
					</view>
					<order>
					  <key>name</key>
					  <mode>ASC</mode>
					</order>
					<key>comment</key>
					<key test="blub2">pepsi</key>
					<code>0205</code>
				</task>
			 */
			$task = new \Inessa\RequestModels\Base\ListInquire();
			$task->createOrder('name','ASC');
			$task->addKey("comment");
			$task->addKey("pepsi")->addAttribute("test","blub2");
			$task->setCode('0205');
			$base->setTask($task);

				/*
					<view kit="kat">
					  <children>0</children>
					  <offset blub="test">10</offset>
					  <limit>25</limit>
					</view>
				 */
				$view = new \Inessa\RequestModels\Base\View();
				$view->setLimit(25);
				$view->setOffset(0)->addAttribute("blub","test");
				$view->addAttribute("kit","kat");
				$task->setView($view);

			/*
				<auth>
					<user>blub</user>
					<password><![CDATA[test]]></password>
					<context></context>
				</auth>
			 */
			$auth = new \Inessa\RequestModels\Base\Auth();
			$auth->setUser("testuser");
			$auth->setPassword("test12%");
			$auth->setCOntext("100");
			$base->setAuth($auth);

		$xmlRequestString = $base->build();

		$this->assertXmlStringEqualsXmlString($expectedXML, $xmlRequestString);
	}

	public function testListParse(){
		$xmlResponse =<<<XML
<response>
  <result>
    <data>
      <summary>81627</summary>
	  <zone amity_union="union">
        <changed blub="asdf">2016-10-10 12:42:16</changed>
        <created>2016-10-10 12:42:16</created>
        <name>0-a-000000-ax-1124.com</name>
        <comment/>
        <mainip>1.2.3.4</mainip>
        <primary>pdns1.testsys.autodns2.de</primary>
        <secondary1>pdns2.testsys.autodns2.de</secondary1>
        <domainsafe>0</domainsafe>
        <owner>
          <user>root</user>
          <context>1</context>
        </owner>
        <updated_by>
          <user>root</user>
          <context>1</context>
        </updated_by>
        <system_ns>pdns1.testsys.autodns2.de</system_ns>
        <ns_action>complete</ns_action>
      </zone>
      <zone>
        <changed>2016-10-10 12:42:20</changed>
        <created>2016-10-10 12:42:20</created>
        <name>0-a-000000-ax-1125.com</name>
        <comment/>
        <mainip>1.2.3.4</mainip>
        <primary>pdns1.testsys.autodns2.de</primary>
        <secondary1>pdns2.testsys.autodns2.de</secondary1>
        <domainsafe>0</domainsafe>
        <owner>
          <user>root</user>
          <context>1</context>
        </owner>
        <updated_by>
          <user>root</user>
          <context>1</context>
        </updated_by>
        <system_ns>pdns1.testsys.autodns2.de</system_ns>
        <ns_action>complete</ns_action>
      </zone>
    </data>
    <status>
      <code>S0205</code>
      <text>Zoneninformationen wurden erfolgreich ermittelt.</text>
      <type>success</type>
    </status>
  </result>
  <stid>20161111-app3-dev-6443</stid>
</response>
XML;

		$zone = new \Inessa\ResponseModels\AutoDNS\ZoneListInquire();
		$zoneList = $zone->parse($xmlResponse);
//print_r($zoneList);
//die;
		$this->assertEquals(count($zoneList->getObjs()), 2);
		$this->assertEquals('20161111-app3-dev-6443', $zoneList->getStid()->getValue());
		$this->assertEquals(81627, $zoneList->getSummary()->getValue());
		$this->assertInstanceOf(\Inessa\ResponseModels\Base\Status::class, $zoneList->getStatus());
		$this->assertEquals('S0205', $zoneList->getStatus()->getCode()->getValue());
		$this->assertEquals('Zoneninformationen wurden erfolgreich ermittelt.', $zoneList->getStatus()->getText()->getValue());
		$this->assertEquals('success', $zoneList->getStatus()->getType()->getValue());

		foreach($zoneList->getObjs() as $index => $zone){
			if($index == 0){
				$this->assertEquals("asdf", $zone->getChanged()->getBlub());
				$this->assertEquals("union", $zone->getAmity());
			}
			$this->assertContains($zone->getChanged()->getValue(), ['2016-10-10 12:42:16','2016-10-10 12:42:20']);
			$this->assertContains($zone->getCreated()->getValue(), ['2016-10-10 12:42:16','2016-10-10 12:42:20']);
			$this->assertContains($zone->getName()->getValue(), ['0-a-000000-ax-1124.com','0-a-000000-ax-1125.com']);
			$this->assertEquals('1.2.3.4', $zone->getMainip()->getValue());
			$this->assertEquals('pdns1.testsys.autodns2.de', $zone->getPrimary()->getValue());
			$this->assertEquals('pdns2.testsys.autodns2.de', $zone->getSecondary1()->getValue());
			$this->assertEquals(0, $zone->getDomainsafe()->getValue());
			$this->assertInstanceOf(\Inessa\RequestModels\Base\Owner::class, $zone->getOwner());
			$this->assertInstanceOf(\Inessa\ResponseModels\Base\UpdatedBy::class, $zone->getUpdated_by());
			$this->assertEquals('pdns1.testsys.autodns2.de', $zone->getSystem_ns()->getValue());
			$this->assertEquals('complete', $zone->getNs_action()->getValue());
		}
	}
}

?>
