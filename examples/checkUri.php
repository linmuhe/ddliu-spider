
<?php
require(__DIR__.'/../vendor/autoload.php');

use ddliu\spider\Spider;
use ddliu\spider\Pipe\NormalizeUrlPipe;
use ddliu\spider\Pipe\RequestPipe;
use ddliu\spider\Pipe\DomCrawlerPipe;
use ddliu\spider\Pipe\checkUriPipe;

$spiderx =(new Spider())
    ->pipe(new NormalizeUrlPipe())
    ->pipe(new RequestPipe())
    ->pipe(new DomCrawlerPipe());
$spiderx->pipe(new checkUriPipe());
    /*
     * ->pipe(function($spider, $task) {
     *     if (!preg_match('#^https://github.com/[\w_]+/[\w_]+$#', $task['url'])) return;
     *     $issueCount = trim($task['$dom']->filter('li.commits span.num')->text());
     *     $spider->logger->addInfo($task['url'].' has '.$issueCount.' commits');
     * })
     */
$spiderx ->addTask('http://yyliu.top') ;

$spiderx->run();
checkUriPipe::repeat($spider);
$spiderx->report();

