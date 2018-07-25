<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 3:11 PM
 */
namespace Sortechs\base;

use Sortechs\pages\Main;
use Sortechs\pages\Authorization;
use Sortechs\pages\Section;

class Menu extends Base{

    public function __construct(){

        $this->main();
        $this->auth();
        $this->section();
    }

    private function main(){
        $obj = new Main();

        add_menu_page(
            SORTECHS_NAME,
            SORTECHS_NAME,
            'manage_options',
            SORTECHS_MNUE,
            [
                $obj,'main'
            ],
            SORTECHS_ICON,
            null
        );
    }
    private function auth(){

        $obj = new Authorization();
        add_submenu_page(
            SORTECHS_MNUE,
            'Authorization',
            'Authorization',
            'manage_options',
            'sortechs_authorization',
            [
                $obj,'authorization'
            ]

        );
    }

    private function section(){

        $obj = new Section();
        add_submenu_page(
            SORTECHS_MNUE,
            'Section',
            'Section',
            'manage_options',
            'sortechs_section',
            [
                $obj,'section'
            ]

        );
    }

}