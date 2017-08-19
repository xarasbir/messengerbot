<?php 
namespace Xarasbir\MessengerBot\Middleware; 

use Xarasbir\MessengerBot\Interfaces\Middleware;
use Xarasbir\MessengerBot\Response\Response as IncomingMessage;
use Xarasbir\MessengerBot\Bot;
 
/**
*  Middleware Manager Class 
*/
class Manager 
{    
	protected $middlewares;

	function __construct()
	{
		$this->middlewares = [];
	}

    public function add(Middleware $middleware)
    {
        return $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
    	return $this->middlewares;
    }

    public function received($httpRequest, Bot $bot, \Closure $default, $index = 0)
    {
    	$middleware = $this->middlewares[$index] ?? false; 

    	if ($middleware) { 
    		$self = $this;
    		return $middleware->received(
    			$httpRequest, 
    			$bot, 
            	function($modifiedRequest) use ($self, $bot, $default, $index){ 
                	return $self->received($modifiedRequest, $bot, $default, ($index + 1));
            	}
            );
    	} else { 
    		return $default($httpRequest);
    	} 
    } 

	public function heard(IncomingMessage $message, $pattern, Bot $bot, \Closure $default, $index = 0)
	{

    	$middleware = $this->middlewares[$index] ?? false; 

    	if ($middleware) { 
    		$self = $this;
    		return $middleware->heard(
    			$message, 
    			$pattern, 
    			$bot, 
            	function($modifiedMessage) use ($self, $pattern, $bot, $default, $index){  
                	return $self->heard($modifiedMessage, $pattern, $bot, $default, ($index + 1));
            	}
            );
    	} else {  
    		return $default($message);
    	} 

	}
	
	public function sending($payload, Bot $bot, \Closure $default, $index = 0)
	{
		$middleware = $this->middlewares[$index] ?? false; 

    	if ($middleware) { 
    		$self = $this;
    		return $middleware->sending(
    			$payload,  
    			$bot, 
            	function($modifiedPayload) use ($self, $bot, $default, $index){  
                	return $self->sending($modifiedPayload, $bot, $default, ($index + 1));
            	}
            );
    	} else {  
    		return $default($payload);
    	} 
	}

}