<?php
namespace Sortechs\Authentication;
use Sortechs\response\ResponseGenerateAccessToken;
use Sortechs\Sortechs;

/**
 * Class AccessToken
 *
 * @package Sortechs
 */
class AccessToken{
    protected $Customer;

    /**
     * The access token value.
     *
     * @var Sortechs
     */
    protected $value;

    protected $expiry;
    /**
     * Create a new access token entity.
     *
     * @param  $accessToken
     */
    public function __construct($accessToken){

        if($accessToken instanceof  ResponseGenerateAccessToken){
            $this->Customer = $accessToken;
            $this->value = $accessToken->getAccessToken();
            $this->expiry = $accessToken->getExpiry();
        }else{
            $this->value = $accessToken;
        }
    }
    /**
     * Returns the access token as a string.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * Returns the access token as a string.
     *
     * @return string
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

      /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->Customer;
    }

}