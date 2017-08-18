<?php 

namespace Xarasbir\MessengerBot\Components\Buttons;

use Xarasbir\MessengerBot\Interfaces\RequestArray;
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class Postback extends Button implements RequestArray
{   
	public $payload; 

	function __construct($title, $payload)
	{
		parent::__construct("postback", $title);
		$this->payload = $payload;  
	}

	public function toRequestArray()
	{
		$requestArr = [
			'type'	=>	$this->type, 
			'payload'	=>	$this->payload 
		];
		if($this->title != null){
			$requestArr['title'] = $this->title;
		}
		return $requestArr;
	}

	//--------------------
	//CHAINING METHODS
	//--------------------

	public static function create($title, $payload)
	{
		return new static($title, $payload);
	}

	public function setPayload($payload)
	{
		$this->payload = $payload;
		return $this;
	} 
}