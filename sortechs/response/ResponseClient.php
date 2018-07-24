<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 03:05 م
 */
namespace Sortechs\response;
use Sortechs\Exceptions\SortechsExceptions;

class ResponseClient{

    private $response;

    private $clients;

    public function __construct(Response $response){

        $this->setResponse($response);

        if(isset($this->getResponse()->getResponse()->clients)){
            $this->setClients($this->getResponse()->getResponse()->clients);
        }else{
            $this->setResponse(new SortechsExceptions($response->getTextCode(),$response->getStatusCode()));
        }
    }

    /**
     * @return mixed
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @param mixed $clients
     */
    private function setClients($clients)
    {
        $this->clients = $clients;
    }

    /**
     * @param mixed $response
     */
    private function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

}