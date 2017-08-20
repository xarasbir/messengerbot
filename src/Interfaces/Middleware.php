<?php 
namespace Xarasbir\MessengerBot\Interfaces;

use Xarasbir\MessengerBot\Incoming\Response as IncomingMessage;
use Xarasbir\MessengerBot\Bot;
use Xarasbir\MessengerBot\Pattern;
 
/**
*  Middleware Interface Class
*/
interface Middleware 
{    

	public function received($httpRequest, Bot $bot, $next);

	public function heard(IncomingMessage $message, Pattern $pattern, Bot $bot, $next);
	
	public function sending($payload, Bot $bot, $next);
}