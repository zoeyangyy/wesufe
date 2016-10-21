<?php
namespace Home\Controller;
use Think\Controller;

class LearnController extends Controller {

	public function course() {

		dump(session('openid'));
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

	}
}