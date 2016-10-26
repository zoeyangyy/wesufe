<?php
namespace Home\Behaviors;
use Think\Behavior;

class accesstokenBehavior extends Behavior{
    public function run(&$param){
		$User=M('User');
		$openid = session('openid');
		$user=$User->where(array('openid'=>$openid))->find();
		if($user['accessToken_time']){
			$param=array('toast_type'=>'warn',
				'msg_title' => '您已经注册过了',
			);
		}
    }
}