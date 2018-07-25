<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 2:58 PM
 */
namespace Sortechs\pages;
use Sortechs\base\Base;
class Main extends Base {

    public function main(){
        $this->setPageTitle('Main');
        $this->render('main');
    }
}