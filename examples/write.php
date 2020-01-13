<?php

require_once("../test/TestInit.php");

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

print_r($xmlRequestString);
?>
