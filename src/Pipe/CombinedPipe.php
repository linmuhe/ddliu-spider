<?php
/**
 * spider
 * @copyright 2014 Liu Dong <ddliuhb@gmail.com>
 * @license MIT
 */

namespace ddliu\spider\Pipe;

/**
 * Combine pipes
 */
class CombinedPipe extends BasePipe {
    protected $pipes = array();

    public function __construct() {
        foreach (func_get_args() as $pipe) {
            $this->pipe($pipe);
        }
    }

    public function pipe($pipe) {
        $pipe = BasePipe::makePipe($pipe);
        $this->pipes[] = $pipe;

        return $this;
    }

    public function run($spider, $task) {
        $excep=false ;
        foreach ($this->pipes as $pipe) {
            if ($task->isEnded()) {
                break;
            }
            //fixed bug  if exception ,after linked-pipe will not run ;
            while ($se = $task->nextExce()) {
                if ($pipe->fail($spider, $task, $se)) {
                    // default fail is false , if not passed the code ,$excep will throw
                    //so exception must will be processed
                    //consume
                    throw $se;
                }
            }
            if(!$excep){
                try {
                    $pipe->run($spider, $task);
                } catch (\Exception $e) {
                    $excep=true ;
                 //   echo $e;
                    $task->putExce($e);
                }
            }
        }
        if($excep && $mustede=$task->nextExce()){
            throw $mustede;
        }
    }
}
