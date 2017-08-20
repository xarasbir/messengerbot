<?php  
namespace Xarasbir\MessengerBot\Components\Buttons;

use Xarasbir\MessengerBot\Interfaces\RequestArray;

/**
*  Button base class 
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