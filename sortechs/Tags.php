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

        $string = strip_tags($Text);
        $string = str_replace('&nbsp;',' ',$string);
        $string = str_replace('&#039;','',$string);
        $string = str_replace('&raquo;','»',$string);
        $string = str_replace('&laquo;','«',$string);
        $string = str_replace('&quot;','"',$string);
        $string = str_replace('&apos;','\'',$string);
        $string = str_replace('&#x2018;','‘',$string);
        $string = str_replace('&#x2019;','’',$string);
        $string = str_replace('&#8220;','“',$string);
        $string = str_replace('&#8221;','”',$string);
        $string = str_replace('&#8220;','“',$string);
        $string = str_replace('&#8221;','”',$string);
        $string = str_replace('&#039;','\'',$string);
        $string= preg_replace('/\p{C}+/u', "", $string);
        $string = html_entity_decode($string);
        $string = str_replace('# #', '#', $string);
        $string = str_replace('##', '#', $string);
        $string = str_replace('…',' ... ',$string);
        $string = str_replace('”','"',$string);
        $string = str_replace('“','"',$string);
        $string = str_replace('–','-',$string);
        $string = strip_tags($string);
        $this->text =  $string;

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