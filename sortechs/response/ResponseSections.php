<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 03:05 م
 */
namespace Sortechs\response;
use Sortechs\Exceptions\SortechsExceptions;

class ResponseSections{

    private $response;

    private $sections;

    public function __construct(Response $response){

        $this->setResponse($response);

        if(isset($this->getResponse()->getResponse()->sections)){
            $this->setSections($this->getResponse()->getResponse()->sections);
        }else{
            $this->setResponse(new SortechsExceptions($response->getTextCode(),$response->getStatusCode()));
        }
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param mixed $sections
     */
    private function setSections($sections)
    {
        $this->sections = $sections;
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