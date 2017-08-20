<?php  
namespace Xarasbir\MessengerBot\Templates;

use Xarasbir\MessengerBot\Interfaces\RequestArray; 
use Xarasbir\MessengerBot\Structure\ParsableArray; 

/**
*  Use the Button Template with the Send API to send a 
*  text and buttons attachment to request input from the 
*  user. The buttons can open a URL, or make a back-end call 
*  to your webhook.
*
*  https://developers.facebook.com/docs/messenger-platform/send-api-reference/button-template
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