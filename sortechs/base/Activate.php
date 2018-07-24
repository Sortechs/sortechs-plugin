<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/18/18
 * Time: 7:23 PM
 * @package SortechsPlugin
 */

namespace Sortechs\base;

class Activate {

    public static function activate() {
        flush_rewrite_rules();
    }

}