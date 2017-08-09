<?php 

namespace Xarasbir\MessengerBot\Templates;
 
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
abstract class TemplateBase 
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