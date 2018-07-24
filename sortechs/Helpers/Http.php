<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 02/10/17
 * Time: 01:51 م
 */
namespace Sortechs\Helpers;
class Http extends BaseHelper{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className class name.
     * @return $this
     */
    public static function Request($className=__CLASS__)
    {
        return parent::Helper($className);
    }

    public function _GET($index){

        if(isset($_GET[$index])){
            return $_GET[$index];
        }
        return null;
    }

    public function _POST($index){
        if(isset($_POST[$index])){
            return $_POST[$index];
        }
        return null;
    }

    public function _REQUEST($index){
        if(isset($_REQUEST[$index])){
            return $_REQUEST[$index];
        }
        return null;
    }

    public function _FILES($index){
        if(isset($_FILES[$index])){
            return $_FILES[$index];
        }
        return null;
    }
}