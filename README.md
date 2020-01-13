# Inessa: Annotation based XML reader and writer library

This library is intended to create xml from php objects (through annotations) and vice versa.
The basic principle is: keep it as simple as possible with as much automation as possible but keep the possibility to tweak every single aspect of a read/write process.

Available output formats (XLM -> ?):
* php object structure
* array
* json
* yaml

Basics:
* Always start a new Data/Object structure with the extension of either
    ** Inessa\ResponseModels\Base\Base for read actions
    ** Inessa\RequestModels\Base\Base for write actions
* Object structure has to resemble XML strcture.
* Objects have to be seen as blocks with which you build your data structures
* blocks/objects can be switched and combined in any way

Basic Files:
* Readerclass: XMLObjectBuilder [XML => Object]
* Writerclass: XMLRequestBuilder [Object => XML] ; Achtung: nicht definierte tags werden übersprungen!! (=> führt evtl zu einer flachen Hierarchie)

## Possible annotations

* @setMethod [mandatory for reader] : define the method used to set the value for this variable
* @getMethod [mandatory for writer]: define the method used to get the value for this variable
* @ignore : variables marked like so will be ignored by the reader and writer
* @nodeObject : if the variable is/contains an object itself, tell the reader/writer which object to use; objects have to be given with complete namespace
* @rootNode: only used by the writer; tells the writer where to start with the xml parsing; this is only a class annotation; can be set in any object that extends Inessa\RespsonseModels\Base\Base
* @type [mandatory for writer]

## Reading and Writing attributes

* Objects that need to be able to read/write attributes have to implement one of           
    ** Inessa\ResponseModels\Base\Attributes
    ** Inessa\RequestModels\Base\Attributes
* if you want an attribute to a property/node do it like this:
    ** $view->setOffset(10)->addAttribute("blub","test");
* for specific examples see the examples below

## Basic Example of XML -> Object

Also view examples/read.php.
Most interesteing file: \Inessa\ResponseModels\ZoneListInquire( (if you want to explore, start from here)

```
$xmlResponse =<<<XML
<response>
<result>
<data>
  <summary>81627</summary>
<zone kitkat="gud">
    <changed>2016-10-10 12:42:16</changed>
    <created>2016-10-10 12:42:16</created>
    <name>0-a-000000-ax-1124.com</name>
    <owner>
      <user>root</user>
      <context>1</context>
    </owner>
    ...
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

$zone = new \Inessa\ResponseModels\ZoneListInquire();
$zoneList = $zone->parse($xmlResponse);
```

### ZoneListInquire Structure
* class Base
    ** objs
    ** stid
    ** status [=> \Inessa\ResponseModels\Base\Status]
* class BasicListInquire extends Base
    ** summary
* class ZoneListInquire extends BasicListInquire
    ** zone [=> Inessa\ResponseModels\Zone]

## Basic Example Object -> XML

Also view examples/write.php.
Most interesteing file: \Inessa\RequestModels\ZoneListInquire (if you want to explore, start from here)

```
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
        $view->setOffset(10)->addAttribute("blub","test");
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
    $auth->setUser("blub");
    $auth->setPassword("test");
    $base->setAuth($auth);


$xmlRequestString = $base->build();
```
### Output:
```
<?xml version="1.0"?>
<request>
  <task>
    <view kit="kat">
      <children>0</children>
      <offset blub="test">10</offset>
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
    <user>blub</user>
    <password><![CDATA[test]]></password>
    <context></context>
  </auth>
</request>

```
