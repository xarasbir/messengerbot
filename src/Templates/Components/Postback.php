<?php 

namespace Xarasbir\MessengerBot\Templates\Components;

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
		return [
			'type'	=>	$this->type,
			'title'	=>	$this->title,
			'payload'	=>	$this->payload 
		];
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