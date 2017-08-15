<?php

namespace KilroyWeb\WPTools\API\Clients;

class CURLClient{

    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function setAuthorization($authorization){
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    }

    public function call($method, $url, $data = false)
    {

        switch ($method)
        {
            case "POST":
                if ($data)
                    curl_setopt($this->curl, CURLOPT_POST, 1);
                    curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case "PUT":
                curl_setopt($this->curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_VERBOSE, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($this->curl);

        if (curl_errno($this->curl)) {
            print curl_error($this->curl);
        }

        curl_close($this->curl);

        return $result;
    }

}