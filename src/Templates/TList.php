<?php 

namespace Xarasbir\MessengerBot\Templates; 

use Xarasbir\MessengerBot\Interfaces\RequestArray;
use Xarasbir\MessengerBot\Structure\ParsableArray;
use Xarasbir\MessengerBot\Components\Buttons\Button;
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class TList extends Base implements RequestArray
{   
	public $sharable; 
	public $topElementStyle;
	protected $elements;
	protected $buttons;

	public static $TOP_ELEMENT_LARGE = "large";
	public static $TOP_ELEMENT_COMPACT = "compact";

	function __construct()
	{ 
		$this->sharable = false;
		$this->topElementStyle = static::$TOP_ELEMENT_LARGE;
		$this->elements = new ParsableArray();
		$this->buttons = new ParsableArray();
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
		return $this->getRequestArray([
			"template_type"	=>	"list",
			"sharable"	=>	$this->sharable,
			"top_element_style"	=>	$this->topElementStyle,
			"elements"	=>	$this->elements->toRequestArray(),
			"buttons"	=>	$this->buttons->toRequestArray()
		]);
	}


	//--------------------
	//CHAINING METHODS
	//--------------------

	public static function create()
	{
		return new static();
	}
}