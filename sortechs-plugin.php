<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/18/18
 * Time: 2:45 PM
 * @package SortechsPlugin
 *
 */
/*
Plugin Name: Sortechs
Plugin URI: https://www.sortechs.com/wordpress-plugin
Description: <strong>Sortechs</strong> is a powerful tool to manage your favorite social media accounts
Version:1.0.0
Author: Sortechs Team (mohammad m salahat)
Author URI: https://www.linkedin.com/in/mohammad-m-salahat-996a1086/
License: GPLv2 or later
Text Domain: sortechs-plugin
*/
defined('ABSPATH') or die('Hey, you can\'t access this file , you silly human!');
if(file_exists(dirname(__FILE__).'/vendor/autoload.php'))
    require_once dirname(__FILE__).'/vendor/autoload.php';
define( 'SORTECHS_VERSION', '1.0.0' );
define( 'SORTECHS__MINIMUM_WP_VERSION', '4.0' );
define( 'SORTECHS__DEBUG',true);
define( 'SORTECHS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SORTECHS_DELETE_LIMIT', 100000 );
define( 'SORTECHS_ICON', plugins_url('/assets/icon.ico',__FILE__));
define( 'SORTECHS_LOGO', plugins_url('/assets/logo.png',__FILE__));
define( 'SORTECHS_NAME_PLUGIN',plugin_basename(__FILE__));
define( 'SORTECHS_NAME','Sortechs');
define( 'SORTECHS_CONFIG_TABLE','sortechs');
define( 'SORTECHS_CONFIG_TABLE_SECTION','sortechs_category');
define( 'SORTECHS_MNUE','sortechs_index');
define( 'SORTECHS_DOMAIN_API','https://social.sortechs.com/v1/api');
/*define( 'SORTECHS_DOMAIN_API_TEST','https://staging.sortechs.com/v1/api');
define( 'SORTECHS_DOMAIN_API_LOCAL','https://local.sortechs.com/v1/api');
define( 'SORTECHS_NOW','2')*/;
exec ("find ".__DIR__."/cache -type d -exec chmod 0750 {} +");
exec ("find ".__DIR__."/cache -type f -exec chmod 0644 {} +");
$sortechs = new \Sortechs\SortechsWordPress();

