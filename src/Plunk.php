<?php
/**
 * This file is part of the Laravel Plunk Package
 * 
 * (c) Toyosi Oyelayo <toyosioyelayo@gmail.com>
 */

 namespace Toyosi12\Plunk;

 use Illuminate\Support\Facades\Http;
 use GuzzleHttp\Client;


 class Plunk {
     private $baseUrl = 'https://api.useplunk.com/v1';

     private $secretKey;

     public function __construct(){
         $this->secretKey = config('plunk.secretKey');
     }


     /**
      * Create an HTTP request
      */
     private function makeRequest($url, $method, $body = []){
         $fullUrl = $this->baseUrl . $url;

         $client = new Client(
            [
                'verify' => './cacert.cer',
                'base_uri' => $fullUrl,
                'headers' => [
                    'Authorization' => "Bearer " . $this->secretKey,
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json'
                ]
            ]
        );

        $response = $client->{strtolower($method)}(
            $fullUrl,
            ["body" => json_encode($body)]
        );

         if($response->unauthorized()){
             abort(401, "Unauthorized");
         }

         if($response->notFound()){
             abort(401, "This resource could not be found");
         }

         if(!$response->ok()){
             abort(500, "Unknown error");
         }

         return $response;
     }

     /**
      * Trigger an event and create it if it does not exist
      */
     public function triggerEvent($body){
        return $this->makeRequest('/track', 'post', $body);
     }

     /**
      * Get the details of a specific contact
      */
    public function getContact($id){
        return $this->makeRequest(`/contacts/${$id}`, 'get');
    }

    /**
     * Get a list of all contacts in your Plunk account
     */
    public function getAllContacts(){
        return $this->makeRequest('/contacts', 'get');
    }

    /**
     * Get the total number of contacts in your Plunk account
     */
    public function countContacts(){
        return $this->makeRequest('/contacts/count', 'get');
    }

    /**
     * Create a new contact in your Plunk project without triggering an event
     */
    public function createContact($body){
        return $this->makeRequest('/contacts', 'post', $body);
    }

    /**
     * Update a contact's subscription status to subscribed
     */
    public function subscribeContact($body){
        return $this->makeRequest('/contacts/subscribe', 'post', $body);
    }

    /**
     * Update a contact's subscription status to unsubscribed
     */
    public function unsubscribeContact($body){
        return $this->makeRequest('/contacts/unsubscribe', 'post', $body);
    }

    /**
     * Send transactional email
     */
    public function sendTransactionalEmail($body){
        return $this->makeRequest('/send', 'post', $body);
    }


 }

