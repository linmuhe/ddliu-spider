
<?php

///namespace ddliu\spider\Pipe;
require(__DIR__.'/../vendor/autoload.php');
use ddliu\spider\Pipe\BasePipe;

use ddliu\spider\Spider;
use ddliu\spider\Pipe\NormalizeUrlPipe;
use ddliu\spider\Pipe\RequestPipe;
use ddliu\spider\Pipe\DomCrawlerPipe;
use ddliu\spider\Pipe\checkUriPipe;
use ddliu\spider\Pipe\echoCheckPipe;
use ddliu\spider\Pipe\SpiderRequestException;

class checkcfail extends BasePipe {
	public static $result_succ=array();
	public static $result_err=array();
	function done(){
	}
	public static function repeat($spider){

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
    }


}

$spiderx =(new Spider())
    ->pipe(new NormalizeUrlPipe())
    ->pipe(new RequestPipe())
    ->pipe(new DomCrawlerPipe());
$spiderx->pipe(new checkcfail())->pipe(new echoCheckPipe());
/*checkonce */

$spiderx->addTask("https://www.lu2394.com/");
$spiderx->addTask("https://twitter.com");
$spiderx->addTask("https://cangjige.me/");
$spiderx->addTask("https://208.94.244.99/bt");
$spiderx->addTask("http://x.80529.x6.nabble.com/");
$spiderx->addTask("http://www2.xxxlicks.info/");
$spiderx->addTask("http://www.yingtaofuli.com/");
$spiderx->addTask("http://www.xyj2013.com");
$spiderx->addTask("http://www.xvideos.com/");
$spiderx->addTask("http://www.x5m3.com");
$spiderx->addTask("http://www.tuigirl.com/");
$spiderx->addTask("http://www.tokyo-hot.com/");
$spiderx->addTask("http://www.swinger7.com");
$spiderx->addTask("http://www.shlf.in/");
$spiderx->addTask("http://www.sewangchao1.com/");
$spiderx->addTask("http://www.sechungege.com");
$spiderx->addTask("http://www.rookie-av.jp");
$spiderx->addTask("http://www.qiseshequ.org");
$spiderx->addTask("http://www.porno666.com");
$spiderx->addTask("http://www.papl.top/");
$spiderx->addTask("http://www.nude-latina.com/");
$spiderx->addTask("http://www.ntdtv.com/");
$spiderx->addTask("http://www.maitianpiaoxiang.com/");
$spiderx->addTask("http://www.lw78.cc");
$spiderx->addTask("http://www.lu33.top");
$spiderx->addTask("http://www.ltz2.info/");
$spiderx->addTask("http://www.langyou11.com/");
$spiderx->addTask("http://www.kawaiikawaii.jp/");
$spiderx->addTask("http://www.jsmra.com");
$spiderx->addTask("http://www.hqseek.com/");
$spiderx->addTask("http://www.hong07.com/");
$spiderx->addTask("http://www.haisi789.pw");
$spiderx->addTask("http://www.fou3.com/");
$spiderx->addTask("http://www.fanhao520.org/");
$spiderx->addTask("http://www.erotica7.com/");
$spiderx->addTask("http://www.dsc666.com/forum.php");
$spiderx->addTask("http://www.degemaya.com/");
$spiderx->addTask("http://www.dasdas.jp");
$spiderx->addTask("http://www.cqheixiu.info/");
$spiderx->addTask("http://www.caoniuba.xyz/");
$spiderx->addTask("http://www.caoniu8.xyz");
$spiderx->addTask("http://www.biseba.com/");
$spiderx->addTask("http://www.aishx.com/");
$spiderx->addTask("http://www.aavvs.com/");
$spiderx->addTask("http://www.91sf.cc/");
$spiderx->addTask("http://www.900zyz.com/");
$spiderx->addTask("http://www.1pondo.tv/");
$spiderx->addTask("http://www.18p2p.com/forum/");
$spiderx->addTask("http://wichd8.com");
$spiderx->addTask("http://voyeurhit.com/");
$spiderx->addTask("http://v2once.tumblr.com");
$spiderx->addTask("http://tiine.cc/");
$spiderx->addTask("http://tcxcom.com/");
$spiderx->addTask("http://taohuabbs.info/");
$spiderx->addTask("http://simonen119.tumblr.com/");
$spiderx->addTask("http://sewo222.com/");
$spiderx->addTask("http://seshowclub.com");
$spiderx->addTask("http://scotthei.tumblr.com/");
$spiderx->addTask("http://readml.com/");
$spiderx->addTask("http://papaa.pw");
$spiderx->addTask("http://okfun.org/");
$spiderx->addTask("http://mrsimpleing.tumblr.com/");
$spiderx->addTask("http://mishimarei.tumblr.com/");
$spiderx->addTask("http://mf51.xyz/");
$spiderx->addTask("http://lsjsoso.com");
$spiderx->addTask("http://lifan.moe/");
$spiderx->addTask("http://lieqizhijia.com/");
$spiderx->addTask("http://lf0.info/");
$spiderx->addTask("http://khl.cc/");
$spiderx->addTask("http://girls-love-x.tumblr.com");
$spiderx->addTask("http://fuliba.net/");
$spiderx->addTask("http://forum.s54s.com/");
$spiderx->addTask("http://dobbyporn.com/");
$spiderx->addTask("http://cl.dicool.pw");
$spiderx->addTask("http://btlibrary.net/");
$spiderx->addTask("http://bbs.caoav.net/");
$spiderx->addTask("http://aishangvideo.com/");
$spiderx->addTask("http://adultfriendfinder.com/");
$spiderx->addTask("http://998de.com");
$spiderx->addTask("http://91.t9b.info/");
$spiderx->addTask("http://67.220.92.12/forum/");
$spiderx->addTask("http://5genvpiao.com");
$spiderx->addTask("http://2kill4.net/body.html");
$spiderx->addTask("http://23.252.165.226/");
$spiderx->addTask("http://206.108.54.66/~avsppnet/");
$spiderx->addTask("http://198.40.52.132/");
$spiderx->addTask("http://162.243.83.184/");


/*checkonce */
$spiderx->run();

checkcfail::repeat($spiderx);

$spiderx->report();

