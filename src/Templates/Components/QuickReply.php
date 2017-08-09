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
class QuickReply implements RequestArray
{   
	public $contentType;
	public $title;
	public $payload; 
	public $imageUrl;

	public static $CONTENT_LOCATION = "location";
	public static $CONTENT_TEXT = "text";

	function __construct($title = '', $payload = '')
	{
		$this->contentType = static::$CONTENT_TEXT;
		$this->title = $title;
		$this->payload = $payload;
	}

	public function toRequestArray()
	{
		return [
			"content_type"	=>	$this->contentType,
			"title"	=>	$this->title,
			"payload"	=>	$this->payload,
			"image_url"	=>	$this->imageUrl
		];
	}
	

	//--------------------
	//CHAINING METHODS
	//-------------------- 

	public static function create($title = '', $payload = '')
	{
		return new static($title, $payload);
	}

	public function setContentType($contentType)
	{
		$this->contentType = $contentType;
		return $this;
	}

	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	public function setPayload($payload)
	{
		$this->payload = $payload;
		return $this;
	}

	public function setImageUrl($imageUrl)
	{
		$this->imageUrl = $imageUrl;
		return $this;
	}
}