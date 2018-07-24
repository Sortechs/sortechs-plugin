<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 05:33 م
 */
namespace Sortechs\request;
use Sortechs\Exceptions\SortechsExceptions;
use Sortechs\Helpers\Text;

class Section extends Request{
    
    private $title;

    public function __construct(array  $data){

        if(!isset($data['title'])){
         return  new SortechsExceptions(' Not found title section please check it .',500);
        }

        if(empty($data['title'])){
            return  new SortechsExceptions(' Not found title section please check it .',500);
        }
        $text = new Text($data['title']);
        $this->setTitle($text->getString());
    }

    public function getData(){
        return [
            'title'=>$this->getTitle()
        ];
    }

    /**
     * @return mixed
     */
    private function getTitle()
    {
        return $this->title;
    }



    /**
     * @param mixed $title
     */
    private function setTitle($title){
        $this->title = $title;
    }
}