<?php  
namespace Xarasbir\MessengerBot\Incoming;

/**
*  QuickReply class
*/
class QuickReply
{ 
    protected $payload; 

    function __construct($payload)
    {
        $this->payload = $payload; 
    }

    public function getPayload()
    {
        return $this->payload;
    } 

    public static function fromAssoc($assoc)
    {
        $ins = new static($assoc["payload"]);
        return $ins;
    }

}