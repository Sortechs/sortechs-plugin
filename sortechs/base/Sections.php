<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/23/18
 * Time: 12:19 PM
 */
namespace Sortechs\base;

use Sortechs\request\Section;
use Sortechs\Sortechs;

class Sections{

    public function addSection($title){
        /**@var $token \Sortechs\Authentication\AccessToken */
        /**@var $sortechs Sortechs */
        $credentials = Model::get_credentials();
        if(!empty($credentials)) {
            $data = [
                'app_id' => trim($credentials['sortechs_id']),
                'app_secret' => trim($credentials['sortechs_secret']),
            ];
            $sortechs = new Sortechs($data);
            $token = new \Sortechs\Authentication\AccessToken($sortechs->generateAccessToken());

            $data_section = new Section(['title' => $title]);
            return  $sortechs->addSection($token, $data_section);

        }
        return null;
    }
}