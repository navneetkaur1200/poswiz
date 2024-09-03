<?php 
namespace App\Library;

Class PushNotification{
    public $key ='b91e5f8f16ddd1fa69d0d7a9e9298986';
    public $url ='https://api.pushalert.co/rest/v1/';
    public $endpoint = '';

    function __construct($action ='send'){
        $this->endpoint = $action;
    }

    function sendNotification($data = array()){
        $headers = Array();
        $headers[] = "Authorization: api_key=".$this->key;

        echo "<pre>"; print_r(http_build_query($data)); die();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.$this->endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $output = json_decode($result, true);
        return $output;
    }
}
?>