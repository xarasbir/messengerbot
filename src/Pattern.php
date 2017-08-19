<?php 

namespace Xarasbir\MessengerBot;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class Pattern
{ 
	protected $regex;
	protected $callback;
	protected $onlyPostback;

	private $regexOutput;

	function __construct($regex, $callback = null, $onlyPostback = null)
	{
		$this->regex = $regex;
		$this->callback = $callback;
		$this->onlyPostback = $onlyPostback;
	}

	public function isPostbackEvaluationValid($response)
	{
		return $this->onlyPostback !== null && 
			$response->getEntry()[0]->getMessaging()[0]->hasPostback() !== $this->onlyPostback;
	}

	public function match($response)
	{ 
		//check if postback qualifier is set 
		//but doesn't match the response
		if($this->isPostbackEvaluationValid($response)){
			return false;
		}

		//get value (either text or postback value)
		$value = $this->getResponseMessagingValue($response);
		

		//match the response value against the current regex
		$match = preg_match("/" . $this->regex . "/", $value, $output);  

		//store output
		$this->regexOutput = $output;

		//return match result
		return $match; 
	}

	public function getResponseMessagingValue($response)
	{
		return $response->getEntry()[0]->getMessaging()[0]->getValue();
	}

	public function invokeCallback($bot, $response)
	{

		//call callback
		if($this->callback instanceof \Closure){
			//dd('calls');
			return ($this->callback)($bot,  $response, $this->regexOutput);	
		} 
	}
}
?>