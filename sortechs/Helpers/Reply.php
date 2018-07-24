<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 02/10/17
 * Time: 04:46 م
 */
namespace Sortechs\Helpers;

class Reply extends BaseHelper{



    /**@var $code integer */
    private $code;
    /**@var $status integer */
    private $status;
    /**@var $code integer */
    private $message;
    /**
     * Returns the static model of the specified class.
     * @param string $className class name.
     * @return $this
     */

    public static function Go($className=__CLASS__)
    {
        return parent::Helper($className);
    }


    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param int $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function getReply(){

        return json_encode([
            'code'=>$this->getCode(),
            'status'=>$this->getStatus(),
            'message'=>$this->getMessage()
        ]);
    }
    public function PrintReply(){

        echo json_encode([
            'code'=>$this->getCode(),
            'status'=>$this->getStatus(),
            'message'=>$this->getMessage()
        ]);

        exit();
    }
}