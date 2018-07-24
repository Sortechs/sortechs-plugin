<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 16/08/17
 * Time: 03:34 م
 */
namespace Sortechs;

use Sortechs\Exceptions\SortechsExceptions;

class Media{

    private $url;

    private $type;

    private $full_type;

    private $caption;

    private $length;

    /**
     * @return mixed
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

     /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
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
    public function getFullType()
    {
        return $this->full_type;
    }

    /**
     * @param mixed $full_type
     */
    public function setFullType($full_type)
    {
        $this->full_type = $full_type;
    }

    /**
     * @param mixed $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


    public function valid(){
        return $this->checkUrl($this->getUrl());
    }

    private function checkUrl($image){
        $data = parse_url($image);
        $content_type = [
            'image/gif',
            'image/jpeg',
            'image/png',
            'video/mpeg',
            'video/ogg',
            'video/webm',
            'video/mp4',
        ];
        if(is_array($data)){
            if(isset($data['scheme'])){
                $header = get_headers($image,1);
                if(is_array($header)){
                    if(isset($header['Content-Type']) and (in_array($header['Content-Type'],$content_type))){
                        $ex = explode('/',$header['Content-Type']);

                        if(isset($ex[0]) and strtolower($ex[0])==strtolower($this->type)){
                            $this->setType(explode('/',$header['Content-Type'])[0]);
                            $this->setFullType($ex);
                            $this->setLength(isset($header['Content-Length'])?$header['Content-Length']:0);
                            return true;
                        }
                    }
                }
            }
        }
        return  new SortechsExceptions('Please check type media not compatible with source .',500);
    }

    public function getData(){
        return [
            'url'=>$this->getUrl(),
            'type'=>$this->getType(),
            'caption'=>$this->getCaption(),
            'full_type'=>$this->getFullType(),
            'length'=>$this->getLength()
        ];
    }
}