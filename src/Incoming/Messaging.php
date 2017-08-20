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
class Messaging
{ 
    protected $sender;
    protected $recipient;
    protected $timestamp; 

    protected $postback;
    protected $message;

    function __construct(Entity $sender, Entity $recipient, $timestamp)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->timestamp = $timestamp;
        $this->postback = null;
        $this->message = null;
    }

    public function setPostback($postback)
    {
        $this->postback = $postback;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getPostback()
    {
        return $this->postback;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function hasPostback()
    {
        return $this->postback != null;
    }

    public function getValue()
    {
        if($this->hasPostback()){
            return $this->getPostback()->getPayload();
        }else{
            return $this->getMessage()->getText();
        }
    }

    public static function fromAssoc($assoc)
    {
        $ins = new static( 
            Entity::fromAssoc($assoc["sender"]), 
            Entity::fromAssoc($assoc["recipient"]),
            $assoc["timestamp"]
        );
        if(isset($assoc["message"])){
            $ins->setMessage(Message::fromAssoc($assoc["message"]));
        }
        if(isset($assoc["postback"])){
            $ins->setPostback(Postback::fromAssoc($assoc["postback"]));
        }
        return $ins;
    }

}