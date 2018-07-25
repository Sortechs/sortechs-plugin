<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 1:42 PM
 */
namespace Sortechs;
use Sortechs\Authentication\AccessToken;
use Sortechs\Exceptions\SortechsExceptions;
use Sortechs\request\Request;
use Sortechs\request\Section;
use Sortechs\response\Response;
use Sortechs\response\ResponseAddSections;
use Sortechs\response\ResponseClient;
use Sortechs\response\ResponseGenerateAccessToken;
use Sortechs\response\ResponseGetNews;
use Sortechs\response\ResponseNews;
use Sortechs\response\ResponseNewsMedia;
use Sortechs\response\ResponseSections;
use Sortechs\response\ResponseTags;
class Sortechs extends Request{
    const VERSION = '0.0.1';

    const APP_ID_ENV_NAME = 'SORTECHS_APP_ID';

    const APP_SECRET_ENV_NAME = 'SORTECHS_APP_SECRET';

    const Authorization = '?AnV1`pL`Xx-k9Rhr%ygec8Fvo_v>7>nmqDpO4IToq)"AZU.{SK17#%Rn*a1cV*';

    const token = 'ABC9D2DB2C6D76A1583C3E7F7393D-2DA9EA96F57769C3';

    public $app;

    public $accessToken;



    /**
     * @param $config array
     * @throws SortechsExceptions
     */
    public function __construct(array $config = [])
    {

        $config = array_merge([
            'app_id' => getenv(static::APP_ID_ENV_NAME),
            'app_secret' => getenv(static::APP_SECRET_ENV_NAME)
        ], $config);

        if (!$config['app_id']) {
            throw new SortechsExceptions('Required "app_id" key not supplied in config and could not find fallback environment variable "' . static::APP_ID_ENV_NAME . '"');
        }
        if (!$config['app_secret']) {
            throw new SortechsExceptions('Required "app_secret" key not supplied in config and could not find fallback environment variable "' . static::APP_SECRET_ENV_NAME . '"');
        }

        if (isset($config['accessToken'])) {
            $this->accessToken = new AccessToken($config['accessToken']);
        }

        $this->setUseCurl(function_exists('curl_init'));

        $this->app = $this->run($config);

        return $this->app;
    }

    public function setUseCurl($use_curl)
    {
        if ($use_curl && !function_exists('curl_init')) {
            throw new \Exception('To use cURL, the PHP curl extension must be available.');
        }
    }

    public function run($config)
    {
        return new SortechsApp($config['app_id'], $config['app_secret']);
    }

   /* public function generateAccessToken()
    {
        $obj = new Response(
            $this->app->post(
                '/generateAccessToken',
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret()
                ]
            )
        );
        $this->accessToken = new  ResponseGenerateAccessToken($obj);
        return $this->accessToken;
    }*/


   public function generateAccessToken(){
       $s = $this->app->post(
           '/generateAccessToken',
           [
               'id' => $this->app->getId(),
               'secret' => $this->app->getSecret()
           ]
       );

       if($s instanceof \stdClass){

           if(isset($s->statusCode) and $s->statusCode==200){
               if(isset($s->response)){
                   if($s->response instanceof \stdClass){

                       $this->accessToken = new  ResponseGenerateAccessToken($s->response);
                   }
               }
           }else{
               echo $s->textCode;
           }

       }else{

       }

       return $this->accessToken;
   }


    public function getSections(AccessToken $token)
    {
        $obj = new Response(
            $this->app->post(
                '/getSection',
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret(),
                    'accessToken' => $token->getValue()
                ],
                $token
            )
        );
        $Section = new  ResponseSections($obj);
        return $Section;
    }

    public function addSection(AccessToken $token, Section $data)
    {


        return $this->app->post(
            '/AddSection',
            array_merge(
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret(),
                    'accessToken' => $token->getValue()
                ],
                $data->getData()
            ),
            $token
        );
    }

    public function getClients(AccessToken $token)
    {
        $obj = new Response(
            $this->app->post(
                '/getClients',
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret(),
                    'accessToken' => $token->getValue()
                ],
                $token
            )
        );
        $client = new  ResponseClient($obj);
        return $client;
    }

    public function AddNews(AccessToken $token, News $news)
    {
        $obj = new Response(
            $this->app->post(
                '/addNews',
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret(),
                    'accessToken' => $token->getValue(),
                    'news' => $news->getData()
                ],
                $token
            )
        );
        return new  ResponseNews($obj);
    }

    public function SendNews(AccessToken $token, UpdateNews $news){

        $obj = new Response(
            $this->app->post(
                '/updateNews',
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret(),
                    'accessToken' => $token->getValue(),
                    'news' => ($news->getData())
                ],
                $token
            )
        );
        return new  ResponseGetNews($obj);
    }

    public function SendNewsWithMedia(AccessToken $token, UpdateNews $news, $media)
    {
        /**@var Media $item */
        $data_media = [];
        foreach ($media as $item) {
            $data_media[] = $item->getData();
        }
        $obj = new Response(
            $this->app->post(
                '/updateNewsWithMedia',
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret(),
                    'accessToken' => $token->getValue(),
                    'news' => ($news->getData()),
                    'media' => ($data_media)
                ],
                $token
            )
        );
        return new  ResponseNewsMedia($obj);
    }

    public function AddTags(AccessToken $token, $data)
    {
        $data_tags = [];
        /**@var $tag Tags */
        $tags = $data['tags'];
        $sectionName = $data['sectionName'];
        $sectionId = $data['sectionId'];
        foreach ($tags as $tag) {
            $data_tags[] = $tag->getData();
        }
        $obj = new Response(
            $this->app->post(
                '/addTags',
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret(),
                    'accessToken' => $token->getValue(),
                    'tags' => $data_tags,
                    'sectionName' => $sectionName,
                    'sectionId' => $sectionId,
                ],
                $token
            )
        );
        return new  ResponseTags($obj);
    }

    public function AddNewsWithMedia(AccessToken $token, News $news, $media)
    {
        /**@var Media $item */
        $data_media = [];
        foreach ($media as $item) {
            $data_media[] = $item->getData();
        }
        $obj = new Response(
            $this->app->post(
                '/addNewsMedia',
                [
                    'id' => $this->app->getId(),
                    'secret' => $this->app->getSecret(),
                    'accessToken' => $token->getValue(),
                    'news' => $news->getData(),
                    'media' => $data_media
                ],
                $token
            )
        );
        return new  ResponseNewsMedia($obj);
    }


    public function getNews($id, $section_id, AccessToken $token)
    {
        if (!empty($id) and !empty($section_id)) {
            return
                new  ResponseGetNews(
                    new Response($this->app->post(
                        '/get_news',
                        [
                            'id' => $this->app->getId(),
                            'secret' => $this->app->getSecret(),
                            'accessToken' => $token->getValue(),
                            'news_id' => $id,
                            'section_id' => $section_id
                        ],
                        $token
                    )));
        } else {
            throw new SortechsExceptions('Please check news id or section id empty');
        }
    }
}