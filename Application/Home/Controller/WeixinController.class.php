<?php
namespace Home\Controller;
use Think\Controller;

class WeixinController extends Controller {

	//改变菜单设置时，需要先访问这个方法才可以生效
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
							'type' => 'click',
							'name' => '考试安排',
							'key' => 'MENU_KEY_exam',
						),
						2 => array(
							'type' => 'click',
							'name' => '成绩查询',
							'key' => 'MENU_KEY_score',
						),
					),
				),
				
				1 => array(
					'name' => '图书查询',
					'type' => 'view',
					'url' => C('WEB_ROOT').'/home/learn/librarysearch',		
				),
				2 => array(
					'name' => '表白墙',
					'type' => 'view',
					'url' => C('WEB_ROOT').'/home/lovewall/lovewallPanel?openid='.$openid,
				),
			),
		);
		$weObj->createMenu($user_menu);
	}

	public function index() {
	import("Org.Wechat");
	$User = D('User');
	$weObj = new \Wechat(C('WEIXIN_OPTIONS'));
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
							'type' => 'click',
							'name' => '考试安排',
							'key' => 'MENU_KEY_exam',
						),
						2 => array(
							'type' => 'click',
							'name' => '成绩查询',
							'key' => 'MENU_KEY_score',
						),
					),
				),
				
				1 => array(
					'name' => '图书查询',
					'type' => 'view',
					'url' => C('WEB_ROOT').'/home/learn/librarysearch',		
				),
				2 => array(
					'name' => '表白墙',
					'type' => 'view',
					'url' => C('WEB_ROOT').'/home/lovewall/lovewallPanel?openid='.$openid,
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
			case \Wechat::EVENT_SUBSCRIBE: //用户关注时发生的事件
				$weObj->text("欢迎关注wesufe <a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>立即绑定</a>")->reply();
				if($User->create($data))
				{
					$data['subscribe']="1";
					$data['subscribe_time']=date('Y-m-d H:i:s');

					$numbers = range (1,40); 
					shuffle ($numbers); 
					//array_slice 取该数组中的某一段，这里的icon引用了阿里巴巴图库
					$result = array_slice($numbers,0,1);
					if($result[0]<10)
						$data['image']="#icon-0".$result[0];
					else $data['image']="#icon-".$result[0];
					$User->add($data);
				}
				else
				{
					$User->subscribe="1";
					$User->subscribe_time=date('Y-m-d H:i:s');
					$numbers = range (1,40); 
					shuffle ($numbers); 
					//array_slice 取该数组中的某一段 
					$result = array_slice($numbers,0,1);
					if($result[0]<10)
						$User->image="#icon-0".$result[0];
					else $User->image="#icon-".$result[0];
					$User->where(array('openid'=>$openid))->save();
				}
				break;
			case \Wechat::EVENT_UNSUBSCRIBE:
				//取关时发生
				$User->subscribe="0";
				$User->unsubscribe_time=date('Y-m-d H:i:s');
				$User->where(array('openid'=>$openid))->save();
				break;
			case \Wechat::EVENT_MENU_CLICK:
				//点击菜单时要判断学校给的accessToken是否过期，大于80天需要重新获取
				Weixincontroller::createUser($data);
				if ($event['key']=='MENU_KEY_course') {
					if($User->where(array('openid'=>$openid))->getField('accessToken')==null)
						$weObj->text("您尚未绑定wesufe，请 <a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>立即绑定</a>")->reply();
					else{
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
				}
				if ($event['key']=='MENU_KEY_score') {
					if($User->where(array('openid'=>$openid))->getField('accessToken')==null)
						$weObj->text("您尚未绑定wesufe，请 <a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>立即绑定</a>")->reply();
					else{
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
				}
				if ($event['key']=='MENU_KEY_exam') {
					if($User->where(array('openid'=>$openid))->getField('accessToken')==null)
						$weObj->text("您尚未绑定wesufe，请 <a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>立即绑定</a>")->reply();
					else{
						$accessToken_time = $User->where(array('openid'=>$openid))->getField('accessToken_time');
						if((time()-$accessToken_time)/86400>80)
							$weObj->text("您的授权已过期，请点击 <a href='".C('WEB_ROOT').'/home/auth/redirect?openid='.$openid."'>再次绑定</a>")->reply();
						else{
						$info = array(
							   	"0" =>array(
							   		'Title'=>'考试安排',
							   		'Description'=>'summary text',
							   		'PicUrl'=>'http://img4.duitang.com/uploads/item/201602/14/20160214113222_M3Lfr.jpeg',
							   		'Url'=> C('WEB_ROOT').'/home/learn/exam?openid='.$openid,
							   	),
							);
						$weObj->news($info)->reply();
						}
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

	public function createUser($data){

		$User = D('User');
		if($User->create($data))
		{
			$data['subscribe']="1";
			$data['subscribe_time']=date('Y-m-d H:i:s');

			$numbers = range (1,40); 
			shuffle ($numbers); 
			//array_slice 取该数组中的某一段，这里的icon引用了阿里巴巴图库
			$result = array_slice($numbers,0,1);
			if($result[0]<10)
				$data['image']="#icon-0".$result[0];
			else $data['image']="#icon-".$result[0];
			$User->add($data);
		}

	}
}
