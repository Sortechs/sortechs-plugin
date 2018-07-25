<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 12:41 م
 */
namespace Sortechs\response;
use Sortechs\Exceptions\SortechsExceptions;

class Response{
    private $StatusCode;

    private $textCode;

    private $response;

    private $customer;

    public function __construct($response){
        if(!isset($response->statusCode)){
            return 'Not found response';
        }
        if($response->statusCode==200){
            try{
                $this->setResponse($response->response);
                $this->setStatusCode($response->statusCode);
                $this->setCustomer($response->response->customer);

                return $this;
            }catch (SortechsExceptions $e){
                return ['code'=>500,'message'=>'not found response'];
            }
        }else{
            $this->setStatusCode($response->statusCode);
            if(isset($response->textCode))
                $this->setResponse(new SortechsExceptions($response->textCode,$response->statusCode));
            else{
                if(isset($response->response->customer))
                    $this->setCustomer($response->response->customer);
                $this->setResponse($response->response);
            }

            return $this;
        }

    }

    /**
     * @return mixed
     */
    public function getTextCode()
    {
        return $this->textCode;
    }

    /**
     * @param mixed $TextCode
     */
    public function setTextCode($TextCode)
    {
        $this->textCode = $TextCode;
    }

    /**
     * @param mixed $StatusCode
     */
    private function setStatusCode($StatusCode)
    {
        $this->StatusCode = $StatusCode;
    }

    /**
     * @param mixed $response
     */
    private function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    private function setCustomer($customer)
    {
        $this->customer = $customer;
    }



    /**
     * @return mixed
     */
    public function getResponse()
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
}