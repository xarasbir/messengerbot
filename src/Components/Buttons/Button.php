<?php 

namespace Xarasbir\MessengerBot\Components\Buttons;

use Xarasbir\MessengerBot\Interfaces\RequestArray;
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
abstract class Button
{   
	public $type;
	public $title; 

	function __construct($type, $title)
	{
		$this->type = $type;
		$this->title = $title;
	}



	//--------------------
	//CHAINING METHODS
	//-------------------- 

	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}
}