<?php 

namespace Xarasbir\MessengerBot\Templates;

use Xarasbir\MessengerBot\Interfaces\RequestArray;
use Xarasbir\MessengerBot\Structure\ParsableArray;
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class Generic extends TemplateBase implements RequestArray
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

	public function addElement(Elements\Generic $element)
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