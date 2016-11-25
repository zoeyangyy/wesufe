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
		$postid=$_GET['postid'];
		$comment=D('Comment');
		$condition['postid'] = $postid;
		$list=$comment->relation(true)->where($condition)->order('commentid')->select();

		$lovewall=D('Lovewall');
		$post=$lovewall->relation(true)->where($condition)->find();

		$this->assign('result',$list);
		$this->assign('post',$post);
		$this->assign('title','详情');
		$this->assign('openid',$_GET['openid']);
		$this->assign('postid',$postid);
		$this->display();
	}
	public function post(){

		if(!$_POST['openid']){
			dump("请关注wesufe公众号");
		}
		else{
			$lovewall=D('Lovewall');
			$lovewall->create();

			$openid=$_POST['openid'];
			$condition['openid'] = $openid;
			$User=M('User');
			$data['userid']=$User->where($condition)->getField('userid');
			$data['text']=$_POST['text'];
			$data['sendtime']=date('Y/m/d H:i');
			$data['sender']=$_POST['sender'];
			$data['receiver']=$_POST['receiver'];
			$data['gender']=$_POST['gender'];

			$lovewall->add($data);

			redirect('/Home/Lovewall/lovewallPanel?openid='.$_POST['openid']);
		}
	}

	public function ajaxGetpost(){
		$lovewall=D('Lovewall');
		$number=$_GET['page'];
		$type=$_GET['type'];
		if($type=="time"){
			$list = $lovewall->relation(true)->order('postid desc')->limit($number,5)->select();
			$this->ajaxReturn($list);
		}
		elseif($type=="like"){
			$list = $lovewall->relation(true)->order('like_number desc,postid desc')->limit($number,5)->select();
			$this->ajaxReturn($list);
		}
	}
	public function ajaxLike(){
		$lovewall=M('Lovewall');
		$postid=$_POST['postid'];
		$condition['postid'] = $postid;
		$type=$_POST['type'];
		$item=$lovewall->where($condition)->find();
		if($type=="1"){
			$data['like_number']=$item['like_number']+1;
			$lovewall->where($condition)->save($data);
		}elseif($type=="0"){
			$data['like_number']=$item['like_number']-1;
			$lovewall->where($condition)->save($data);
		}
	}

	public function comment(){
		$comment=D('Comment');
		$comment->create();
		
		$postid=$_POST['postid'];
		$condition2['postid']=$postid;
		$lovewall=M('Lovewall');
		$postitem=$lovewall->where($condition2)->find();
		$data2['comment_number']=$postitem['comment_number']+1;
		$lovewall->where($condition2)->save($data2);

		$openid=$_POST['openid'];
		$condition['openid'] = $openid;
		$User=M('User');
		$userid=$User->where($condition)->find();
		$data['userid']=$userid['userid'];
		$data['postid']=$_POST['postid'];
		$data['text']=$_POST['comment'];

		$data['sendtime']=date('Y/m/d H:i');

		$comment->add($data);
		redirect('/Home/Lovewall/lovewallDetail?postid='.$_POST['postid'].'&openid='.$_POST['openid']);
	}
}