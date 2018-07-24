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

/**
 * Class Request
 *
 * @package Sortechs
 */
class SortechsRequest
{

    protected $app;

    /**
     * @var string|null The access token to use for this request.
     */
    protected $accessToken;

    /**
     * @var string The HTTP method for this request.
     */
    protected $method;

    /**
     * @var string The Graph endpoint for this request.
     */
    protected $endpoint;

    /**
     * @var array The headers to send with this request.
     */
    protected $headers = [];

    /**
     * @var array The parameters to send with this request.
     */
    protected $params = [];

    /**
     * @var array The files to send with this request.
     */
    protected $files = [];

    private $url = 'https://social.sortechs.com/v1/api';

    const DEFAULT_REQUEST_TIMEOUT = 60;

    /**
     * @const int The timeout in seconds for a request that contains file uploads.
     */
    const DEFAULT_FILE_UPLOAD_REQUEST_TIMEOUT = 3600;

    /**
     * @const int The timeout in seconds for a request that contains video uploads.
     */
    const DEFAULT_VIDEO_UPLOAD_REQUEST_TIMEOUT = 7200;

    public function __construct($endpoint,$method='GET',$params,AccessToken $accessToken = null){
        $this->endpoint= $this->url.$endpoint.'?';
        $this->method = $method;
        $this->accessToken = $accessToken;
        $this->PreparationParams($params);
        if(SORTECHS_NOW==2){
            $this->url=SORTECHS_DOMAIN_API_TEST;
        }elseif(SORTECHS_NOW==1){
            $this->url=SORTECHS_DOMAIN_API;
        }elseif(SORTECHS_NOW==3){
            $this->url=SORTECHS_DOMAIN_API_LOCAL;
        }
     }

    public function Request(){

        $token = $this->getToken();
        if (!is_array($token))
            throw new SortechsExceptions('token key not found in url');
        $url = $this->endpoint;
        $service_url = $url.key($token).'='.$token[key($token)];
        $curl_post_data =[];
        $curl_post_data[key($token) ]= $token[key($token)];
        $curl_post_data = array_merge($curl_post_data,$this->params);
        $authorization = "Authorization: ".Sortechs::Authorization;
        $token = 'token: '.Sortechs::token;
        $header_data = [
            $token,
            $authorization
        ];
        if($this->accessToken){
            $header_data[]= 'accessToken: '.$this->accessToken->getValue();
        }
        $timeout = getenv(static::DEFAULT_REQUEST_TIMEOUT);
        if(is_array($this->params)){
            if(isset($this->params['timeout'])){
                $timeout = $this->params['timeout'];
                unset($this->params['timeout']);
            }
        }
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header_data);
        curl_setopt($curl, CURLOPT_USERAGENT,$this->getUserAgent());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_POST,true);
        $url_data = http_build_query($curl_post_data);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $url_data);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            throw new SortechsExceptions('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            throw new SortechsExceptions('error occured: ' . $decoded->response->errormessage);
        }

        return !empty($decoded)?$decoded:$curl_response;
    }

    private function getToken(){
        $url = $this->url.'/getToken';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT,$this->getUserAgent());
        $authorization = "Authorization: ".Sortechs::Authorization;
        $token = 'token: '.Sortechs::token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json',$token,$authorization));        $result = curl_exec($ch);
        curl_close($ch);
        return $json = json_decode($result, true);
    }

    private function PreparationParams($param){

        $this->params =$param;
    }

    private function getUserAgent(){
        return 'sortechs-php-' . Sortechs::VERSION;
    }
}
