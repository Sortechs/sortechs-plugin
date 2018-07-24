<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 1:07 PM
 */
namespace Sortechs\base;
class Options{

    private $PageTitle='Sortechs';

    public function __construct(){

    }

    /**
     * @return string
     */
    public function getPageTitle(){
        return $this->PageTitle;
    }

    /**
     * @param string $PageTitle
     */
    public function setPageTitle($PageTitle){
        $this->PageTitle .= '| '.$PageTitle;
    }
}