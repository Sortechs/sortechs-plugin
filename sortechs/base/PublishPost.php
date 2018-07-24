<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/24/18
 * Time: 10:21 AM
 */
namespace Sortechs\base;
use Sortechs\Sortechs;

class PublishPost{
    
    public static function publish($post){

        /**@var $token \Sortechs\Authentication\AccessToken */
        /**@var $sortechs Sortechs */
        if($post['post_status']!='publish'){
            return;
        }
        $credentials = Model::get_credentials();
        if(!empty($credentials)) {
            $data = [
                'app_id' => trim($credentials['sortechs_id']),
                'app_secret' => trim($credentials['sortechs_secret']),
            ];
            $sortechs = new Sortechs($data);
            $token = new \Sortechs\Authentication\AccessToken($sortechs->generateAccessToken());
        }
        //add tags
        $tags = [];
        foreach ($post['tags'] as $tag)
            $tags[]=$tag->name;

        if(is_array($post['post_category']) and !empty($tags))
            foreach ($post['post_category'] as $item) {
                $tags = $sortechs->app->tags([
                    //'sectionId'=>'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXx', //id from your api
                    'sectionName'=>$item,
                    'tags'=>$tags
                ]);
                $sortechs->AddTags($token,$tags);
            }

        $media_array=[];

        if(!empty($post['image']))
            $media_array[]= [
                'url'=>$post['image'],
                'caption'=>null,
                'type'=>'image'
            ];

        foreach ($post['attachments'] as $item) {
            $type= 'image';
            $media_array[]= [
                'url'=>$item->guid,
                'caption'=>null,
                'type'=>$type
            ];
        }
        $media = $sortechs->app->media($media_array);
        if(is_array($post['post_category']))
            foreach ($post['post_category'] as $item) {
                $news = $sortechs->app->news([
                    //'sectionId'=>'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXx', //id from your api *Required or sectionName
                    'sectionName'=>$item,//*Required or sectionId
                    'title'=>$post['post_title'],//*Required
                    'article'=>$post['content'],//*Required
                    'url'=>$post['url'],//*Required
                    'newsId'=>$post['ID'], /*id from your DATABASE , Like 1000  *Required */
                    'options'=>[

                    ] /* Optional*/
                ]);
                if(!empty($media_array)){
                   $s =  $sortechs->AddNewsWithMedia($token,$news,$media);
                }else{
                     $s= $sortechs->AddNews($token,$news);
                }

              /*  print_r($s);*/
            }

            /*die;*/
    }
    
}