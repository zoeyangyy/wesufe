<?php
namespace Home\Controller;
use Think\Controller;


class LearnController extends Controller {

	public function course() {

		$User = M('User');
		$openid=$_GET['openid'];
		$condition['openid'] = $openid; 
		//应该替换成$openid, 这里为了测试看结果，才设置了固定的openid

		$stuNo=$User->where($condition)->getField('stuNo');
		$accessToken=$User->where($condition)->getField('accessToken');
		$json = file_get_contents("http://weixin.sufe.edu.cn/api/std/timetable?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		$obj = json_decode($json,true);
		$array = [];
		$timetable=$obj["timetable"];

		//给每门课随机匹配一个icon，引用自阿里巴巴iconfont
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

	//插入排序，把课程从早到晚排列
	public function insertSort2($datej,$datei){
		$countj=(int)substr($datej["time"],0,2);
		$counti=(int)substr($datei["time"],0,2);
		if($countj>$counti)
			return true;
		if($countj<$counti)
			return false;
	}

	public function score() {
		$User = M('User');
		$openid=$_GET['openid'];
		$condition['openid'] = $openid; 
		//应该替换成$openid, 这里为了测试看结果，才设置了固定的openid
		// 'ov7LNwZrsw_jpkkwhrSq_j2ognxo'
		$stuNo=$User->where($condition)->getField('stuNo');
		$accessToken=$User->where($condition)->getField('accessToken');
		$jsonGPA = file_get_contents("http://weixin.sufe.edu.cn/api/std/gpasummary?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		$jsonGPAdetail= file_get_contents("http://weixin.sufe.edu.cn/api/std/gpa?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);
		// ."&semesterId=2015-2016-2" 加上这个参数可以返回具体某个学习，但没有用到
		// 下面是正确返回时的数据，可用于测试
		// $jsonGPA='[{"year":"2014-2015","term":"1","country":"11","average":"84.44","credits":"21.5","gpa":"3.44"},{"year":"2014-2015","term":"2","country":"12","average":"79.83","credits":"26.5","gpa":"2.97"},{"year":"2015-2016","term":"1","country":"10","average":"84.56","credits":"25.5","gpa":"3.5"},{"year":"2015-2016","term":"2","country":"9","average":"79.9","credits":"23.5","gpa":"2.98"},{"year":"2015-2016","term":"小学期","country":"2","average":"84","credits":"2","gpa":"3.5"},{"year":"2016-2017","term":"小学期","country":"1","average":"85","credits":"1","gpa":"3.7"}]';
		// $jsonGPAdetail='{"gpa":[{"semester":"2015-2016-1","type":"英语模块III","subject":"二十世纪美国女作家","credit":"2","score":"89","gpa":"3.7"},{"semester":"2014-2015-1","type":"通识选修课","subject":"运筹学导论","credit":"1","score":"96","gpa":"4"},{"semester":"2014-2015-2","type":"通识模块四","subject":"线性代数","credit":"3","score":"70","gpa":"2"},{"semester":"2014-2015-1","type":"通识模块六","subject":"计算机编程","credit":"2","score":"80","gpa":"3"},{"semester":"2014-2015-1","type":"通识模块四","subject":"高等数学I（A）","credit":"5","score":"78","gpa":"3"},{"semester":"2014-2015-1","type":"通识模块五","subject":"大学生思想品德修养","credit":"1.5","score":"89","gpa":"3.7"},{"semester":"2014-2015-2","type":"通识模块五","subject":"政治经济学","credit":"2","score":"81","gpa":"3"},{"semester":"2014-2015-1","type":"英语模块I","subject":"英语口语I","credit":"1","score":"87","gpa":"3.7"},{"semester":"2014-2015-1","type":"通识模块五","subject":"形势与政策","credit":"1","score":"85","gpa":"3.7"},{"semester":"2014-2015-1","type":"英语模块I","subject":"大学英语I（B级）（英M1）","credit":"3","score":"89","gpa":"3.7"},{"semester":"2014-2015-1","type":"通识模块五","subject":"毛泽东思想和中国特色社会主义理论体系概论I","credit":"2","score":"84","gpa":"3.3"},{"semester":"2014-2015-1","type":"通识模块一（经典阅读与历史文化传承）选修课","subject":"中外法律文化","credit":"2","score":"86","gpa":"3.7"},{"semester":"2014-2015-1","type":"通识模块三","subject":"体育I","credit":"1","score":"87","gpa":"3.7"},{"semester":"2014-2015-2","type":"通识模块五","subject":"毛泽东思想和中国特色社会主义理论体系概论II","credit":"2","score":"76","gpa":"2.7"},{"semester":"2014-2015-2","type":"通识模块四","subject":"高等数学II（A）","credit":"5","score":"74","gpa":"2.3"},{"semester":"2014-2015-2","type":"英语模块II","subject":"英语口语II","credit":"1","score":"82","gpa":"3.3"},{"semester":"2014-2015-2","type":"英语模块II","subject":"大学英语Ⅱ（B级）英M2","credit":"3","score":"86","gpa":"3.7"},{"semester":"2014-2015-2","type":"通识模块三","subject":"卫生保健","credit":"1","score":"93","gpa":"4"},{"semester":"2014-2015-1","type":"必修课","subject":"计算机编程II","credit":"2","score":"85","gpa":"3.7"},{"semester":"2014-2015-2","type":"必修课","subject":"管理学","credit":"2","score":"87","gpa":"3.7"},{"semester":"2014-2015-2","type":"通识模块三","subject":"体育II","credit":"1","score":"88","gpa":"3.7"},{"semester":"2015-2016-2","type":"必修课","subject":"运筹学（高级）","credit":"3","score":"80","gpa":"3"},{"semester":"2015-2016-2","type":"选修课","subject":"中级微观经济学","credit":"3","score":"71","gpa":"2"},{"semester":"2015-2016-2","type":"必修课","subject":"信息系统分析与设计","credit":"4","score":"80","gpa":"3"},{"semester":"2015-2016-2","type":"通识模块三","subject":"体育IV","credit":".5","score":"84","gpa":"3.3"},{"semester":"2015-2016-1","type":"通识模块四","subject":"概率论","credit":"3","score":"79","gpa":"3"},{"semester":"2015-2016-2","type":"通识选修课","subject":"系统工程方法","credit":"1","score":"95","gpa":"4"},{"semester":"2015-2016-1","type":"通识模块三","subject":"体育III","credit":".5","score":"85","gpa":"3.7"},{"semester":"2015-2016-1","type":"拔尖型","subject":"程序设计实验","credit":"3","score":"72","gpa":"2.3"},{"semester":"2015-2016-2","type":"通识模块四","subject":"数理统计","credit":"3","score":"85","gpa":"3.7"},{"semester":"2015-2016-1","type":"英语模块III","subject":"商务英语谈判与沟通","credit":"2","score":"86","gpa":"3.7"},{"semester":"2016-2017-小学期","type":"任意选修课","subject":"Highlights of Theoretical Computer Science","credit":"1","score":"85","gpa":"3.7"},{"semester":"2015-2016-小学期","type":"任意选修课","subject":"Social Network and Business Intelligence","credit":"1","score":"86","gpa":"3.7"},{"semester":"2014-2015-2","type":"通识模块五","subject":"军事理论","credit":"1","score":"91","gpa":"4"},{"semester":"2014-2015-2","type":"通识模块五","subject":"法律基础","credit":"1.5","score":"85","gpa":"3.7"},{"semester":"2015-2016-1","type":"通识模块六（科技进步与科学精神）选修课","subject":"创新思维与方法","credit":"2","score":"85","gpa":"3.7"},{"semester":"2015-2016-2","type":"专业必修课","subject":"随机过程","credit":"3","score":"79.6","gpa":"3"},{"semester":"2015-2016-2","type":"通识模块二","subject":"哲学","credit":"2","score":"75","gpa":"2.7"},{"semester":"2015-2016-2","type":"必修课","subject":"面向对象的程序设计","credit":"4","score":"81","gpa":"3"},{"semester":"2015-2016-1","type":"必修课","subject":"信息系统导论","credit":"4","score":"90","gpa":"4"},{"semester":"2015-2016-1","type":"必修课","subject":"数据库","credit":"4","score":"88","gpa":"3.7"},{"semester":"2015-2016-1","type":"拔尖型","subject":"线性与非线性规划","credit":"3","score":"85","gpa":"3.7"},{"semester":"2015-2016-1","type":"通识模块六（科技进步与科学精神）选修课","subject":"社会网络与大数据分析","credit":"2","score":"87","gpa":"3.7"},{"semester":"2015-2016-小学期","type":"任意选修课","subject":"Foundations in Operations Management","credit":"1","score":"82","gpa":"3.3"},{"semester":"2014-2015-2","type":"必修课","subject":"数据结构","credit":"4","score":"77","gpa":"2.7"}]}';

		$GPA = json_decode($jsonGPA,true);
		$GPAdetail = json_decode($jsonGPAdetail,true);
		// dump($GPA);//每学期gpa汇总
		// dump($GPAdetail["gpa"]);//具体每门课的成绩
		if($GPA=="" || $GPAdetail==""){
			header("Content-Type: text/html; charset=utf-8");
			$this->assign('title',"查询失败");
			$this->display();
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
		$condition['openid'] = $openid;
		//应该替换成$openid, 这里为了测试看结果，才设置了固定的openid
		
		$stuNo=$User->where($condition)->getField('stuNo');
		$accessToken=$User->where($condition)->getField('accessToken');
		$json = file_get_contents("http://weixin.sufe.edu.cn/api/std/examArrangement?oauth_consumer_key=4f6p8203&clientip=CLIENTIP&oauth_version=2.a&scope=all&access_token=".$accessToken."&openid=".$stuNo);

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

	//插入排序，把考试安排安排日期先后排列，同天再按时间排列
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

	//下拉刷新时，ajax获取更多图书
	public function ajaxGetbook(){
		$book=urlencode($_GET['book']);
	    $page=$_GET['page'];	
		$command1 = escapeshellcmd('python '.dirname(__FILE__).'/search.py --keyword='.$book.' --page='.$page);
		$output1 = shell_exec($command1);
		$result = json_decode($output1, true);
		$this->ajaxReturn($result);
	}

	//返回每本图书具体信息
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
}