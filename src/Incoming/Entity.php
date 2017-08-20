<?php  
namespace Xarasbir\MessengerBot\Incoming;

/**
*  Entity class
*/
class Entity
{ 
    protected $id; 

    function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    } 

    public static function fromAssoc($assoc)
    {
        $ins = new static($assoc["id"]);
        return $ins;
    }

}