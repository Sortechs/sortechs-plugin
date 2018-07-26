<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 06:04 م
 */
namespace Sortechs\Helpers;
class Text{
    public $string;

    /**
     * @param mixed $string
     */
    public function __construct($string)
    {
        $this->string = $this->ClearHtmlTags($string);
    }

    /**
     * @return mixed
     */
    public function getString()
    {
        return $this->string;
    }

    private function ClearHtmlTags($string){
        if(empty($string)){
            return $string;
        }
        $string = strip_tags($string);
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
        return $string;
    }
}