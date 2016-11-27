<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,maximum-scale=1,initial-scale=1,user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/css/vendor.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css" />
    
</head>

<body>
    
    <div class="exam">
        <div class="toppanel">
            <a class="toppanel-box toppanel-box-on" id="LargeScale" href="javascript:void(0)">大规模考</a>
            <a class="toppanel-box" id="Advance" href="javascript:void(0)">提前考</a>
        </div>
        <div class="panel">
            <div class="panel-bd">
                <?php if(is_array($exam)): $i = 0; $__LIST__ = $exam;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel-bd-box" style="display: none;">
                        <div style="display: none;" class="examtype"><?php echo ($vo[exam_type]); ?></div>
                        <div class="panel-bd-box-time">
                            <p class="date"><?php echo ($vo[examdate]); ?></p>
                            <p class="time"><?php echo ($vo[examtime]); ?></p>
                        </div>
                        <div class="panel-bd-box-course">
                            <h4 class="course-title"><?php echo ($vo[name]); ?></h4>
                            <p>第<?php echo ($vo[week_no]); ?>周 &nbsp;&nbsp;&nbsp; <?php echo ($vo[week]); ?></p>
                        </div>
                        <div class="panel-bd-box-place">
                            <div class="today" style="display: none;">今天</div>
                            <p><?php echo ($vo[place]); ?></p>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="panel-line">
                没有更多了
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    <script type="text/javascript" src="/Public/js/iscroll-probe.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {

        // var mydate = new Date();
        // var today = new Array('周日', '周一', '周二', '周三', '周四', '周五', '周六');
        // //判断已完成课程和当前课程
        // $('.panel-bd-box').each(function() {
        //     var starttime = $(this).find('.start-time').text();
        //     var endtime = $(this).find('.end-time').text();
        //     var minutes_start = parseInt(starttime.substr(0, 2), 10) * 60 + parseInt(starttime.substr(3, 2), 10);
        //     var minutes_end = parseInt(endtime.substr(0, 2), 10) * 60 + parseInt(endtime.substr(3, 2), 10);
        //     var minutes_now = mydate.getHours() * 60 + mydate.getMinutes();
        //     if ($(this).find('.hidden').text() == mydate.getDay()) {
        //         if (minutes_end < minutes_now)
        //             $(this).addClass("panel-bd-box-done");
        //         if (minutes_now > minutes_start & minutes_now < minutes_end)
        //             $(this).addClass("panel-bd-box-on");
        //     }
        // });

        changetype();
        $('#LargeScale').click(function() {
            $(this).addClass("toppanel-box-on");
            $('#Advance').removeClass("toppanel-box-on");
            changetype();
        });
        $('#Advance').click(function() {
            $(this).addClass("toppanel-box-on");
            $('#LargeScale').removeClass("toppanel-box-on");
            changetype();
        });

        function changetype() {
            $('.panel-bd-box').each(function() {
                if ($(this).find('.examtype').text() == $('.toppanel-box-on').text())
                    $(this).show();
                else $(this).hide();
            });
        }

        var mydate = new Date();
        console.log("mydate"+mydate);

        $('.panel-bd-box').each(function() {
            var date = $(this).find('.date').text();
            var standarddate = new Date(date.replace("-", "/").replace("-", "/")); 
            console.log(standarddate);
            if(standarddate<mydate)
                $(this).addClass("panel-bd-box-done");
            if(standarddate.getDay()==mydate.getDay() && standarddate.getMonth()==mydate.getMonth() && standarddate.getYear()==mydate.getYear())
                {
                    $(this).removeClass("panel-bd-box-done");
                    $(this).addClass("panel-bd-box-on");
                    $(this).find('.today').show();
                }

        });

    });
    </script>
 
</body>

</html>