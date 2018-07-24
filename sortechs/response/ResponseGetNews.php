<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 03:05 م
 */
namespace Sortechs\response;
use Sortechs\Exceptions\SortechsExceptions;

class ResponseGetNews{
    private $news;

    private $id;

    private $title;

    private $article;

    private $sectionId;

    private $customer_id;

    private $client_id;

    private $url;

    private $news_id;

    private $response;


    public function __construct(Response $response){
        if(isset($response->getResponse()->news)){
            $this->setResponse($response);
            $this->setNews($response->getResponse()->news);
            if(!empty($this->getNews())){

                if(is_object($this->getNews())){
                    foreach ($this->getNews() as $index=>$new) {
                        if(property_exists($this,$index)){
                            $function = 'set'.ucfirst($index);
                            $this->$function($new);
                        }
                    }
                }
            }
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

    /**
     * @return mixed
     */
    public function getNewsId()
    {
        return $this->news_id;
    }

    /**
     * @param mixed $news_id
     */
    public function setNews_id($news_id)
    {
        $this->news_id = $news_id;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
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
    public function getSectionId()
    {
        return $this->sectionId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $article
     */
    private function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @param mixed $client_id
     */
    private function setClient_id($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @param mixed $customer_id
     */
    private function setCustomer_id($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @param mixed $id
     */
    private function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @param mixed $sectionId
     */
    private function setSectionId($sectionId)
    {
        $this->sectionId = $sectionId;
    }

    /**
     * @param mixed $title
     */
    private function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $url
     */
    private function setUrl($url)
    {
        $this->url = $url;
    }


}