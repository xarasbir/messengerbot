<?php  
namespace Xarasbir\MessengerBot\Templates;

use Xarasbir\MessengerBot\Interfaces\RequestArray;
use Xarasbir\MessengerBot\Structure\ParsableArray;

/**
*  Use the Generic Template with the Send API to send 
*  a horizontal scrollable carousel of items, each 
*  composed of an image attachment, short description 
*  and buttons to request input from the user.
*
*  https://developers.facebook.com/docs/messenger-platform/send-api-reference/generic-template
*/
class Generic extends Base implements RequestArray
{   
	public $sharable;
	protected $elements;
	public $imageAspectRatio;

	public static $IMAGE_ASPECT_RATIO_HORIZONTAL = "horizontal";
	public static $IMAGE_ASPECT_RATIO_SQUARE = "square";

	function __construct()
	{ 
		$this->sharable = false;
		$this->imageAspectRatio = static::$IMAGE_ASPECT_RATIO_HORIZONTAL;
		$this->elements = new ParsableArray();
	}

	public function getElements()
	{
		return $this->elements;
	}

	public function addElement(Element $element)
	{
		$this->elements[] = $element;
		return $this;
	} 

	public function toRequestArray()
	{
		return $this->getRequestArray([
			"template_type"	=>	"generic",
			"image_aspect_ratio"	=>	$this->imageAspectRatio,
			"sharable"	=>	$this->sharable,
			"elements"	=>	$this->elements->toRequestArray()
		]);
	}


	//--------------------
	//CHAINING METHODS
	//--------------------

	public static function create($title)
	{
		return new static();
	}

}