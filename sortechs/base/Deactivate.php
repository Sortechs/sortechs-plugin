<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/18/18
 * Time: 7:24 PM
 * @package SortechsPlugin
 */

namespace Sortechs\base;
class Deactivate {
    public static function deactivate( ) {
        flush_rewrite_rules();
    }
}