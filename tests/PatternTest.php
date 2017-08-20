<?php
namespace phpUnitTutorial\Test;

use \Xarasbir\MessengerBot\Pattern;
use \Xarasbir\MessengerBot\Incoming\Response;

/**
 * @covers Email
 */
final class PatternTest extends \PHPUnit_Framework_TestCase
{  
    public function testPostbackPattern()
    { 
        $raw = \Xarasbir\MessengerBot\SampleJson\Response::$POSTBACK;
        $response = Response::fromAssoc(json_decode($raw, true));


        $pattern1 = new Pattern('^start-(.*)$', function(){}, true);
        $pattern2 = new Pattern('^start-(.*)$', function(){}, null);
        $pattern3 = new Pattern('^start-(.*)$', function(){}, false);
        $pattern4 = new Pattern('startz', function(){}, true);
        $pattern5 = new Pattern('startz', function(){}, null);
        $pattern6 = new Pattern('startz', function(){}, false);

        $this->assertEquals(true, $pattern1->match($response));
        $this->assertEquals(true, $pattern2->match($response));
        $this->assertEquals(false, $pattern3->match($response));
        $this->assertEquals(false, $pattern4->match($response));
        $this->assertEquals(false, $pattern5->match($response));
        $this->assertEquals(false, $pattern6->match($response));

        $this->assertEquals('start-order', $pattern1->getResponseMessagingValue($response));

        //assert more
    }  
    public function testMessagePattern()
    { 
        $raw = \Xarasbir\MessengerBot\SampleJson\Response::$MESSAGE_TEXT;
        $response = Response::fromAssoc(json_decode($raw, true));


        $pattern1 = new Pattern('^te(s|z)t$', function(){}, true);
        $pattern2 = new Pattern('^te(s|z)t$', function(){}, null);
        $pattern3 = new Pattern('^te(s|z)t$', function(){}, false);
        $pattern4 = new Pattern('test2', function(){}, true);
        $pattern5 = new Pattern('test3', function(){}, null);
        $pattern6 = new Pattern('test4', function(){}, false);

        $this->assertEquals(false, $pattern1->match($response));
        $this->assertEquals(true, $pattern2->match($response));
        $this->assertEquals(true, $pattern3->match($response));
        $this->assertEquals(false, $pattern4->match($response));
        $this->assertEquals(false, $pattern5->match($response));
        $this->assertEquals(false, $pattern6->match($response));

        $this->assertEquals('test', $pattern1->getResponseMessagingValue($response));

        //assert more
    }  
}