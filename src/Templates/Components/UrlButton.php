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
class UrlButton extends Button implements RequestArray
{   
	public $url;
	public $heightRatio;
	public $messengerExtension;
	public $fallbackUrl;
	public $shareButton;

	public static $HEIGHT_COMPACT = "compact";
	public static $HEIGHT_TALL = "tall";
	public static $HEIGHT_FULL = "full";

	function __construct($title, $url)
	{
		parent::__construct("web_url", $title);
		$this->url = $url; 
		$this->heightRatio = static::$HEIGHT_FULL;
		$this->messengerExtension = true; 
	}

	public function toRequestArray()
	{
		return [
			'type'	=>	$this->type,
			'title'	=>	$this->title,
			'url'	=>	$this->url,
			'webview_height_ratio'	=>	$this->heightRatio,
			'messenger_extensions'	=>	$this->messengerExtension,
			'fallback_url'			=>	$this->fallbackUrl,
			'webview_share_button'	=>	$this->shareButton
		];
	}

	//--------------------
	//CHAINING METHODS
	//--------------------

	public static function create($title, $url)
	{
		return new static($title, $url);
	}

	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}

	public function setHeightRatio($heightRatio)
	{
		$this->heightRatio = $heightRatio;
		return $this;
	}

	public function setMessengerExtension($messengerExtension)
	{
		$this->messengerExtension = $messengerExtension;
		return $this;
	}

	public function setFallbackUrl($fallbackUrl)
	{
		$this->fallbackUrl = $fallbackUrl;
		return $this;
	}

	public function setShareButton($shareButton)
	{
		$this->shareButton = $shareButton;
		return $this;
	}
}