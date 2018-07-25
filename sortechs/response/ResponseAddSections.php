<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 03:05 م
 */
namespace Sortechs\response;
use Sortechs\Exceptions\SortechsExceptions;

class ResponseAddSections{

    private $response;

    private $sections;

    private $section;

    private $created;
    private $updated;

    public function __construct(Response $response){

        $this->setResponse($response);

        if(isset($this->getResponse()->getResponse()->sections)){
            $this->setSections($this->getResponse()->getResponse()->sections);
        }else{
            $this->setResponse(new SortechsExceptions($response->getTextCode(),$response->getStatusCode()));
        }

        if(isset($this->getResponse()->getResponse()->section->created)){
            if($this->getResponse()->getResponse()->section->created){
                $this->setCreated(true);
                $this->setSection($this->getResponse()->getResponse()->section->data);
            }else{
                $errors = $this->getResponse()->getResponse()->section->data;
                $message = '';
                foreach ($errors as $index=>$error) {
                    $message.='{ '.$index.' } :'.$error.PHP_EOL;
                }
                $this->setResponse(new SortechsExceptions($response->getTextCode(),$response->getStatusCode()));
            }
        }elseif (isset($this->getResponse()->getResponse()->section->updated)){
            if($this->getResponse()->getResponse()->section->updated){
                $this->setCreated(true);
                $this->setSection($this->getResponse()->getResponse()->section->data);
            }else{
                $errors = $this->getResponse()->getResponse()->section->data;
                $message = '';
                foreach ($errors as $index=>$error) {
                    $message.='{ '.$index.' } :'.$error.PHP_EOL;
                }
                $this->setResponse(new SortechsExceptions($message,$this->getResponse()->getResponse()->statusCode));
            }
        }else{
            $this->setResponse(new SortechsExceptions($response->getTextCode(),$response->getStatusCode()));
        }
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    private function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    private function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param mixed $section
     */
    private function setSection($section)
    {
        $this->section = $section;
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