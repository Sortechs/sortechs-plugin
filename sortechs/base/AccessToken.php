<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 7:40 PM
 */
namespace Sortechs\base;

use Sortechs\Sortechs;
use \Sortechs\Authentication\AccessToken as Token;

class AccessToken{

    public function check($app_id,$app_secret){
        $data = [
            'app_id' => $app_id,
            'app_secret' => $app_secret,
        ];
        /**@var $so \Sortechs\Sortechs **/
        $obj = new Sortechs($data);
        return new Token($obj->generateAccessToken());
    }

    public function GenerateAccessToken(){

        $credentials = Model::get_credentials();
        if(!empty($credentials)){

            $data = [
                'app_id' =>trim( $credentials['sortechs_id']),
                'app_secret' => trim($credentials['sortechs_secret']),
            ];
            $sortechs = new Sortechs($data);

            $token = new Token($sortechs->generateAccessToken());
            return  [$sortechs,$token];
        }
        return [null,null];
    }
}