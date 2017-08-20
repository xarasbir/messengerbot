<?php  
namespace Xarasbir\MessengerBot\Templates;

use Xarasbir\MessengerBot\Interfaces\RequestArray;
use Xarasbir\MessengerBot\Components\Buttons\Url; 
use Xarasbir\MessengerBot\Structure\ParsableArray;
use Xarasbir\MessengerBot\Components\Buttons\Button;

/**
*  Generic template element class 
*/
class Element implements RequestArray
{   
	public $title;
	public $subtitle;
	public $imageUrl;
	protected $defaultAction;
	protected $buttons;

	function __construct($title){
		$this->title = $title;
		$this->buttons = new ParsableArray();
		$this->defaultAction = null;
	}  

	public function getDefaultAction()
	{
		return $this->defaultAction;
	}

	public function getButtons()
	{
		return $this->buttons;
	} 

	public function addButton(Button $button)
	{
		$this->buttons[] = $button;
		return $this;
	} 

	public function toRequestArray()
	{ 
		return [
			"title"				=>	$this->title,
			"image_url"			=>	$this->imageUrl,
			"subtitle"			=>	$this->subtitle,
			"default_action"	=>	$this->defaultAction == null ? null : $this->defaultAction->toRequestArray(),
			"buttons"			=>	$this->buttons->toRequestArray(),
		];
	} 


	//--------------------
	//CHAINING METHODS
	//--------------------

	public static function create($title)
	{
		return new static($title);
	}

	public function setDefaultAction(Url $defaultAction)
	{
		$this->defaultAction = $defaultAction;
		return $this;
	} 

	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	public function setImageUrl($imageUrl)
	{
		$this->imageUrl = $imageUrl;
		return $this;
	}

	public function setSubtitle($subtitle)
	{
		$this->subtitle = $subtitle;
		return $this;
	}
}