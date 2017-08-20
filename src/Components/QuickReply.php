<?php  
namespace Xarasbir\MessengerBot\Components;

use Xarasbir\MessengerBot\Interfaces\RequestArray;

/**
*  Quick Replies provide a way to present buttons in a 
*  message. Quick Replies appear prominently above the 
*  composer, with the keyboard less prominent. When a quick 
*  reply is tapped, the message is sent in the conversation 
*  with developer-defined payload in the callback.
*
*  https://developers.facebook.com/docs/messenger-platform/send-api-reference/quick-replies
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