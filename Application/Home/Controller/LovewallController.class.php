<?php
namespace Home\Controller;
use Think\Controller;

class LovewallController extends Controller {
	public function lovewallPanel()
	{	
		$this->assign('openid',$_GET['openid']);
		$this->assign('title','表白墙');
		$this->display();
	}
	public function lovewallDetail()
	{
		$this->assign('title','详情');
		$this->display();
	}
	public function post(){

		if(!$_POST['openid']){
			dump("请关注wesufe公众号");
		}
		else{
			$lovewall=D('Lovewall');
			$lovewall->create();

			$data['openid']=$_POST['openid'];
			$data['text']=$_POST['text'];
			$data['sendtime']=date('Y-m-d H:i:s');
			$data['sender']=$_POST['sender'];
			$data['receiver']=$_POST['receiver'];
			$data['gender']=$_POST['gender'];

			$lovewall->add($data);

			redirect('/Home/Lovewall/lovewallPanel?openid='.$_POST['openid']);
		}

	}
}