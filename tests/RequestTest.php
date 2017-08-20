<?php
namespace phpUnitTutorial\Test;

use \Xarasbir\MessengerBot\Incoming\Response;

/**
 * @covers Email
 */
final class RequestTest extends \PHPUnit_Framework_TestCase
{ 

    public function testQuickReply()
    {
        $raw = \Xarasbir\MessengerBot\SampleJson\Response::$MESSAGE_QUICKREPLY;
        //$raw = '{"object":"page","entry":[{"id":"253825115104261","time":1501819418037,"messaging":[{"sender":{"id":"1760201240671751"},"recipient":{"id":"253825115104261"},"timestamp":1501819417840,"message":{"quick_reply":{"payload":"5"},"mid":"mid.$cAADm2iMEJj1j3K788Fdq2mwBDzbZ","seq":459416,"text":"5"}}]}]}';
        $response = Response::fromAssoc(json_decode($raw, true));

        $this->assertEquals('page', $response->getObject()); 
        $this->assertEquals(1, count($response->getEntry()));
        
        //entry
        $this->assertEquals('253825115104261', $response->getEntry()[0]->getId()); 
        $this->assertEquals('1502088979210', $response->getEntry()[0]->getTime()); 
        
        //messaging
        $this->assertEquals(1, count($response->getEntry()[0]->getmessaging())); 
        $this->assertEquals("1502088979056", $response->getEntry()[0]->getmessaging()[0]->getTimestamp());  
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getMessage()); 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getSender()); 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getRecipient()); 
        $this->assertEquals(false, $response->getEntry()[0]->getmessaging()[0]->hasPostback()); 
        $this->assertEquals("1760201240671751", $response->getEntry()[0]->getmessaging()[0]->getSender()->getId()); 
        $this->assertEquals("253825115104261", $response->getEntry()[0]->getmessaging()[0]->getRecipient()->getId()); 


        //message 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getMessage());
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getMessage()->getQuickReply()); 
        $this->assertEquals('all-categories', $response->getEntry()[0]->getmessaging()[0]->getMessage()->getQuickReply()->getPayload()); 
        $this->assertEquals('mid.$cAADm2iMEJj1j7MAqcFdu3rjPPAu7', $response->getEntry()[0]->getmessaging()[0]->getMessage()->getMid());
        $this->assertEquals('461512', $response->getEntry()[0]->getmessaging()[0]->getMessage()->getSeq());
        $this->assertEquals('Back to Categories', $response->getEntry()[0]->getmessaging()[0]->getMessage()->getText());
    } 


    public function testMessage()
    {
        $raw = \Xarasbir\MessengerBot\SampleJson\Response::$MESSAGE_TEXT;
        //$raw = '{"object":"page","entry":[{"id":"253825115104261","time":1502088891152,"messaging":[{"sender":{"id":"1760201240671751"},"recipient":{"id":"253825115104261"},"timestamp":1502088890996,"message":{"mid":"mid.$cAADm2iMEJj1j7L7SdFdu3mLQhvHK","seq":461502,"text":"test"}}]}]}';
        $response = Response::fromAssoc(json_decode($raw, true));

        $this->assertEquals('page', $response->getObject()); 
        $this->assertEquals(1, count($response->getEntry()));
        
        //entry
        $this->assertEquals('253825115104261', $response->getEntry()[0]->getId()); 
        $this->assertEquals('1502088891152', $response->getEntry()[0]->getTime()); 
        
        //messaging
        $this->assertEquals(1, count($response->getEntry()[0]->getmessaging())); 
        $this->assertEquals("1502088890996", $response->getEntry()[0]->getmessaging()[0]->getTimestamp());  
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getMessage()); 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getSender()); 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getRecipient()); 
        $this->assertEquals(false, $response->getEntry()[0]->getmessaging()[0]->hasPostback()); 
        $this->assertEquals("1760201240671751", $response->getEntry()[0]->getmessaging()[0]->getSender()->getId()); 
        $this->assertEquals("253825115104261", $response->getEntry()[0]->getmessaging()[0]->getRecipient()->getId()); 

        //message 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getMessage());
        //$this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getMessage()->getQuickReply()); 
        //$this->assertEquals(5, $response->getEntry()[0]->getmessaging()[0]->getMessage()->getQuickReply()->getPayload()); 
        $this->assertEquals('mid.$cAADm2iMEJj1j7L7SdFdu3mLQhvHK', $response->getEntry()[0]->getmessaging()[0]->getMessage()->getMid());
        $this->assertEquals('461502', $response->getEntry()[0]->getmessaging()[0]->getMessage()->getSeq());
        $this->assertEquals('test', $response->getEntry()[0]->getmessaging()[0]->getMessage()->getText());
    } 




    public function testPostback()
    {
        $raw = \Xarasbir\MessengerBot\SampleJson\Response::$POSTBACK;
        //$raw = '{"object":"page","entry":[{"id":"253825115104261","time":1502088866024,"messaging":[{"recipient":{"id":"253825115104261"},"timestamp":1502088866024,"sender":{"id":"1760201240671751"},"postback":{"payload":"start-order","title":"Order"}}]}]}';
        $response = Response::fromAssoc(json_decode($raw, true));

        $this->assertEquals('page', $response->getObject()); 
        $this->assertEquals(1, count($response->getEntry()));
        
        //entry
        $this->assertEquals('253825115104261', $response->getEntry()[0]->getId()); 
        $this->assertEquals('1502088866024', $response->getEntry()[0]->getTime()); 
        
        //messaging
        $this->assertEquals(1, count($response->getEntry()[0]->getmessaging())); 
        $this->assertEquals("1502088866024", $response->getEntry()[0]->getmessaging()[0]->getTimestamp());  
        $this->assertNull($response->getEntry()[0]->getmessaging()[0]->getMessage());  
        $this->assertEquals(true, $response->getEntry()[0]->getmessaging()[0]->hasPostback()); 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getSender()); 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getRecipient()); 
        $this->assertEquals("1760201240671751", $response->getEntry()[0]->getmessaging()[0]->getSender()->getId()); 
        $this->assertEquals("253825115104261", $response->getEntry()[0]->getmessaging()[0]->getRecipient()->getId()); 

        //message 
        $this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getPostback());
        //$this->assertNotNull($response->getEntry()[0]->getmessaging()[0]->getMessage()->getQuickReply()); 
        //$this->assertEquals(5, $response->getEntry()[0]->getmessaging()[0]->getMessage()->getQuickReply()->getPayload()); 
        $this->assertEquals('start-order', $response->getEntry()[0]->getmessaging()[0]->getPostback()->getPayload());
        $this->assertEquals('Order', $response->getEntry()[0]->getmessaging()[0]->getPostback()->getTitle()); 
    } 
}