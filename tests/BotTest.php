<?php
namespace phpUnitTutorial\Test;

use \Xarasbir\MessengerBot\Bot;

/**
 * @covers Email
 */
final class BotTest extends \PHPUnit_Framework_TestCase
{ 

    public function testBot()
    { 
        $raw = \Xarasbir\MessengerBot\SampleJson\Response::$MESSAGE_TEXT;

        $bot = new Bot(["verify_token" => "23XCV3"]);  
        $bot->hears('/^start-(.*)$/', function(){});
        $bot->hears('test', function(){});
        $bot->hears('/^whatever$/', function(){});
        
        $this->assertEquals(3, count($bot->getPatterns()));  
        $this->assertTrue($bot->verifyToken("23XCV3"));  
        $this->assertFalse($bot->verifyToken("Zzzz"));  
    }  
}