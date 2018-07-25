<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 16/08/17
 * Time: 03:34 م
 */
namespace Sortechs;

use Sortechs\Helpers\Text;

class Tags{


    private $sectionId='';

    private $sectionName ='';

    private $text;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getSectionName()
    {
        return $this->sectionName;
    }

    /**
     * @param mixed $sectionName
     */
    public function setSectionName($sectionName)
    {
        $this->sectionName = $sectionName;
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
    public function getSectionId()
    {
        return $this->sectionId;
    }

    /**
     * @param mixed $Text
     */
    public function setText($Text){
        $helper = new Text($Text);
        $this->text = $helper->getString();
    }


    public function valid(){
        if(!empty($this->getText())){
            return true;
        }

        return false;
    }


    public function getData(){
        return $this->getText() ;
    }
}