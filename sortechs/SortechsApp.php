<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 16/08/17
 * Time: 03:03 م
 */

namespace Sortechs;

use Sortechs\Authentication\AccessToken;
use Sortechs\Exceptions\SortechsExceptions;
use Sortechs\Helpers\FileSortechs;

class SortechsApp{
    /**
     * @var string The app ID.
     */
    private $id;

    /**
     * @var string The app secret.
     */
    private $secret;



    /**
     * @param string $id
     * @param string $secret
     */
    public function __construct($id, $secret){

        
        $this->id = $id;
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

   public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

   


    /**@param $data
     * @return News
     * @throws 
     */
    public function news(array $data=[]){
        $news = new News();
        foreach ($data as $index=>$item) {
            if(property_exists($news,$index)){
                $function = 'set'.ucfirst($index);
                $news->$function($item);
            }else{
                throw new SortechsExceptions('this "'.$index.'" key not property in news class');
            }
        }

        return $news;
    }

    /**@param $data
     * @return UpdateNews
     * @throws
     */
    public function updateNews(array $data=[]){
        $news = new UpdateNews();
        foreach ($data as $index=>$item) {
            if(property_exists($news,$index)){
                $function = 'set'.ucfirst($index);
                $news->$function($item);
            }else{
                throw new SortechsExceptions('this "'.$index.'" key not property in news class');
            }
        }

        return $news;
    }

    /**@param $data array
     * @return Media
     * @throws 
     */
    public function media(array $data=[]){
        $media_array=[];
        foreach ($data as $row) {
            if(isset($row['file'])){
                $file = $row['file'];
                if($file instanceof FileSortechs){
                    $f = ['file'=>$file];
                    if(isset($row['caption'])){
                        $f['caption']=$row['caption'];
                    }
                    $media_array[]=$f;
                }
            }else{

                $media = new Media();
                foreach ($row as $index=>$item) {
                    if(property_exists($media,$index)){
                        $function = 'set'.ucfirst($index);
                        $media->$function($item);
                    }else{
                        throw new SortechsExceptions('this "'.$index.'" key not property in media class');
                    }
                }
                try{
                    $media->valid();
                    $media_array[]=$media;

                }catch (SortechsExceptions $e){
                    echo $e->getMessage();
                    exit();
                }
            }
        }

        return $media_array;
    }


    /**@param $data array
     * @return array
     * @throws
     */
    public function tags(array $data = []){
        $tags = [];

        if(!isset($data['tags'])){
            throw new SortechsExceptions('tags not found ');
        }
        if(empty($data['tags'])){
            throw new SortechsExceptions('Please full tags on array');
        }
        echo '<pre>';
        foreach ($data['tags'] as $value) {

            $tag = new Tags();
            $string = strip_tags($value);
            $string = str_replace('&nbsp;',' ',$string);
            $string = str_replace('&#039;','',$string);
            $string = str_replace('&raquo;','»',$string);
            $string = str_replace('&laquo;','«',$string);
            $string = str_replace('&quot;','"',$string);
            $string = str_replace('&apos;','\'',$string);
            $string = str_replace('&#x2018;','‘',$string);
            $string = str_replace('&#x2019;','’',$string);
            $string = str_replace('&#8220;','“',$string);
            $string = str_replace('&#8221;','”',$string);
            $string = str_replace('&#8220;','“',$string);
            $string = str_replace('&#8221;','”',$string);
            $string = str_replace('&#039;','\'',$string);
            $string= preg_replace('/\p{C}+/u', "", $string);
            $string = html_entity_decode($string);
            $string = str_replace('# #', '#', $string);
            $string = str_replace('##', '#', $string);
            $string = str_replace('…',' ... ',$string);
            $string = str_replace('”','"',$string);
            $string = str_replace('“','"',$string);
            $string = str_replace('–','-',$string);
            $string = strip_tags($string);
            $tag->setText($string);
            if(isset($data['sectionId']))
                $tag->setSectionId($data['sectionId']);
            if(isset($data['sectionName']))
                $tag->setSectionName($data['sectionName']);
            $tags[] = $tag;

            print_r($tag);
            continue;
        }

        die;

        return [
            'tags'=>$tags,
            'sectionId'=>isset($data['sectionId'])?$data['sectionId']:'',
            'sectionName'=>isset($data['sectionName'])?$data['sectionName']:'',
        ];
    }

    public function get($endPoint,$data,AccessToken $accessToken = null){
        $data =  new SortechsRequest($endPoint,'GET',$data,$accessToken);
        return $data->Request();
    }

    public function post($endPoint,$data,AccessToken $accessToken = null){
        $data =  new SortechsRequest($endPoint,'POST',$data,$accessToken);
        return $data->Request();
    }


}