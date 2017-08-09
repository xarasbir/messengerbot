<?php 

namespace Xarasbir\MessengerBot\Templates\Elements;

use Xarasbir\MessengerBot\Interfaces\RequestArray;
use Xarasbir\MessengerBot\Templates\Components\UrlButton;
use Xarasbir\MessengerBot\Templates\Components\Button;
use Xarasbir\MessengerBot\Structure\ParsableArray;
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class Generic implements RequestArray
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

	public function addButton($param1)
	{
		$button = null;
		if($param1 instanceof \Closure ){
			$button = ($param1)($this);
			//make sure the return value of the closure is a generic element
			if (!($button instanceof Button)){
				throw new \Exception("Closure should return an instance of " . Button::class);
			}
			$this->buttons[] = $button;

		}else if ($param1 instanceof Button){
			$button = $param1;
			$this->buttons[] = $button;

		}else{
			//if parameter is neither closure or generic element
			throw new \Exception("Parameter should be either Closure or " . Button::class);
		} 
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

	public function setDefaultAction(UrlButton $defaultAction)
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