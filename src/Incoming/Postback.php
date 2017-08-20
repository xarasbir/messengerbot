<?php  
namespace Xarasbir\MessengerBot\Incoming;

/**
*  Postback class
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