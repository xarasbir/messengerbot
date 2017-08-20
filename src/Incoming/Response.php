<?php  
namespace Xarasbir\MessengerBot\Incoming;

/**
*  Response class
*/
class Response
{ 
    protected $object;
    protected $entry;

    function __construct(Array $entry, $object = 'page')
    {
        $this->entry = $entry;
        $this->object = $object;
    }

    public function addEntry(Entry $entry)
    {
        $this->entry[] = $entry;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function getEntry()
    {
        return $this->entry;
    }

    public static function fromAssoc($assoc)
    {
        $ins = new static([], $assoc["object"]);
        if(isset($assoc["entry"])){
            foreach($assoc['entry'] as $entry){
                $ins->addEntry(Entry::fromAssoc($entry));
            }
        }
        return $ins;
    }

}