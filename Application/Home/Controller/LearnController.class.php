<?php
namespace Home\Controller;
use Think\Controller;


class LearnController extends Controller {

	public function course() {

		$User = M('User');
		$openid=$_GET['openid'];
		$condition['openid'] = 'ov7LNwfazjMQ60UKDKr25URwJpzY'; //要替换成openid！！！！

		$stuNo=$User->where($condition)->getField('stuNo');
		$accessToken=$User->where($condition)->getField('accessToken');
		$json = file_get_contents("http://weixin.sufe.edu.cn/api/std/timetable?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		$obj = json_decode($json,true);
		$array = [];
		$timetable=$obj["timetable"];
		$zodiac = array("&#xe60b;","&#xe60a;","&#xe609;","&#xe608;","&#xe607;","&#xe606;","&#xe605;","&#xe604;","&#xe603;","&#xe602;","&#xe601;","&#xe600;");
		for($weekday=0;$weekday<count($timetable);$weekday++)
		{
			$lesson = $timetable[$weekday]["lessons"];
			for($count=0;$count<count($lesson);$count++){
				$image=$zodiac[rand(0,11)];
				$arr = ["weekday"=>$timetable[$weekday]["weekday"],"time"=>$lesson[$count]["time"],"className"=>$lesson[$count]["className"],"place"=>$lesson[$count]["place"],"teacher"=>$lesson[$count]["teacher"],"duration"=>$lesson[$count]["duration"],"isMajor"=>$lesson[$count]["isMajor"],"lessonName"=>$lesson[$count]["lessonName"],"icon"=>$image];
				array_push($array,$arr);
			}
		}
		$orderlist = $array;
		
		for($i=1;$i<count($orderlist);$i++){
			$key = $orderlist[$i];
			$j=$i-1;
			
			while($j>=0 && LearnController::insertSort2($orderlist[$j],$key))
				{	
					$orderlist[$j+1]=$orderlist[$j];
					$j=$j-1;					
				}
			$orderlist[$j+1]=$key;
				
		}

        $this->assign('timetable',$orderlist);
        $this->assign('title','课程表');
		$this->display();
		
	}
	public function insertSort2($datej,$datei){
		$countj=(int)substr($datej["time"],0,2);
		$counti=(int)substr($datei["time"],0,2);
		if($countj>$counti)
			return true;
		if($countj<$counti)
			return false;
	}

	public function librarysearch(){
		$this->assign('title','图书查询');
		$this->display();
	}

	public function library() {
		$book=$_POST['book'];
		$this->assign('keyword',$book);
		$this->assign('title',$book);
		$this->display();		
	}
	public function ajaxGetbook(){
		$book=urlencode($_GET['book']);
	    $page=$_GET['page'];	
		$command1 = escapeshellcmd('python '.dirname(__FILE__).'/search.py --keyword='.$book.' --page='.$page);
		$output1 = shell_exec($command1);
		$result = json_decode($output1, true);
		$this->ajaxReturn($result);
	}

	public function bookitem(){
		$command2 = escapeshellcmd('python '.dirname(__FILE__).'/search.py --bookurl=item.php?marc_no='.$_GET["url"]);
		$output2 = shell_exec($command2);
		header("Content-type: text/html; charset=utf-8");
		$result=json_decode($output2,true);
		$storeinfo=$result['storeinfor'];
		$this->assign('bookname',$_GET["bookname"]);
		$this->assign('author',$_GET["author"]);
		$this->assign('bookinfo',$result);
		$this->assign('storeinfo',$storeinfo);
		$this->display();
	}

	public function score() {
		$User = M('User');
		$openid=$_GET['openid'];
		$condition['openid'] = 'ov7LNwfazjMQ60UKDKr25URwJpzY'; //要替换成openid！！！！
		// 'ov7LNwZrsw_jpkkwhrSq_j2ognxo'
		// 'ov7LNwfazjMQ60UKDKr25URwJpzY'
		$stuNo=$User->where($condition)->getField('stuNo');
		$accessToken=$User->where($condition)->getField('accessToken');
		$jsonGPA = file_get_contents("http://weixin.sufe.edu.cn/api/std/gpasummary?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		$jsonGPAdetail= file_get_contents("http://weixin.sufe.edu.cn/api/std/gpa?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		// ."&semesterId=2015-2016-2"
		$GPA = json_decode($jsonGPA,true);
		$GPAdetail = json_decode($jsonGPAdetail,true);
		// dump($GPA);
		// dump($GPAdetail["gpa"]);
		if($GPA==null){
			header("Content-Type: text/html; charset=utf-8");
			dump("请检查你是否完成评教,地址：上财门户-评教应用");
		}
		else{
			$this->assign('summary',$GPA);
			$this->assign('detail',$GPAdetail["gpa"]);
	        $this->assign('title',"成绩查询");
			$this->display();
		}

	}

	public function exam(){
		$User = M('User');
		$openid=$_GET['openid'];
		$condition['openid'] = 'ov7LNwfazjMQ60UKDKr25URwJpzY'; //要替换成openid！！！！
		// 

		
		$stuNo=$User->where($condition)->getField('stuNo');
		$accessToken=$User->where($condition)->getField('accessToken');
		$json = file_get_contents("http://weixin.sufe.edu.cn/api/std/examArrangement?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		// $json = '{"arrangement":[{"name":"计算机应用","exam_type":"大规模考","examdate":"2016-11-26","examtime":"12:30-14:30","place":"机房6","status":"期末考试","week":"星期二","week_no":"17"},{"name":"运营管理I","exam_type":"提前考","examdate":"2016-12-06","examtime":"13:00-15:00","place":"三教507","status":"期末考试","week":"星期二","week_no":"13"},{"name":"中国近现代史纲要","exam_type":"大规模考","examdate":"2017-01-10","examtime":"14:00-16:00","place":"三教302","status":"期末考试","week":"星期二","week_no":"18"},{"name":"回归分析","exam_type":"提前考","examdate":"2016-12-20","examtime":"13:00-15:00","place":"三教201","status":"期末考试","week":"星期二","week_no":"15"}]}';
		$obj = json_decode($json,true);
		$orderlist = $obj["arrangement"];

		for($i=1;$i<count($orderlist);$i++){
			$key = $orderlist[$i];

			$j=$i-1;
			
			while($j>=0 && LearnController::insertSort($orderlist[$j],$key))
				{	
					$orderlist[$j+1]=$orderlist[$j];
					$j=$j-1;					
				}
			$orderlist[$j+1]=$key;
				
		}
        $this->assign("exam",$orderlist);
        $this->assign("title","考试安排");
		$this->display();
	}
	public function insertSort($datej,$datei){
		$countj=(int)substr($datej["examdate"],3,1)*10000+(int)substr($datej["examdate"],5,2)*100+(int)substr($datej["examdate"],8,2);
		$counti=(int)substr($datei["examdate"],3,1)*10000+(int)substr($datei["examdate"],5,2)*100+(int)substr($datei["examdate"],8,2);
		if($countj>$counti)
			return true;
		if($countj<$counti)
			return false;

		$timej=(int)substr($datej["examtime"],0,2)*100+(int)substr($datej["examtime"],3,2);
		$timei=(int)substr($datei["examtime"],0,2)*100+(int)substr($datei["examtime"],3,2);
		if($timej>$timei)
			return true;
		else return false;

	}
}