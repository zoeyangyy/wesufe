<?php
namespace Home\Controller;
use Think\Controller;

class LearnController extends Controller {

	public function course() {

		$User = M('User');
		$openid=$_GET['openid'];
		$condition['openid'] = $openid;

		$stuNo=$User->where($condition)->getField('stuNo');
		$accessToken=$User->where($condition)->getField('accessToken');
		$json = file_get_contents("http://weixin.sufe.edu.cn/api/std/timetable?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		$obj = json_decode($json,true);
		dump($obj);
        
		$this->display();
		
	}
	public function library() {
		$command1 = escapeshellcmd('python '.dirname(__FILE__).'/search.py --keyword=java --page=1');
		$output1 = shell_exec($command1);
		header("Content-type: text/html; charset=utf-8");
		$result = json_decode($output1, true);
		$this->assign('books',$result);
		$this->display();		
	}

	public function bookitem(){
		$command2 = escapeshellcmd('python '.dirname(__FILE__).'/search.py --bookurl=item.php?marc_no='.$_GET["url"]);
		$output2 = shell_exec($command2);
		header("Content-type: text/html; charset=utf-8");
		$result=json_decode($output2,true);
		$storeinfo=$result['storeinfor'];
		$this->assign('bookinfo',$result);
		$this->assign('storeinfo',$storeinfo);
		$this->display();
	}

	public function score() {
		$User = M('User');
		$openid=$_GET['openid'];
		$condition['openid'] = $openid;
		
		$stuNo=$User->where($condition)->getField('stuNo');
		$accessToken=$User->where($condition)->getField('accessToken');
		$json = file_get_contents("http://weixin.sufe.edu.cn/api/std/gpasummary?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		$obj = json_decode($json,true);
		dump($obj);
        
		$this->display();

	}
}