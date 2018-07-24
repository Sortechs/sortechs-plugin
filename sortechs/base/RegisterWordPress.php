<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 2:22 PM
 */
namespace Sortechs\base;

use Sortechs\Helpers\Arrays;

class RegisterWordPress{

    public function __construct(){

        global $wpdb;
        $table_name = $wpdb->prefix . SORTECHS_CONFIG_TABLE;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "
        CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            sortechs_id text NOT NULL,
            sortechs_secret text NOT NULL,
        PRIMARY KEY  (id)
		) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        add_option( 'sortechs_db_version', SORTECHS_VERSION );
        $table_name = $wpdb->prefix . SORTECHS_CONFIG_TABLE_SECTION;
        $sql = "
        CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            term_id BOOLEAN NOT NULL DEFAULT FALSE,
             category_sortechs_id text NOT NULL,
        PRIMARY KEY  (id)
		) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        add_option( 'sortechs_db_version', SORTECHS_VERSION );

        add_action('admin_enqueue_scripts',[$this,'_register_style']);
        add_action('admin_enqueue_scripts',[$this,'_register_script']);
        add_action('admin_enqueue_scripts',[$this,'_register_my_script']);
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        add_filter('plugin_action_links_'.SORTECHS_NAME_PLUGIN,[$this,'settings_link']);
        add_action('admin_menu',[$this,'add_admin_pages']);

        add_action('post_submitbox_misc_actions', [$this,'createCustomField']);
        add_action('save_post', [$this,'saveCustomField']);

    }

    public function _register_style(){
        wp_enqueue_style('sortechs_plugin',plugins_url('/../../assets/style.css',__FILE__));
     }

    public function _register_script(){
        wp_enqueue_script('sortechs_plugin',plugins_url('/../../assets/script.js',__FILE__));
    }

    public function _register_my_script(){
        wp_enqueue_script('sortechs_plugin',plugins_url('/../../assets/functions.js',__FILE__));
    }

   public  function createCustomField()
    {
        $post_id = get_the_ID();

        if (get_post_type($post_id) != 'post') {
            return;
        }

        $value = get_post_meta($post_id, 'sortechs_custom_field', true);
        wp_nonce_field('my_custom_nonce_'.$post_id, 'my_custom_nonce');
        if($value==0){
            ?>
            <div class="misc-pub-section misc-pub-section-last">
                <label><input type="checkbox" value="1" checked="checked" data-value="<?=$value?>" <?php checked($value, true, true); ?> name="sortechs_custom_field" /><?php _e('Publish to Sortechs', 'pmg'); ?></label>
            </div>
            <?php
        }else {
            ?>
            <div class="misc-pub-section misc-pub-section-last">
                <label><?php _e('Published', 'pmg'); ?></label>
            </div>
            <?php
        }
    }

    public  function saveCustomField($post_id){



        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (
            !isset($_POST['my_custom_nonce']) ||
            !wp_verify_nonce($_POST['my_custom_nonce'], 'my_custom_nonce_'.$post_id)
        ) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        if (isset($_POST['sortechs_custom_field'])) {
            update_post_meta($post_id, 'sortechs_custom_field', $_POST['sortechs_custom_field']);
        } else {
            delete_post_meta($post_id, 'sortechs_custom_field');
        }


        if (current_user_can('publish_posts', $post_id) and isset($_POST['sortechs_custom_field'])) {

            if($_POST['sortechs_custom_field']){
                $data= Arrays::get_attr_post($post_id);

                PublishPost::publish($data);

            }
        }
        if (current_user_can('edit_post', $post_id)  and isset($_POST['action'])and $_POST['action']=='editpost' ) {
            $value = get_post_meta($post_id, 'sortechs_custom_field', true);
            //to do action

        }
    }

    public function activate(){
        Activate::activate();
    }

    public function deactivate(){
        Deactivate::deactivate();
    }

    public function db_install_fun(){


    }

    public function settings_link($links){
        $settings = '<a href="admin.php?page=sortechs_index">Settings</a>';
        array_push($links,$settings);
        return $links;
    }

    public function add_admin_pages(){
        $obj = new Menu();
    }
}