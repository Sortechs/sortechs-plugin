<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 7:19 PM
 */
namespace Sortechs;
use Sortechs\base\RegisterWordPress;

class SortechsWordPress{
    public function __construct(){
        new RegisterWordPress();
    }
}