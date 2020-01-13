<?php

require_once("TestInit.php");

class PromotionCreateTest extends \PHPUnit_Framework_TestCase {

	protected function setUp() {

	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {

	}

	public function testPromotionCreateRequest() {
		$expectedXML = <<<XML
<request>
	<create>
		<promotion>
			<label>ac-create-20151201</label>
			<billing_event_promotion_code>
				<customer number="1351100001" client="ix"></customer>
				<product>
					<article type="domain" label="ac"/>
					<businesscase label="create"/>
				</product>
				<object>*</object>
			</billing_event_promotion_code>
		</promotion>
	</create>
	<auth>
		<user>root</user>
		<password>test</password>
		<context>1</context>
	</auth>
</request>
XML;

		$base = new \Inessa\RequestModels\Base\Trinity\TrinityCreate();
			$auth = new \Inessa\RequestModels\Base\Auth();
			$auth->setUser("root");
			$auth->setPassword("test");
			$auth->setContext("1");
			$base->setAuth($auth);

			$create = new \Inessa\RequestModels\Trinity\PromotionCreate\PromotionCreate();

			 	$promotion = new \Inessa\RequestModels\Trinity\PromotionCreate\Promotion();
			 	$promotion->setLabel('ac-create-20151201');
			//
			 		$billingEvent = new Inessa\RequestModels\Trinity\PromotionCreate\BillingEventPromotionCode();
			 		$billingEvent->setCustomer('')->addAttribute('client', 'ix')->addAttribute('number', '1351100001');
			 		$billingEvent->setObject('*');
			//
			 			$product = new \Inessa\RequestModels\Trinity\PromotionCreate\Product();
			 			$product->setArticle('')->addAttribute('type', 'domain')->addAttribute('label', 'ac');
			 			$product->setBusinesscase('')->addAttribute('label', 'create');
			//
			 		$billingEvent->setProduct($product);
			 	$promotion->addBilling_event_promotion_code($billingEvent); 
			//
			 $create->setPromotion($promotion);
		$base->setCreate($create);

		$xmlRequestString = $base->build();

//		die(var_dump($xmlRequestString, true));
		
		$this->assertXmlStringEqualsXmlString($expectedXML, $xmlRequestString);
	}

	
	
	
	public function testPromotionCreateReponse() {
			$xmlResponse =<<<XML
<response version="2">
	<stid>20170516-acc3-dev-690</stid>
	<result code="S205001" type="SUCCESS">
		<text><![CDATA[S205001]]></text>
		<resData>
			<promotion id="14" oncePerCustomer="false">
				<label>ac_create_01122015</label>
				<code><![CDATA[07be60d5-5282-4b39-b7bc-72eff63823f1]]></code>
				<billing_event_promotion_code id="10">
					<product price_required="false">
						<businesscase label="create domain"/>
						<article label="ac" type="domain"/>
					</product>
					<object><![CDATA[*]]></object>
					<customer client="ix" number="1351100001"/>
					<code>07be60d5-5282-4b39-b7bc-72eff63823f1</code>
					<owner context="1">
						<user>root</user>
					</owner>
					<updater context="1">
						<user>root</user>
					</updater>
					<created>2017-05-16 14:17:34</created>
					<updated>2017-05-16 14:17:34</updated>
				</billing_event_promotion_code>
				<owner context="1">
					<user>root</user>
				</owner>
				<updater context="1">
					<user>root</user>
				</updater>
				<created>2017-05-16 14:17:34</created>
				<updated>2017-05-16 14:17:34</updated>
			</promotion>
		</resData>
	</result>
</response>
XML;


		$promotion = new \Inessa\ResponseModels\Trinity\PromotionCreate\PromotionCreate(); 
		$promotionResult= $promotion->parse($xmlResponse);  
		
//die(print_r($promotionResult->getResult(), true));		
		// stid
		$this->assertEquals('20170516-acc3-dev-690', $promotionResult->getStid()->getValue()); 
		
		// result
		$this->assertEquals('S205001', $promotionResult->getResult()->getCode()); 
		$this->assertEquals('SUCCESS', $promotionResult->getResult()->getType()); 
		
		// text
		$this->assertEquals('S205001', $promotionResult->getResult()->getText()->getValue()); 
		
		// promotion
		$promo = $promotionResult->getResult()->getResData()->getPromotion()[0]; 
		$this->assertEquals('14', $promo->getId()); 
		$this->assertInstanceOf('\Inessa\ResponseModels\Trinity\PromotionCreate\Promotion', $promo); 
		$this->assertEquals('ac_create_01122015', $promo->getLabel()->getValue()); 
		
		// billingevents
		$bevent = $promo->getBilling_event_promotion_code()[0];
		$this->assertInstanceOf('\Inessa\ResponseModels\Trinity\PromotionCreate\BillingEventPromotionCode', $bevent); 
		$this->assertEquals('10', $bevent->getId()); 
		
		// product 
		$this->assertEquals('false', $bevent->getProduct()->getPrice_required()); 
		$this->assertEquals('create domain', $bevent->getProduct()->getBusinessCase()->getLabel()); 
		$this->assertEquals('ac', $bevent->getProduct()->getArticle()->getLabel());  
		$this->assertEquals('domain', $bevent->getProduct()->getArticle()->getType());  
		
		// customer 
		$this->assertEquals('ix', $bevent->getCustomer()->getClient()); 
		$this->assertEquals('1351100001', $bevent->getCustomer()->getNumber());

		// owner 
		$this->assertEquals('1', $bevent->getOwner()->getContext()); 
		$this->assertEquals('root', $bevent->getOwner()->getUser()->getValue());
	}
}

?>
