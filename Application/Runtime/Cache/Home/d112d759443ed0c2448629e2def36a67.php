<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/css/vendor.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css" />
    
</head>

<body>
    
    <div class="swiper-container swiper-container-horizontal">
        <div class="swiper-background"></div>
        <div class="swiper-frame"></div>
        <div class="swiper-wrapper">
            <div class="swiper-slide swiper-slide-active">
                <p class="swiper-slide-weekday"></p>
                <p class="swiper-slide-date"></p>
            </div>
            <div class="swiper-slide swiper-slide-next">
                <p class="swiper-slide-weekday"></p>
                <p class="swiper-slide-date"></p>
            </div>
            <div class="swiper-slide">
                <p class="swiper-slide-weekday"></p>
                <p class="swiper-slide-date"></p>
            </div>
            <div class="swiper-slide">
                <p class="swiper-slide-weekday"></p>
                <p class="swiper-slide-date"></p>
            </div>
            <div class="swiper-slide">
                <p class="swiper-slide-weekday"></p>
                <p class="swiper-slide-date"></p>
            </div>
            <div class="swiper-slide">
                <p class="swiper-slide-weekday"></p>
                <p class="swiper-slide-date"></p>
            </div>
            <div class="swiper-slide">
                <p class="swiper-slide-weekday"></p>
                <p class="swiper-slide-date"></p>
            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-bd">
            <?php if(is_array($timetable)): $i = 0; $__LIST__ = $timetable;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel-bd-box">
                	<div class="hidden" style="display:none;"><?php echo ($vo[weekday]); ?></div>
                    <div class="panel-bd-box-time">
                        <p class="start-time"><?php echo ($vo[lessons][0][time]); ?></p>
                        <p class="end-time"><?php echo ($vo[lessons][0][time]); ?></p>
                    </div>
                    <div class="panel-bd-box-icon"><i class="iconfont">&#x3442;</i></div>
                    <div class="panel-bd-box-course">
                        <h4 class="course-title"><?php echo ($vo[lessons][0][lessonName]); ?></h4>
                        <p><?php echo ($vo[lessons][0][teacher]); ?> &nbsp;&nbsp;&nbsp; <?php echo ($vo[lessons][0][duration]); ?></p>
                    </div>
                    <div class="panel-bd-box-place">
                    	<div class="hidden2" style="display:none;"><?php echo ($vo[lessons][0][isMajor]); ?></div>
                        <div class="ismajor">专业课</div>
                        <p><?php echo ($vo[lessons][0][place]); ?></p>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="panel-line">
            今天没有课啦！
        </div>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    

    <script type="text/javascript">
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 0.1,
        centeredSlides: true,
        slideToClickedSlide: true,
        onSlideChangeEnd: function(swiper) {
            $('.panel-bd-box').each(function(){           		
				if($('.swiper-slide-active p:eq(0)').attr("value")!=$(this).find('.hidden').text())
        			$(this).hide();
        		else $(this).show();        
            })
        }
    });

    $(document).ready(function() {

        //设置日期
        var mydate = new Date();
        var today = new Array('周日', '周一', '周二', '周三', '周四', '周五', '周六');
        for (var i = 0; i < 7; i++) {
            $(".swiper-slide-weekday:eq(" + i + ")").text(today[(mydate.getDay() + i) % 7]);
            $(".swiper-slide-weekday:eq(" + i + ")").attr("value", (mydate.getDay() + i) % 7);
            var newdate = new Date(mydate.getTime() + 24 * 3600 * 1000 * i);
            var month=parseInt(newdate.getMonth())+1;
            $(".swiper-slide-date:eq(" + i + ")").text(month+'.'+newdate.getDate());
        }
        //加载课程
        $('.panel-bd-box').each(function(){
			if($('.swiper-slide-active p:eq(0)').attr("value")!=$(this).find('.hidden').text())
        		$(this).hide();
        	else $(this).show(); 

        	if($(this).find('.hidden2').text()==1)
        		$(this).find('.ismajor').show();
        	else $(this).find('.ismajor').hide(); 

        	$(this).find('.start-time').text($(this).find('.start-time').text().substr(0,5));
        	$(this).find('.end-time').text($(this).find('.end-time').text().substr(6,5));       
        })

        //判断已完成课程和当前课程
        // if ($('.swiper-slide-active p:eq(1)').text().substr(3) == mydate.getDate()) {
            $('.panel-bd-box').each(function() {
                var starttime = $(this).find('.start-time').text();
                var endtime = $(this).find('.end-time').text();
                var minutes_start = parseInt(starttime.substr(0, 2), 10) * 60 + parseInt(starttime.substr(3, 2), 10);
                var minutes_end = parseInt(endtime.substr(0, 2), 10) * 60 + parseInt(endtime.substr(3, 2), 10);
                var minutes_now = mydate.getHours() * 60 + mydate.getMinutes();
                if($(this).find('.hidden').text()==mydate.getDay())
                {
	                if (minutes_end < minutes_now)
	                    $(this).addClass("panel-bd-box-done");
	                if (minutes_now > minutes_start & minutes_now < minutes_end)
	                    $(this).addClass("panel-bd-box-on");
            	}
            })
        // }
    });
    </script>
 
</body>

</html>