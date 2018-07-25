<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 12:19 م
 */
namespace Sortechs\response;
class  ResponseGenerateAccessToken extends ResponseCustomer{

    private $StatusCode;

    private $response;

    private $accessToken;

    private $expiry;

    public function __construct($response){
        
        if(isset($response->accessToken)){
            $this->setAccessToken($response->accessToken);
        }

        if(isset($response->expiry)){
            $this->setExpiry($response->expiry);
        }

        $this->setResponse($response);
    }

    /**
     * @param mixed $expiry
     */
    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;
    }

    /**
     * @return mixed
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
    /**
     * @param mixed $StatusCode
     */
    public function setStatusCode($StatusCode)
    {
        $this->StatusCode = $StatusCode;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    private function getResponse()
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->StatusCode;
    }


    public function Preparation(Response $response){

        $this->CustomerPreparation($response);
        if(isset($this->getResponse()->accessToken)){
            $this->setAccessToken($this->response->accessToken);
        }else{
            $this->setAccessToken(null);
        }

        if(isset($this->getResponse()->expiry)){
            $this->setExpiry($this->response->expiry);
        }else{
            $this->setExpiry(null);
        }
    }

}