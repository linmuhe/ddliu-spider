<?php
/**
 * Created by PhpStorm.
 * User: muhe0
 * Date: 2017/4/27
 * Time: 23:17
 */

namespace ddliu\spider\Pipe;


class SpiderRequestException extends  PipeException
{
    /**
     * @return null
     */
    public function getErrno()
    {
        return $this->errno;
    }


    /**
     * @return null
     */
    public function getErrmsg()
    {
        return $this->errmsg;
    }



    private $errno;
    private $errmsg;

    public function __construct($message = "", $errno=null,$errmsg=null)
    {
        parent::__construct($message);
        $this->errno=$errno;
        $this->errmsg=$errmsg;
    }

}