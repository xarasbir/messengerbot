<?php 

namespace Xarasbir\MessengerBot\Incoming;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
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