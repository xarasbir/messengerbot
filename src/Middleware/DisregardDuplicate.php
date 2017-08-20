<?php 
namespace Xarasbir\MessengerBot\Middleware;

use Xarasbir\MessengerBot\Incoming\Response as IncomingMessage;
use Xarasbir\MessengerBot\Bot;
use Xarasbir\MessengerBot\Interfaces\Middleware;
use Xarasbir\MessengerBot\Pattern;
use Xarasbir\MessengerBot\Incoming\Messaging;
use Symfony\Component\Cache\Simple\FilesystemCache;
 
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class DisregardDuplicate implements Middleware
{    
	private $cache;

	function __construct()
	{
		$this->cache = new FilesystemCache();
	}

	public function received($httpRequest, Bot $bot, $next)
	{     
		$parsed = $next($httpRequest);    
		$messaging = $parsed->getEntry()[0]->getMessaging()[0];
		if($this->hasDuplicate($messaging)){

			//incoming response is a duplicate
			//thus, return empty
			return null;
		}else{
			$this->appendToHistory($messaging);
			return $parsed;	
		} 
	}

	public function heard(IncomingMessage $message, Pattern $pattern, Bot $bot, $next)
	{  
		return $next($message);
	}
	
	public function sending($payload, Bot $bot, $next)
	{
		return $next($payload);
	}

	private function getConvoHistoryCacheKey($currentPartyId, $otherPartyId)
	{
		return sprintf("convos.%s.%s", $currentPartyId, $otherPartyId);
	}

	private function getConvoHistory($key)
	{
		return $this->cache->get($key); 
	}

	private function cacheConvoHistory($key, $convos)
	{
		return $this->cache->set($key, $convos, (3600 * 24)); 
	}

	private function appendToHistory(Messaging $message)
	{ 
		$key = $this->getConvoHistoryCacheKey($message->getRecipient()->getId(), $message->getSender()->getId());
		$history = $this->getConvoHistory($key);
		$history[] = $message;
		if(count($history) > 10){
			$history = array_slice($history, -10);
		}
		$this->cacheConvoHistory($key, $history);
		return $history;
	} 

	public function hasDuplicate(Messaging $message)
	{
		return $this->findDuplicate($message) != null;
	}

	public function findDuplicate(Messaging $message)
	{
		$key = $this->getConvoHistoryCacheKey($message->getRecipient()->getId(), $message->getSender()->getId());
		$history = $this->getConvoHistory($key);
		if ( $history == null ) return null;
		$match = null;
		foreach( $history as $pastConvo ){
			if( $pastConvo->getValue() == $message->getValue()
				&& $pastConvo->getTimestamp() && $message->getTimestamp()
			){
				$match = $pastConvo;
				break;	
			} 
		}
		return $match;
	}
}