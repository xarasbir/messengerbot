<?php  
namespace Xarasbir\MessengerBot\Templates;
 
/** 
*  Template base class 
*/
abstract class Base 
{   
	protected function getRequestArray($payload)
	{
		return [
			"attachment" => [
				"type"	=>	"template",
				"payload"	=>	$payload
			]
		];
	}
}