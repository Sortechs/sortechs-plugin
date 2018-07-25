<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 2:58 PM
 */
namespace Sortechs\pages;
use Sortechs\base\Base;
use Sortechs\base\Model;
class Authorization extends Base {
    public function authorization(){
        $this->setPageTitle('Authorization');
        $params =[];
        $results= null;
        if (isset($_POST['sortechs'])){
            $post = $_POST;
            $id= isset($post['id'])?$post['id']:null;
            $app_id= isset($post['app_id'])?$post['app_id']:null;
            $app_secret= isset($post['secret_id'])?$post['secret_id']:null;

            if(isset($post['submit_btn'])){

                switch ($post['submit_btn']){
                    case 'remove';
                    if(!is_null($id)){
                        $results =  Model::remove_credentials($id);
                        if($results){
                            $results='Sortechs not connected.';
                        }
                    }
                    break;
                    case 'create';

                    if(!empty($app_id) and !empty($app_secret)){
                        $results =  Model::create_credentials($app_id,$app_secret);
                        if($results){
                            $results='Wonderful!, sortechs now is connected with WordPress';
                        }
                    }else{
                        $results='Please app id and app secret required';
                    }
                        break;
                }
            }
        }
        $credentials = Model::get_credentials();
        $params = array_merge($params,$credentials);
        $params = array_merge($params,['url'=>the_permalink()]);
        $params = array_merge($params,['results'=>$results]);

        $this->render('authorization',$params);
    }
}