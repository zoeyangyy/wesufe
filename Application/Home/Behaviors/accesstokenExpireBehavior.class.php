<?php
namespace Home\Behaviors;
use Think\Behavior;

class accesstokenExpireBehavior extends Behavior{
    public function run(&$param){
		$User=M('User');
		$openid = session('openid');
		$user=$User->where(array('openid'=>$openid))->find();
		if((time()-$user['accesstoken_time'])/86400>80){

			);
		}
    }
}