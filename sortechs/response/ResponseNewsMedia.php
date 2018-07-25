<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 03:05 م
 */
namespace Sortechs\response;
use Sortechs\Exceptions\SortechsExceptions;

class ResponseNewsMedia{
    private $response;

    private $news;

    public function __construct(Response $response){

        $this->setResponse($response);
        if(isset($this->getResponse()->getResponse()->news)){
            $this->setNews($this->getResponse()->getResponse()->news);
        }else{
            $this->setResponse(new SortechsExceptions($response->getTextCode(),$response->getStatusCode()));
        }
    }

    /**
     * @return mixed
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @param mixed $news
     */
    private function setNews($news)
    {
        $this->news = $news;
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