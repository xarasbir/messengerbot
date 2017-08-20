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
class Postback
{ 
    protected $payload;
    protected $title; 

    function __construct($payload, $title)
    {
        $this->payload = $payload;
        $this->title = $title; 
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getTitle()
    {
        return $this->title;
    } 

    public static function fromAssoc($assoc)
    {
        $ins = new static( 
            $assoc["payload"], 
            $assoc["title"] 
        );
        return $ins;
    }

}