<?php

namespace ddliu\spider\Pipe;
use ddliu\spider\Pipe\BasePipe;

class checkUriPipe extends BasePipe {
	public static $result_succ=array();
	public static $result_err=array();
	function done(){
	}
	public static function repeat($spider){
		$spider->logger->addInfo("succ::");
		while(!empty($stro=array_pop(self::$result_succ)))
		$spider->logger->addInfo($stro);

		$spider->logger->addInfo("cant reuquest::");
		while(!empty($stre=array_pop(self::$result_err)))
		$spider->logger->addInfo($stre);
	}
	public function fail($spider,$task, $e){
		if($e instanceof SpiderRequestException){
			if(!empty($task['url'])){
				$spider->logger->addError($e->getErrno()."--".$e->getErrmsg());
				self::$result_err[]=$task['url']." -- ".$task->parent_title;
			}
		}
		return false ;
		//$spider->logger->addError($e->getMessage());
	}
	//private $_task;
	function run($spider, $task) {
	//	$this->_task=$task ;
	
		/*
	 * var_dump(array_keys($task->getData()));
	 */
        //$spider->logger->addInfo($task['url']."-pipe\n");
	// if (!strpos($task['url'], 'tab=repositories')) return;
	// if has parent ;return  ;
	if(!empty($task->parent)){ 
		//get title
		$task['$dom']->filter('title')->each(function($content) use($spider,$task) {
			$url=$task['url'];
	//		echo get_class($content)."\n";
			$title=$content->text();
			self::$result_succ[]="{$title} -- {$url}".$task->parent_title;;
			$spider->logger->addInfo("{$title} --- {$url} --- is okay ,from ---".$task->parent['url']);
		});
	}else{
		//match a.attr 
        	$task['$dom']->filter('a')
           	 ->each(function($context) use($spider,$task) {
		    $url = $context->attr('href');
		    $title=$context->text();
		    $spider->logger->addInfo("find {$title} --- ".$url." ");
		
		    $task->fork($url,$title);
           	 });
	}
    }


}
