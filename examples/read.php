<?php
require_once("../test/TestInit.php");


$xmlResponse =<<<XML
<response>
<result>
<data>
  <summary>81627</summary>
<zone amity_union="gud">
    <changed blub="test"/>
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
  <zone kitkat="test2">
    <changed>2016-10-10 12:42:20</changed>
    <created>2016-10-10 12:42:20</created>
    <name>0-a-000000-ax-1125.com</name>
    <comment/>
    <mainip blub="hans">1.2.3.4</mainip>
    <primary>pdns1.testsys.autodns2.de</primary>
    <secondary1>pdns2.testsys.autodns2.de</secondary1>
    <domainsafe>0</domainsafe>
    <owner>
      <user>root</user>
      <context>1</context>
    </owner>
    <updated_by>
      <user attribute="pepsi">root</user>
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
$zoneList = $zone->parseJson($xmlResponse);

print_r($zoneList);
//var_dump($zoneList->getStatus()->getCode()->getValue());
// foreach($zoneList->getObjs() as $obj){
//     print_r($obj);
//     print_r($obj->getAttribute('kitkat'));
//     print_r("\n");
//     print_r($obj->getMainIp()->getAttribute('blub'));
//     print_r("\n");
//     print_r($obj->getUpdated_by()->getUser()->getValue());
// };
// print_r($zoneList->getAttributes("zone_0"));
// print_r($zoneList->getAttributes("zone_1"));
?>
