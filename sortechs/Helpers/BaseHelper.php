<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 02/10/17
 * Time: 01:53 م
 */
namespace Sortechs\Helpers;
class BaseHelper{
    private static $_helper=[];
    
    public static function Helper($className=__CLASS__)
    {
        if(isset(self::$_helper[$className]))
            return self::$_helper[$className];
        else {
            $model=self::$_helper[$className]=new $className(null);
            return $model;
        }
    }
}