<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 16/08/17
 * Time: 03:25 م
 */
namespace Sortechs;
use Sortechs\Exceptions\SortechsExceptions;

class UpdateNews{

    private $newsId='';

    private $sectionId='';

    private $clientId='';

    private $title ='';

    private $article ='';

    private $url ='';

    private $options = [];

    /**
     * @param mixed $url
     * @throws SortechsExceptions
     */
    public function setUrl($url){
        $data = parse_url($url);
        if(is_array($data)){
            if(!isset($data['scheme'])){
                throw new SortechsExceptions('please check url',500);
            }
        }
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }




    /**
     * @param mixed $sectionId
     */
    public function setSectionId($sectionId){
        $this->sectionId = $sectionId;
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
    public function getSectionId()
    {
        return $this->sectionId;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }


    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }



    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @param string $id
     */
    public function setNewsId($id)
    {
        $this->newsId = $id;
    }

    /**
     * @return string
     */
    public function getNewsId()
    {
        return $this->newsId;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }



    public function getData(){
        return[

            'news_id'   => $this->getNewsId(),
            'clientId'   => $this->getClientId(),
            'sectionId'   => $this->getSectionId(),
            'title'       => $this->getTitle(),
            'article'     => $this->getArticle(),
            'url'         => $this->getUrl(),
            'options'     => $this->getOptions(),
            'sectionName'=>''
        ];
    }


}