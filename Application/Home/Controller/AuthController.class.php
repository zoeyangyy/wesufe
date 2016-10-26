<?php
namespace Home\Controller;

use Think\Controller;

class AuthController extends Controller
{
    public function index()
    {
		$User = M('User');
		$openid=session('openid');
		$condition['openid'] = $openid;

        $data['accessToken']=$_GET["access_token"];
        $data['accessToken_time']=time();
        $data['stuNo']=$_GET["openid"];  //这里的openid是学号

        $json = file_get_contents("http://weixin.sufe.edu.cn/api/std/info?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$_GET["access_token"]."&openid=".$_GET["openid"]);
		$obj = json_decode($json,true);

        $data['stuName'] = $obj['name'];
        $data['stuClass'] = $obj['className'];
        $data['stuMajor'] = $obj['major'];

        $User->where($condition)->save($data);
    }

    public function redirect($openid)
    {
    	session('openid',$openid);
    	redirect("http://weixin.sufe.edu.cn/oauthv2/authorize?client_id=4f6p8203&response_type=code&redirect_uri=http://dev.wesufe.cn/auth");

    }
}