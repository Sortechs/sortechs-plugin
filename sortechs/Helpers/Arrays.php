<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/23/18
 * Time: 12:32 PM
 */
namespace Sortechs\Helpers;

class Arrays{

    public static function convert_object_to_array($object){
        $array = [];
        foreach ($object as $index=>$item) {
            $array[$index] = (array) $item;
        }

        return $array;
    }

    public static function category_helper_checker($cat ,$sortechs){

        foreach ($cat as $index=>$item) {
            if(isset($item['term_id'])){
                foreach ($sortechs as $sortech) {
                    if($sortech['term_id'] == $item['term_id']){
                        $cat[$index]['used']=true;
                    }
                }
                if(!isset($cat[$index]['used'])){
                    $cat[$index]['used']= false;
                }
            }
        }
        return $cat;
    }

    public static function get_attr_post( $post_id ){
        $post = get_post($post_id);

        $category_detail=get_the_category($post_id);//$post->ID
        $cats= [];
        foreach($category_detail as $cat){
            $cats[]=$cat->cat_name;
        }
        $post_tags = wp_get_post_tags($post_id);
        $post_image = get_the_post_thumbnail_url($post_id);
        $args = array(
            'posts_per_page' => 50,
            'order'          => 'ASC',
            'post_mime_type' => 'image',
            'post_parent'    => $post_id,
            'post_status'    => null,
            'post_type'      => 'attachment',
        );
        $attachments = get_children( $args );
        $attr = [
            'ID'=>$post->ID,
            'url'=>$post->guid,
            'post_title'=>$post->post_title,
            'content'=>$post->content,
            'post_status'=>$post->post_status,
            'post_category'=>$cats,
            'tags'=>$post_tags,
            'image'=>$post_image,
            'attachments'=>$attachments,
        ];
        return $attr;
    }

}