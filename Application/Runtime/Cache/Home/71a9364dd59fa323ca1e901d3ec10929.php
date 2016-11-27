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
    
    <div class="scorepage">
        <div class="toppanel">
            <select name="sources" id="sources" class="custom-select sources" placeholder="2015-2016学年 第2学期">
                <?php if(is_array($summary)): $i = 0; $__LIST__ = $summary;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$summary1): $mod = ($i % 2 );++$i;?><option value='<?php echo ($summary1[year]); ?>-<?php echo ($summary1[term]); ?>' class="semester"></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <select name="sort" id="sort" class="custom-select sources" placeholder="按成绩排序">
                <option value="credit" class="sorttype">按学分排序</option>
                <option value="score" class="sorttype">按成绩排序</option>
            </select>
        </div>
        <div class="gpasummary" style="display:none;">
            <?php if(is_array($summary)): $i = 0; $__LIST__ = $summary;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$summary2): $mod = ($i % 2 );++$i;?><div class="summaryitem">
                    <p class="year"><?php echo ($summary2[year]); ?></p>
                    <p class="term"><?php echo ($summary2[term]); ?></p>
                    <p><?php echo ($summary2[country]); ?></p>
                    <p><?php echo ($summary2[average]); ?></p>
                    <p class="credit"><?php echo ($summary2[credits]); ?></p>
                    <p class="gpa"><?php echo ($summary2[gpa]); ?></p>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            
        </div>
        <div class="panel">
            <div class="panel-bd-box-top">
                        <h4 class="subject">课程名</h4>
                        <p class="type">类型</p>
                        <p class="credit">学分</p>
                        <p class="score">成绩</p>
                        <p class="gpa">绩点</p>
                </div>
            <div class="panel-bd">
                <?php if(is_array($detail)): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel-bd-box">
                        <div class="box-seme" style="display:none;"><?php echo ($vo[semester]); ?></div>
                            <h4 class="subject"><?php echo ($vo[subject]); ?></h4>
                            <p class="type"><?php echo ($vo[type]); ?></p>
                            <p class="credit"><?php echo ($vo[credit]); ?></p>
                            <p class="score"><?php echo ($vo[score]); ?></p>
                            <p class="gpa"><?php echo ($vo[gpa]); ?></p>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            
        </div>
        <div class="panel-line">
                绩点走势
            </div>
        <div class="wrapper">
          <canvas id="canvas" width="350" height="200" class="chart"></canvas>
        </div>
        <div class="panel-line">
                总学分走势
            </div>
        <div class="wrapper">
          <canvas id="canvas2" width="350" height="200" class="chart"></canvas>
        </div>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    <script type="text/javascript" src="/Public/js/iscroll-probe.js"></script>
    
<script src="//cdn.bootcss.com/Chart.js/0.2.0/Chart.min.js"></script>

    <script>
    var summary = $('.gpasummary');

    var length = summary.children().length;
    var a = ['大一上','大一下','大二上','大二下','大三上','大三下','大四上','大四下'];

    var datagpa = new Array([length]);
    for(var i=0;i<length;i++)
    {
        var gpa = $(".summaryitem:eq(" + i + ")").find('.gpa').text();
        datagpa[i]=String(gpa);
    }

    var myData = {
                labels: a.slice(0,length),
                datasets: [
                    {
                        fillColor: 'rgba(203,133,137,.5)',
                        strokeColor: 'rgba(203,133,137,1)',
                        pointColor: 'rgba(203,133,137,1)',
                        pointStrokeColor: '#fff',
                        data: datagpa,
                    }
                ]
            };
            new Chart(document.getElementById('canvas').getContext('2d')).Line(myData);

    var datacredit = [];
    var sum=0;
    for(var i=0;i<length;i++)
    {
        var credit = $(".summaryitem:eq(" + i + ")").find('.credit').text();
        sum=parseFloat(sum)+parseFloat(credit);
        datacredit[i]=sum;
    }
    var myData = {
                labels: a.slice(0,length),
                datasets: [
                    {
                        fillColor: 'rgba(111,168,220,.5)',
                        strokeColor: 'rgba(111,168,220,1)',
                        pointColor: 'rgba(111,168,220,1)',
                        pointStrokeColor: '#fff',
                        data: datacredit,
                    }
                ]
            };
            new Chart(document.getElementById('canvas2').getContext('2d')).Line(myData);
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        Insertsort("score");
        $('.panel-bd-box').each(function(){
            $(this).show();
            if($(this).find('.box-seme').text()!="2015-2016-2")
                $(this).hide();
          });        
        $("#sources").each(function() {
          var classes = $(this).attr("class"),
              id      = $(this).attr("id"),
              name    = $(this).attr("name");
          var template =  '<div class="' + classes + '">';
              template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
              template += '<div class="custom-options">';
              $(this).find("option").each(function() { 
                var value = $(this).attr("value"); 
                if(String(value).length>11)
                {     var html= String(value).substr(0,9)+"学年 "+String(value).substr(10) ;     
                }
                else var html = String(value).substr(0,9)+"学年 第"+String(value).substr(10)+"学期";
                template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + html + '</span>';
              });
          template += '</div></div>';

          $(this).wrap('<div class="custom-select-wrapper"></div>');
          $(this).hide();
          $(this).after(template);
        });
        $("#sort").each(function() {
          var classes = $(this).attr("class"),
              id      = $(this).attr("id"),
              name    = $(this).attr("name");
          var template =  '<div class="' + classes + '">';
              template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
              template += '<div class="custom-options">';
              $(this).find("option").each(function() {
                template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
              });
          template += '</div></div>';
          
          $(this).wrap('<div class="custom-select-wrapper"></div>');
          $(this).hide();
          $(this).after(template);
        });
        $(".custom-option:first-of-type").hover(function() {
          $(this).parents(".custom-options").addClass("option-hover");
        }, function() {
          $(this).parents(".custom-options").removeClass("option-hover");
        });
        $(".custom-select-trigger").on("click", function() {
          $('html').one('click',function() {
            $(".custom-select").removeClass("opened");
          });
          $(this).parents(".custom-select").toggleClass("opened");
          event.stopPropagation();
        });
        $(".semester").on("click", function() {
          $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
          $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
          $(this).addClass("selection");
          $(this).parents(".custom-select").removeClass("opened");
          $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());

          $('.panel-bd-box').each(function(){
            $(this).show();
            if($(this).find('.box-seme').text()!=$('.selection').attr("data-value"))
                $(this).hide();
          });
        });
        $(".sorttype").on("click", function() {
          $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
          $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
          $(this).addClass("selection");
          $(this).parents(".custom-select").removeClass("opened");
          $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
          Insertsort($(this).attr("data-value"));

        });

        function Insertsort($type){
            var arr_a = new Array();
            var i=0;
            var length = $('.panel-bd').children().length;
            for(i;i<length;i++){
                arr_a[i]=$(".panel-bd-box:eq(" + i + ")").clone();
            }
            i=0;
            for(i=1;i<length;i++){

                var j=i-1;
                var key=arr_a[i];
                while (j>=0 && parseFloat(arr_a[j].find('.'+$type).text())<parseFloat(key.find('.'+$type).text()))
                {
                    arr_a[j+1]=arr_a[j];
                    j=j-1;
                }
                arr_a[j+1]=key;
            }

            i=0;
            $('.panel-bd-box').each(function(){
                
                $(this).replaceWith($(arr_a[i]));
                i++;
            });
        }
    
    });
    </script>
 
</body>

</html>