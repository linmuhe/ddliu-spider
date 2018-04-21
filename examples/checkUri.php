
<?php

require(__DIR__.'/../vendor/autoload.php');

use ddliu\spider\Spider;
use ddliu\spider\Pipe\NormalizeUrlPipe;
use ddliu\spider\Pipe\RequestPipe;
use ddliu\spider\Pipe\DomCrawlerPipe;
use ddliu\spider\Pipe\checkUriPipe;
use ddliu\spider\Pipe\echoCheckPipe;

$spiderx =(new Spider())
    ->pipe(function($spider,$task) {
    	static $has=array();
		if(!array_search($task->url,$has)){
			$has[] = $task->url ;
			$spider->logger->addInfo(count($has)." size checked");
		}else{
			throw new Exception("已经测试过");
		}
    })
    ->pipe(new NormalizeUrlPipe())
    ->pipe(new RequestPipe())
    ->pipe(new DomCrawlerPipe());
$spiderx->pipe(new checkUriPipe())->pipe(new echoCheckPipe());
    /*
     * ->pipe(function($spider, $task) {
     *     if (!preg_match('#^https://github.com/[\w_]+/[\w_]+$#', $task['url'])) return;
     *     $issueCount = trim($task['$dom']->filter('li.commits span.num')->text());
     *     $spider->logger->addInfo($task['url'].' has '.$issueCount.' commits');
     * })
     */
$spiderx ->addTask('http://yeyelf.xyz') ;
	$spiderx->run();
checkUriPipe::repeat($spiderx);
$spiderx->report();

