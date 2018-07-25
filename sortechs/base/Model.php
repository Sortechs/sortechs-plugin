<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 4:24 PM
 */
namespace Sortechs\base;

class Model{

    public static function get_credentials(){
        global $wpdb;

        $credentials =[];

        $table =$wpdb->prefix.SORTECHS_CONFIG_TABLE;

        $query = "select id,sortechs_id,sortechs_secret from $table limit 1";

        $number = $wpdb->query($query);

        if($number>0){
            $credentials = $wpdb->get_row($query,ARRAY_A);
        }

        return $credentials;
    }

    public static function remove_credentials($id){
        global $wpdb;
        $table =$wpdb->prefix.SORTECHS_CONFIG_TABLE;
        return $wpdb->delete($table,['id'=>$id]);
    }

    public static function create_credentials($id,$secret){
        $obj = new AccessToken();
        $data = $obj->check($id,$secret);

        if(empty($data->getValue())){
            return 'Error validating App Id or App secret. <a href="https://social.sortechs.com/info/apiSettings/index.html" target="_blank">click here!</a>';
        }else{
            global $wpdb;
            $table =$wpdb->prefix.SORTECHS_CONFIG_TABLE;
            return $wpdb->insert($table,[
                'sortechs_id'=>$id,
                'sortechs_secret'=>$secret  ,
                'time'=>date('Y-m-d H:i:s'),
            ]);
        }
    }

    public static function create_add_new_category($id,$category_sortechs_id){
        global $wpdb;
        $table =$wpdb->prefix.SORTECHS_CONFIG_TABLE_SECTION;
        return $wpdb->insert($table,[
            'term_id'=>$id,
            'category_sortechs_id'=>$category_sortechs_id  ,
            'time'=>date('Y-m-d H:i:s'),
        ]);
    }

    public static function get_sortechs_category(){
        global $wpdb;

        $data =[];

        $table =$wpdb->prefix.SORTECHS_CONFIG_TABLE_SECTION;

        $query = "select * from $table";

        $number = $wpdb->query($query);


        if($number>0){
            $data = $wpdb->get_results($query,ARRAY_A);
        }
        return $data;
    }
}