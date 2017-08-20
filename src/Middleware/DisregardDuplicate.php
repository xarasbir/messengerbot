<?php 
namespace Xarasbir\MessengerBot\Middleware;

use Xarasbir\MessengerBot\Incoming\Response as IncomingMessage;
use Xarasbir\MessengerBot\Bot;
use Xarasbir\MessengerBot\Interfaces\Middleware;
use Xarasbir\MessengerBot\Pattern;
use Xarasbir\MessengerBot\Incoming\Messaging;
use Symfony\Component\Cache\Simple\FilesystemCache;
 
/**
*  This middleware voids incoming messages that has previously 
*  been received by our Bot to prevent duplicate processing.
*  Messenger tends to send duplicate entry especially
*  when the sender's internet is intermittent.
* 
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
			//not a duplicate,
			//append to history for future reference
			$this->appendToHistory($messaging);

			//return the parsed request, untouched
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
		//get cache key
		$key = $this->getConvoHistoryCacheKey($message->getRecipient()->getId(), $message->getSender()->getId());

		//get existing conversation history
		$history = $this->getConvoHistory($key);

		//append the new conversation
		$history[] = $message;

		//if history contains beyond 10 conversation,
		//take only the last 10
		if(count($history) > 10){
			$history = array_slice($history, -10);
		}

		//save it back to cache
		$this->cacheConvoHistory($key, $history);

		//return the collection
		return $history;
	} 

	public function hasDuplicate(Messaging $message)
	{ 
		return $this->findDuplicate($message) != null;
	}

	public function findDuplicate(Messaging $message)
	{
		//get cache key
		$key = $this->getConvoHistoryCacheKey($message->getRecipient()->getId(), $message->getSender()->getId());
		
		//get conversation history from cache
		$history = $this->getConvoHistory($key);

		//if nothing in the history yet, return null
		if ( $history == null ) return null;

		$match = null;
		//iterate throught the history and try to find a match
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