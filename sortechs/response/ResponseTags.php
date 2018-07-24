<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 03:05 م
 */
namespace Sortechs\response;
use Sortechs\Exceptions\SortechsExceptions;

class ResponseTags{
    private $response;

    private $tags;

    public function __construct(Response $response){

        $this->setResponse($response);
        if(isset($this->getResponse()->getResponse()->tags)){
            $this->setTags($this->getResponse()->getResponse()->tags);
        }else{
            $this->setResponse(new SortechsExceptions($response->getTextCode(),$response->getStatusCode()));
        }
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    private function setTags($tags)
    {
        $this->tags = $tags;
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