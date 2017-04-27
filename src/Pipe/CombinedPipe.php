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
        foreach ($this->pipes as $pipe) {
            if ($task->isEnded()) {
                break;
            }
	    try{
		   // echo "fail ".get_class($pipe) ."-".method_exists($pipe,'fail')==true."\n";
            	$pipe->run($spider, $task);
	    }catch(\Exception $e){     
		    var_dump($pipe);exit;
	         $echoe=true; 
	       	if(method_exists($pipe,'fail')){
			die("xxxxxxx");
			$echoe = $pipe->fail($spider,$task,$e);	
		 }
		if($echoe ){
			$task->putExce($e);
		}
	     }
        }
  	 if(false!==($fire=$task->isExce())){
		  // is false or first exce
		  throw $fire ;
	  }
	//bug if exception ,after linked-pipe will not run ;
	

    }
}
