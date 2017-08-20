<?php  
namespace Xarasbir\MessengerBot;

use Symfony\Component\HttpFoundation\Request;
use Xarasbir\MessengerBot\Interfaces\RequestArray;
use Xarasbir\MessengerBot\Middleware\Manager;


/** 
*   Handles listening, replying, webhook verification and whatnot
*
*/
class Bot
{ 
    protected $response;
    protected $patterns;
    protected $fallback;
    protected $config;
    protected $middleware;

    private $client;
    private $httpRequest;
    private $defaultConfig = [
        "verify_token"  =>  "",
        "access_token"  =>  ""
    ];

    function __construct($config = [])
    {
        $this->response = null;
        $this->fallback = null;
        $this->patterns = [];
        $this->middleware = new Manager();
        $this->client = new \GuzzleHttp\Client();
        $this->config = array_merge($this->defaultConfig, $config); 
        $this->httpRequest = Request::createFromGlobals(); 
    }

    public function getPatterns()
    {
        return $this->patterns;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getMiddleware()
    {
        return $this->middleware;
    }

    public function hears($regex, $callback, $onlyPostback = null)
    {
        $this->patterns[] = new Pattern($regex, $callback, $onlyPostback);
    }

    public function listen($httpRequest = null)
    {
        $this->parseResponse($httpRequest); 

        if($this->response == null) return; 

        $hasMatch = false;

        foreach($this->patterns as $pattern){
            //check if request matches the current pattern
            if($pattern->match($this->response)){  
                $self = $this; 
                //let it go throught the heard middleware
                $continue = $this->middleware->heard(
                    $this->response, 
                    $pattern, 
                    $this, 
                    function($response) use ($self, $pattern) {   
                        //invoke callback  
                        return $pattern->invokeCallback($self, $response);   
                    }
                ); 
                
                $hasMatch = true;

                if($continue === false) break;
            } 
        }

        //when no pattern matches
        //and a fallback is defined
        if(!$hasMatch && $this->fallback != null){
            ($this->fallback)($this, $this->response);
        } 
    }

    private function checkResponse()
    {
        if($this->response == null){
            throw new \Exception("Response is empty");
        }
    } 

    public function send($message, $recipientId, $additionalParams = [])
    {
        $params = array_merge_recursive([
            'recipient' => [
                'id' => $recipientId,
            ],
        ], $additionalParams); 

        if(is_string($message)){
            $params["message"] = ["text" => $message];
        }else if( $message instanceof RequestArray ){
            $params["message"] = $message->toRequestArray();
        }else{
            throw new \Exception('Message should be a string or an instance of ' . RequestArray::class);
        }
 
        $params['access_token'] = $this->config["access_token"]; 

        $client = $this->client;
        $resp = $this->middleware->sending(
            $params, 
            $this, 
            function($params) use ($client){  
                 $client->post('https://graph.facebook.com/v2.6/me/messages', [ 'form_params' => $params ]); 
            }
        );  
        
        return $resp;
    }

    public function reply($message, $additionalParams = [])
    {
        $this->checkResponse();
        $recipientId = $this->response->getEntry()[0]->getMessaging()[0]->getSender()->getId();
        return $this->send($message, $recipientId, $additionalParams);
    }

    public function types($accessToken)
    {
        $this->checkResponse();

        $params = [
            'recipient' => [
                'id' => $this->response->getEntry()->getMessaging()->getSender()->getId(),
            ], 
            'access_token' => $accessToken,
            'sender_action' => 'typing_on',
        ];

        $resp = $this->client->request('POST', 'https://graph.facebook.com/v2.6/me/messages', [], $params); 
        return $resp;
    }

    public function parseResponse($httpRequest = null)
    { 
        if($httpRequest === null){ 
            //get request from the request body if not explicitly specified
            if (0 === strpos($this->httpRequest->headers->get('Content-Type'), 'application/json')) {
                $httpRequest = json_decode($this->httpRequest->getContent(), true); 
            }
        }  

        if(isset($httpRequest["object"]) && $httpRequest["entry"]){  
            //let it go throught the received middleware
            $this->response = $this->middleware->received(
                $httpRequest, 
                $this, 
                function($httpRequest){  
                    //parse the raw response into our own response object
                    return Incoming\Response::fromAssoc($httpRequest);     
                }
            ); 
        } 
    }

    public function setFallback($callback)
    {   
        $this->fallback = $callback;
    } 

    public function verifyToken($token)
    {
        return $token == $this->config["verify_token"];
    }

    public function verify($httpRequest = null)
    {   
        if($httpRequest === null){
            $httpRequest = $this->httpRequest->query;
        }  
        if($httpRequest->get("hub_challenge") !== null){
            if($this->verifyToken($httpRequest->get("hub_verify_token"))){
                http_response_code(200);
                echo $httpRequest->get("hub_challenge");
                exit;
            }else{ 
                exit;
            }
        }
    } 

}