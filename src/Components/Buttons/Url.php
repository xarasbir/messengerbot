<?php  
namespace Xarasbir\MessengerBot\Components\Buttons;

use Xarasbir\MessengerBot\Interfaces\RequestArray;

/**
*  The URL Button can be used to open a web page in the 
*  in-app browser. This button can be used with the Button 
*  and Generic Templates. 
*
*  https://developers.facebook.com/docs/messenger-platform/send-api-reference/url-button
*/
class Url extends Button implements RequestArray
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
	}

	public function toRequestArray()
	{
		$requestArr = [
			'type'	=>	$this->type, 
			'url'	=>	$this->url,
			'webview_height_ratio'	=>	$this->heightRatio 
		];
		if($this->title != null){
			$requestArr['title'] = $this->title;
		}
		if($this->messengerExtension != null){
			$requestArr['messenger_extensions']	= $this->messengerExtension;
		}
		if($this->fallbackUrl != null){
			$requestArr['fallback_url']	= $this->fallbackUrl;
		}
		if($this->shareButton != null){
			$requestArr['webview_share_button'] = $this->shareButton;
		}
		return $requestArr;
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