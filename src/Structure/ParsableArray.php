<?php 

namespace Xarasbir\MessengerBot\Structure;

use Xarasbir\MessengerBot\Interfaces\RequestArray;
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class ParsableArray extends \ArrayObject implements RequestArray
{  
    public function toRequestArray()
    {
    	$arr = [];
    	foreach($this as $item){
    		$arr[] = $item->toRequestArray();
    	}
    	return $arr;
    }
}