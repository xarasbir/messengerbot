<?php  
namespace Xarasbir\MessengerBot\Incoming;

/**
*  Entry class
*/
class Entry
{ 
    protected $id;
    protected $time;
    protected $messaging; 

    function __construct($id, $time, Array $messaging)
    {
        $this->id = $id;
        $this->time = $time;
        $this->messaging = $messaging;
    }

    public function addMessaging(Messaging $messaging)
    {
        $this->messaging[] = $messaging;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getMessaging()
    {
        return $this->messaging;
    }

    public static function fromAssoc($assoc)
    {
        $ins = new static($assoc["id"], $assoc["time"], []);
        if(isset($assoc["messaging"])){
            foreach($assoc['messaging'] as $messaging){
                $ins->addMessaging(Messaging::fromAssoc($messaging));
            }
        }
        return $ins;
    }

}