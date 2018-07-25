<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 12:59 م
 */
namespace Sortechs\response;
class ResponseCustomer{

    private $id;

    private $name;

    private $expired_date;

    private $response;

    private $me;

    /**
     * @return mixed
     */
    public function getMe()
    {
        return $this->me;
    }

    /**
     * @param mixed $me
     */
    private function setMe($me)
    {
        $this->me = $me;
    }


    /**
     * @return mixed
     */
    public function getExpiredDate()
    {
        return $this->expired_date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $expired_date
     */
    private function setExpiredDate($expired_date)
    {
        $this->expired_date = $expired_date;
    }

    /**
     * @param mixed $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    private function setName($name)
    {
        $this->name = $name;
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

    public function CustomerPreparation(Response $response){

        $this->setResponse($response->getResponse());

        if(isset($this->getResponse()->customer)){
            $this->setMe($this->getResponse()->customer);
        }
        if(isset($this->getResponse()->customer->id)){
            $this->setId($this->getResponse()->customer->id);
        }else{
            $this->setId(null);
        }

        if(isset($this->getResponse()->customer->title)){
            $this->setName($this->getResponse()->customer->title);
        }else{
            $this->setName(null);
        }

        if(isset($this->getResponse()->customer->expired_date)){
            $this->setExpiredDate($this->getResponse()->customer->expired_date);
        }else{
            $this->setExpiredDate(null);
        }

    }
}