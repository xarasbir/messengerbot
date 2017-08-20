<?php  
namespace Xarasbir\MessengerBot\Incoming;

/**
*  Message class
*/
class Message
{ 
    protected $mid;
    protected $seq;
    protected $text; 
    protected $quick_reply;

    function __construct($mid, $seq, $text)
    {
        $this->mid = $mid;
        $this->seq = $seq; 
        $this->text = $text; 
    }

    public function setQuickReply($quickReply)
    {
        $this->quick_reply = $quickReply;
    }

    public function getMid()
    {
        return $this->mid;
    }

    public function getSeq()
    {
        return $this->seq;
    } 

    public function getText()
    {
        return $this->text;
    } 

    public function getQuickReply()
    {
        return $this->quick_reply;
    }  

    public static function fromAssoc($assoc)
    {
        $ins = new static( 
            $assoc["mid"], 
            $assoc["seq"], 
            $assoc["text"]
        );
        if(isset($assoc["quick_reply"])){
            $ins->setQuickReply(QuickReply::fromAssoc($assoc["quick_reply"]));
        }
        return $ins;
    }

}