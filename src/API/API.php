<?php

namespace KilroyWeb\WPTools\API;

use KilroyWeb\WPTools\API\Clients\CURLClient;

class API{

    private $apiURL;
    private $apiKey;

    public function __construct($apiURL,$apiKey)
    {
        $this->apiURL = $apiURL;
        $this->apiKey = $apiKey;
    }

    public function get($uri){
        $results = $this->request('GET', $uri);
        return $results;
    }

    public function post($uri,$data){
        $results = $this->request('POST', $uri, $data);
        return $results;
    }

    public function patch($uri,$data){
        $results = $this->request('PATCH', $uri, $data);
        return $results;
    }

    public function delete($uri){
        $results = $this->request('DELETE', $uri);
        return $results;
    }

    private function getFullURL($uri){
        $url = $this->apiURL;
        $url = $this->removeTrailingSlash($url);
        $url .= '/'.$uri;
        return $url;
    }

    private function removeTrailingSlash($string){
        $string = preg_replace('{/$}', '', $string);
        return $string;
    }

    private function request($method, $uri, $data = false){
        $fullURL = $this->getFullURL($uri);
        $client = new CURLClient();
        $client->setAuthorization('Authorization: Bearer '.$this->apiKey);
        $request = $client->call($method, $fullURL, $data);
        $response = json_decode($request);
        if(!empty($response->error)){
            print_r($response);
            die();
        }
        return $response;
    }

}