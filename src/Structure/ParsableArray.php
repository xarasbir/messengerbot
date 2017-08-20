<?php  
namespace Xarasbir\MessengerBot\Structure;

use Xarasbir\MessengerBot\Interfaces\RequestArray;

/**
*  Extended collection class for easily converting
*  it's items to array
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