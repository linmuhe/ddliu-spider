
<?php
require(__DIR__.'/../vendor/autoload.php');

use ddliu\spider\Spider;
use ddliu\spider\Pipe\NormalizeUrlPipe;
use ddliu\spider\Pipe\RequestPipe;
use ddliu\spider\Pipe\DomCrawlerPipe;

$spiderx =(new Spider())
    ->pipe(new NormalizeUrlPipe())
    ->pipe(new RequestPipe())
    ->pipe(new DomCrawlerPipe())
    ->pipe(function($spider, $task) {
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
			$spider->logger->addInfo("{$title} --- {$url} --- is from ---".$task->parent['url']);
		});
	}else{
		//match a.attr 
        	$task['$dom']->filter('a')
           	 ->each(function($context) use ($spider,$task) {
		    $url = $context->attr('href');
		    $title="";
		    $spider->logger->addInfo("find new url ".$url."--from".$task['url']);
		
		    $task->fork($url);
           	 });
	}
    })
    /*
     * ->pipe(function($spider, $task) {
     *     if (!preg_match('#^https://github.com/[\w_]+/[\w_]+$#', $task['url'])) return;
     *     $issueCount = trim($task['$dom']->filter('li.commits span.num')->text());
     *     $spider->logger->addInfo($task['url'].' has '.$issueCount.' commits');
     * })
     */
    ->addTask('http://yyliu.top') ;
try{    
	$spiderx->run() ->report();
}catch(\Exception $e){
	die("x\n");
	echo $e->getTraceAsString()."\n";
}
