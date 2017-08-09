<?php
namespace Xarasbir\MessengerBot\SampleJson;

/**
 * @covers Email
 */
class Response
{
	public static $MESSAGE_TEXT = '{"object":"page","entry":[{"id":"253825115104261","time":1502088891152,"messaging":[{"sender":{"id":"1760201240671751"},"recipient":{"id":"253825115104261"},"timestamp":1502088890996,"message":{"mid":"mid.$cAADm2iMEJj1j7L7SdFdu3mLQhvHK","seq":461502,"text":"test"}}]}]}';
	public static $MESSAGE_QUICKREPLY = '{"object":"page","entry":[{"id":"253825115104261","time":1502088979210,"messaging":[{"sender":{"id":"1760201240671751"},"recipient":{"id":"253825115104261"},"timestamp":1502088979056,"message":{"quick_reply":{"payload":"all-categories"},"mid":"mid.$cAADm2iMEJj1j7MAqcFdu3rjPPAu7","seq":461512,"text":"Back to Categories"}}]}]}';
	public static $POSTBACK = '{"object":"page","entry":[{"id":"253825115104261","time":1502088866024,"messaging":[{"recipient":{"id":"253825115104261"},"timestamp":1502088866024,"sender":{"id":"1760201240671751"},"postback":{"payload":"start-order","title":"Order"}}]}]}';
}