<?php 
namespace Xarasbir\MessengerBot\Components\Buttons;

use Xarasbir\MessengerBot\Interfaces\RequestArray;

/**
*  When this is tapped, we will send a call to the postback 
*  webhook. This is useful when you want to invoke an action in 
*  your bot. You can attach a metadata payload to the button that 
*  will be sent back to your webhook.
*
*  https://developers.facebook.com/docs/messenger-platform/send-api-reference/postback-button
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