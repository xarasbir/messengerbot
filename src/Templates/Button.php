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
class Button extends Base implements RequestArray
{   
	public $text;
	protected $buttons;

	function __construct($text)
	{ 
		$this->text = $text; 
		$this->buttons = new ParsableArray();
	}

	public function getButtons()
	{
		return $this->buttons;
	}

	public function addButton(\Xarasbir\MessengerBot\Components\Buttons\Button $button)
	{
		$this->buttons[] = $button;
		return $this;
	} 

	public function toRequestArray()
	{
		return $this->getRequestArray([
			"template_type"	=>	"button",
			"text"	=>	$this->text,
			"buttons"	=>	$this->buttons->toRequestArray()
		]);
	}


	//--------------------
	//CHAINING METHODS
	//--------------------

	public static function create($text)
	{
		return new static($text);
	}
}