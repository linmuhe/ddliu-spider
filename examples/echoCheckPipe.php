<?php


namespace ddliu\spider\Pipe;

use ddliu\spider\Pipe\BasePipe;
use ddliu\spider\Pipe\checkUriPipe;

class echoCheckPipe extends BasePipe{

	function done(){
	}
	//function fail(\Exception $e){
	//}

     function run($spider, $task) {
	
	          $siz=$spider->getTaskCount();
           if($siz<=70){
               $spider->clearTask();
           }
	  
          $spider->logger->addInfo($spider->getTaskCount()." size not check ");
     }
}
