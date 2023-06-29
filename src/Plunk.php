<?php
/**
 * This file is part of the Laravel Plunk Package
 * 
 * (c) Toyosi Oyelayo <toyosioyelayo@gmail.com>
 */

 namespace Toyosi12\Plunk;

 use Illuminate\Support\Facades\Http;


 class Plunk {
     /**
      * The Plunk API base url
      *
      * @var string
      */
     private $baseUrl = 'https://api.useplunk.com/v1';

     /**
      * Your secret key
      * @var string
      */
     private $secretKey;

     /**
      * Create a new Plunk instance
      */
     public function __construct(){
         $this->secretKey = config('plunk.secretKey');
     }


     /**
      * Create an HTTP request
      * 
      * @param string $url
      * @param string $method
      * @param array $body
      */
     private function makeRequest($url, $method, $body = []){
         $fullUrl = $this->baseUrl . $url;

         if($this->secretKey == null){
            abort(400, 'Please provide SECRET_KEY in .env');
        }

         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $this->secretKey,
             'Content-Type' => 'application/json'
         ])->{strtolower($method)}($fullUrl, $body);

         if($response->status() != 200 && $response->status() != 201) abort($response->status(), $response['message'] ?? 'Unknown Error');

         return response($response)->withHeaders([
             'Content-Type' => 'application/json'
         ]);

     }

     /**
      * Trigger an event and create it if it does not exist
      * 
      * @param object $body
      * @return json
      */
     public function triggerEvent($body){
        return $this->makeRequest('/track', 'post', $body->all());
     }

     /**
      * Get the details of a specific contact
      *
      * @param string $id
      * @return json
      */
    public function getContact($id){
        return $this->makeRequest('/contacts/' . $id, 'get');
    }

    /**
     * Get a list of all contacts in your Plunk account
     * 
     * @return array
     */
    public function getAllContacts(){
        return $this->makeRequest('/contacts', 'get');
    }

    /**
     * Get the total number of contacts in your Plunk account
     * 
     * @return json
     */
    public function countContacts(){
        return $this->makeRequest('/contacts/count', 'get');
    }

    /**
     * Create a new contact in your Plunk project without triggering an event
     * 
     * @param object $body
     * @return json
     */
    public function createContact($body){
        return $this->makeRequest('/contacts', 'post', $body->all());
    }

    /**
     * Update a contact's subscription status to subscribed
     * 
     * @param object $body
     * @return json
     */
    public function subscribeContact($body){
        return $this->makeRequest('/contacts/subscribe', 'post', $body->all());
    }

    /**
     * Update a contact's subscription status to unsubscribed
     * 
     * @param object $body
     * @return json
     */
    public function unsubscribeContact($body){
        return $this->makeRequest('/contacts/unsubscribe', 'post', $body->all());
    }

    /**
     * Send transactional email
     * 
     * @param object $body
     * @return json
     */
    public function sendTransactionalEmail($body){
        return $this->makeRequest('/send', 'post', $body->all());
    }


 }

