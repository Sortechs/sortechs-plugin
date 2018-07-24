<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/18/18
 * Time: 4:31 PM
 * @package SortechsPlugin
 */

if( ! defined('WP_UNINSTALL_PLUGIN') ){
    die;
}

/*$news = get_posts(['post_type'=>'news']);

foreach ($news as $item) {
    wp_delete_post($item->ID,true);
}*/

global $wpdb;

$wpdb->query('DELETE FROM wp_posts WHERE post_type="news"');
$wpdb->query('DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)');
$wpdb->query('DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)');