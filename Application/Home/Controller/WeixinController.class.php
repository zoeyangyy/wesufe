<?php
namespace Home\Controller;
use Think\Controller;

class WeixinController extends Controller {

	public function setMenu(){
		import("Org.Wechat");
		$weObj = new \Wechat(C('WEIXIN_OPTIONS'));
		$weObj->deleteMenu();
		$user_menu = array(
			'button' => array(
				0 => array(
					'name' => '学习帮手',
					'sub_button' => array(
						0 => array(
							'type' => 'click',
							'name' => '个人课表',
							'key'=>'MENU_KEY_course',
						),
						1 => array(
							'type' => 'view',
							'name' => '图书查询',
							'url' => $weObj->getOauthRedirect(C('WEB_ROOT').'/home/learn/library'),
						),
						2 => array(
							'type' => 'click',
							'name' => '成绩查询',
							'key' => 'MENU_KEY_score',
						),
					),
				),
				
				1 => array(
					'name' => '生活贴士',
					'sub_button' => array(
						0 => array(
							'type' => 'view',
							'name' => 'aaa',
							'url' => $weObj->getOauthRedirect(C('WEB_ROOT').'/home/'),
						),
					),
					
				),
				2 => array(
					'name' => '互动社区',
					'sub_button' => array(
						0 => array(
							'type' => 'view',
							'name' => 'bbb',
							'url' => $weObj->getOauthRedirect(C('WEB_ROOT').'/home/'),
						),					
					),
				),
			),
		);
		$weObj->createMenu($user_menu);
	}

	public function index() {
	import("Org.Wechat");
	$User = D('User');
	$options = array(
    'token'=>'Wesufe', //填写你设定的key
    'appid'=>'wxaf3b1b64467d9eff', //填写高级调用功能的app id, 请在微信开发模式后台查询
    'appsecret'=>'64185c84d002ed51c1b925c5d9654539' //填写高级调用功能的密钥
    );
	$weObj = new \Wechat($options);
	$weObj->valid();
	$openid = $weObj->getRev()->getRevFrom();
	$data['openid'] = $openid;

	$menu = $weObj->getMenu(); //获取菜单操作
		$user_menu = array(
			'button' => array(
				0 => array(
					'name' => '学习帮手',
					'sub_button' => array(
						0 => array(
							'type' => 'click',
							'name' => '个人课表',
							'key'=>'MENU_KEY_course',
						),
						1 => array(
							'type' => 'view',
							'name' => '图书查询',
							'url' => $weObj->getOauthRedirect(C('WEB_ROOT').'/home/learn/library'),
						),
						2 => array(
							'type' => 'click',
							'name' => '成绩查询',
							'key' => 'MENU_KEY_score',
						),
					),
				),
				
				1 => array(
					'name' => '生活贴士',
					'sub_button' => array(
						0 => array(
							'type' => 'view',
							'name' => 'aaa',
							'url' => $weObj->getOauthRedirect(C('WEB_ROOT').'/home/'),
						),
					),
					
				),
				2 => array(
					'name' => '互动社区',
					'sub_button' => array(
						0 => array(
							'type' => 'view',
							'name' => 'bbb',
							'url' => $weObj->getOauthRedirect(C('WEB_ROOT').'/home/'),
						),					
					),
				),
			),
		);
	$weObj->createMenu($user_menu);

	$msg_type = $weObj->getRev()->getRevType();
	switch ($msg_type) {
		case \Wechat::MSGTYPE_TEXT:
			$text = $weObj->getRev()->getRevContent();
			switch ($text) {
			case '绑定':
				$weObj->text("<a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>立即绑定</a>")->reply();
				break;
			case 'openid':
				$openid=$weObj->getRevFrom();
				$weObj->text($openid)->reply();
				break;
			default:
				# code...
				break;
			}
			break;
		case \Wechat::MSGTYPE_EVENT:
			$event = $weObj->getRev()->getRevEvent();
			switch ($event['event']) {
			case \Wechat::EVENT_SUBSCRIBE:
				$weObj->text("欢迎关注wesufe <a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>立即绑定</a>")->reply();
				if($User->create($data))
				{
					$data['subscribe']="1";
					$data['subscribe_time']=date('Y-m-d H:i:s');
					$User->add($data);
				}
				else
				{
					$User->subscribe="1";
					$User->subscribe_time=date('Y-m-d H:i:s');
					$User->where(array('openid'=>$openid))->save();
				}
				break;
			case \Wechat::EVENT_UNSUBSCRIBE:
				$User->subscribe="0";
				$User->unsubscribe_time=date('Y-m-d H:i:s');
				$User->where(array('openid'=>$openid))->save();
				break;
			case \Wechat::EVENT_MENU_CLICK:
				if ($event['key']=='MENU_KEY_course') {
					$accessToken_time = $User->where(array('openid'=>$openid))->getField('accessToken_time');
					if((time()-$accessToken_time)/86400>80)
						$weObj->text("您的授权已过期，请点击 <a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>再次绑定</a>")->reply();
					else{
					$info = array(
						   	"0" =>array(
						   		'Title'=>'个人课表',
						   		'Description'=>'summary text',
						   		'PicUrl'=>'http://img.25pp.com/uploadfile/soft/images/2014/0925/20140925021815283.jpg',
						   		'Url'=> C('WEB_ROOT').'/home/learn/course?openid='.$openid,
						   	),
						);
					$weObj->news($info)->reply();
				}
				}
				if ($event['key']=='MENU_KEY_score') {
					$accessToken_time = $User->where(array('openid'=>$openid))->getField('accessToken_time');
					if((time()-$accessToken_time)/86400>80)
						$weObj->text("您的授权已过期，请点击 <a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>再次绑定</a>")->reply();
					else{
					$info = array(
						   	"0" =>array(
						   		'Title'=>'成绩查询',
						   		'Description'=>'summary text',
						   		'PicUrl'=>'http://atth.jzb.com/forum/201502/12/175042imee0ks08ezcgs1z.png',
						   		'Url'=> C('WEB_ROOT').'/home/learn/score?openid='.$openid,
						   	),
						);
					$weObj->news($info)->reply();
				}
				}
				break;
			default:
				# code...
				break;
			}
			break;
		default:
			$weObj->text("thanks")->reply();
		}
	}

}