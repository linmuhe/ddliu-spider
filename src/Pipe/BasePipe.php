<?php
/**
 * spider
 * @copyright 2014 Liu Dong <ddliuhb@gmail.com>
 * @license MIT
 */

namespace ddliu\spider\Pipe;

/**
 * The base pipe
 */
abstract class BasePipe implements PipeInterface {
    protected $pipes = array();

    abstract public function run($spider, $task);

    public function pipe($pipe) {
        $pipe = self::makePipe($pipe);

        return new CombinedPipe($this, $pipe);
    }
    protected $throwed=false;
    /***
     *
     * @param $spider
     * @param $task
     * @param $e  previous pipe throwed Exception
     * @return bool   true =pipe will not through pipe fail methods
     */
    public function fail($spider,$task, $e){
        $this->throwed=true ;
        return false ;
    }
    public static function makePipe($pipe) {
        if ($pipe instanceof PipeInterface) {
            return $pipe;
        } elseif (is_callable($pipe)) {
            $pipe = new FunctionPipe($pipe);
            return $pipe;
        } else {
            throw new PipeException('Invalid pipe');
        }
    }
}