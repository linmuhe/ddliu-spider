<?php
namespace ddliu\spider\Pipe;

class checkUriPipe extends BasePipe {
	private $result_succ=array();
	private $result_err=array();
	function done(){
	}
	function fail(\Exception $e){

		$this->result_err[]=$this->_task['url'];

		$spider->logger->addError($e->getMessage(());
	}
	private $_task;
	function run($spider, $task) {
		$this->_task=$task ;
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
			$this->result_succ[]="{$title} --- {$url}";
			$spider->logger->addInfo("{$title} --- {$url} --- is from ---".$task->parent['url']);
		});
	}else{
		//match a.attr 
        	$task['$dom']->filter('a')
           	 ->each(function($context) use ($spider,$task) {
		    $url = $context->attr('href');
		    $title="";
		    $spider->logger->addInfo("find new url ".$url." ---from--- ".$task['url']);
		
		    $task->fork($url);
           	 });
	}
    }


}
