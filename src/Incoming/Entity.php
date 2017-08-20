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