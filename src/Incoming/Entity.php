<?php  
namespace Xarasbir\MessengerBot\Incoming;

/**
*  Entity class
*/
class Entity
{ 
    protected $id; 

    function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    } 

    public static function fromAssoc($assoc)
    {
        $ins = new static($assoc["id"]);
        return $ins;
    }

    public function retrieveUserProfile(
        $accessToken, 
        $fields = ['first_name', 'last_name', 'profile_pic', 'gender']
    ){
        $client = new \GuzzleHttp\Client();
        
        //url
        $url = "https://graph.facebook.com/v2.6/" . $this->id;
        
        //query string
        $queryString = [];
        $queryString["fields"] = implode($fields, ",");
        $queryString["access_token"] = $accessToken;
        
        //final url
        $url = $url . "?" . http_build_query($queryString); 

        //send request
        $response = $client->get($url);

        //return body 
        return $response->getBody();
    }

}