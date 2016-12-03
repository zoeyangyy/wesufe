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
    
    <div class="lovewallPaneltry">
        <div class="iphone">
            <div class="iphone__upper">
                <a class="toppanel-box toppanel-box-on" id="sortTime" href="javascript:void(0)">默认排序</a>
                <a class="toppanel-box" id="sortLike" href="javascript:void(0)">热度最高</a>
            </div>
            <div class="outermainview">
                <div class="mainview">
                </div>
            </div>
        </div>
        <div class="bottompanel">
            <div></div>
            <div class="bar"></div>
            <svg class="iconpost" aria-hidden="true">
                <use xlink:href="#icon-aixin"></use>
            </svg>
            <div class="bar2"></div>
            <svg class="iconbacktop" aria-hidden="true">
                <use xlink:href="#icon-back2top"></use>
            </svg>
            <a href="#" id="returnTop" class="totop"></a>
        </div>
        <div class="mask">
        <form class="bomb-box" action="/home/lovewall/post" method="post">
            <div class="box-gender">
                <input name="gender" style="display:none;" id="hidden" value="0">
                <div class="male">
                    <svg class="icongender" aria-hidden="true">
                        <use xlink:href="#icon-nansheng"></use>
                    </svg>
                    <div>我是男生</div>
                </div>
                <div class="female gender-off">
                    <svg class="icongender" aria-hidden="true">
                        <use xlink:href="#icon-nvsheng"></use>
                    </svg>
                    <div>我是女生</div>
                </div>
            </div>
            <div class="box-message">

                <div class="message-towhom">
                    FROM:&nbsp;
                    <input type="text" id="input-sender" name="sender" placeholder="某某">
                    <div class="anonymous">我要匿名</div>
                </div>
                <div class="message-towhom">
                    TO:&nbsp;
                    <input type="text" id="input-receiver" name="receiver" placeholder="某某">
                </div>
                <div class="message-text">
                    <textarea class="weui-textarea" placeholder="想说却还没说的" rows="3" name="text"></textarea>
                    <div class="weui-textarea-counter"><span id="enterchar">0</span>/200</div>
                </div>
            </div>
            <div class="box-send">
                <button type="submit" id="submit">发 &nbsp;&nbsp; 送</button>
            </div>
        </form>
        <div class="cancel">
            <svg class="iconcancel" aria-hidden="true">
                <use xlink:href="#icon-close"></use>
            </svg>
        </div>
        </div>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    
    <script type="text/javascript" src="//at.alicdn.com/t/font_fxyfioupbtaf9a4i.js"></script>
    <script src="//cdn.bootcss.com/velocity/1.2.3/velocity.min.js"></script>
    <script type="text/javascript" src="/Public/js/dropload.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.weui-textarea').on('keyup', function(event) {
            var len = $(this).val().length;
            if (len >= 200) {
                $(this).val($(this).val().substring(0, 200));
            } else {
                $('#enterchar').text(len);
            }
        });

        var num = 0;
        var type = "time";        
        var sessionstorage = window.sessionStorage;
        

            if(sessionstorage.getItem("height")){
                    type=sessionstorage.getItem("type");
                    if(type=="like") {
                        $('#sortLike').addClass("toppanel-box-on");
                        $('#sortTime').removeClass("toppanel-box-on");
                    }
                    getpost();            
            }else{
                sessionstorage.setItem("height",0);
            }

        sessionstorage.setItem("type",type);
        $(window).scroll(function() {
            sessionstorage.setItem("height",$(window).scrollTop());

        });

        
        var mainviewlength_before=0;
        var mainviewlength_after=0;

        getpost();


        $('#sortTime').click(function() {
            $(this).addClass("toppanel-box-on");
            $('#sortLike').removeClass("toppanel-box-on");
            $('.mainview').html("");
            num = 0;            
            type = "time";
            sessionstorage.setItem("type",type);
            sessionstorage.setItem("height",0);
            num = getpost();

        });
        $('#sortLike').click(function() {
            $(this).addClass("toppanel-box-on");
            $('#sortTime').removeClass("toppanel-box-on");
            $('.mainview').html("");
            num = 0;            
            type = "like";
            sessionstorage.setItem("type",type);
            sessionstorage.setItem("height",0);
            num = getpost();

        });

         $("#submit").click(function(check){  
            if($('#input-sender').val()=="")
                {alert("写上你的名字或者选择匿名发送~");$("#input-sender").focus();  
                    check.preventDefault();}
            else if($("#input-receiver").val()=="")
                {alert("你希望谁看到呢？~");$("#input-receiver").focus();  
                    check.preventDefault();}
            else if($(".weui-textarea").val()=="")
                {alert("写上一些话吧~");$(".weui-textarea").focus();  
                    check.preventDefault();}
            else {alert("提交成功");}
        });  


        $('.mainview').on('click', '.dialog-bottompanel-like', function(event) {
            if ($(event.target).find("use").attr("xlink:href") == "#icon-like") {
                $(event.target).find("span").text(parseInt($(event.target).find("span").text()) + 1);
                $(event.target).find("use").attr("xlink:href", "#icon-dianzan");
                var postid = $(event.target).find('.hidden-postid').text();
                if (window.localStorage) {
                    var localstorage = window.localStorage;

                    var data = JSON.parse(localstorage.getItem("liked-posts")) || [];
                    data.push(postid);
                    var stringdata = JSON.stringify(data);
                    localstorage.setItem("liked-posts", stringdata);

                }
                $.post("/home/lovewall/ajaxLike", {
                    postid: postid,
                    type: "1"
                }, function(data) {});

            } else if ($(event.target).find("use").attr("xlink:href") == "#icon-dianzan") {
                $(event.target).find("span").text(parseInt($(event.target).find("span").text()) - 1);
                $(event.target).find("use").attr("xlink:href", "#icon-like");
                var postid = $(event.target).find('.hidden-postid').text();
                if (window.localStorage) {
                    var localstorage = window.localStorage;

                    var data = JSON.parse(localstorage.getItem("liked-posts")) || [];
                    for (var i = 0; i < data.length; i++) {
                        if (data[i] == postid)
                            data.splice(i, 1);
                    }

                    var stringdata = JSON.stringify(data);
                    localstorage.setItem("liked-posts", stringdata);
                }
                $.post("/home/lovewall/ajaxLike", {
                    postid: postid,
                    type: "0"
                }, function(data) {});
            }

        });
        var flag=1;
        $('.iconpost').click(function() {
            $('body').css("overflow","hidden");
            var srollPos = $(window).scrollTop();
            $('.mask').css("top",srollPos);
            $('.mask').fadeToggle(500);
            $('.bomb-box').fadeToggle(500);
            $('.cancel').fadeToggle(500);
            flag=0;

        });

        $('.cancel').click(function() {
            $('.mask').fadeToggle(500);
            $('.bomb-box').fadeToggle(500);
            $('.cancel').fadeToggle(500);
            $('body').css("overflow","");
            flag=1;
        });

        $('.weui-textarea').blur(function(){
            var srollPos = $(window).scrollTop();
            $('.mask').css("top",srollPos);
        });

        $('#input-receiver').blur(function(){
            var srollPos = $(window).scrollTop();
            $('.mask').css("top",srollPos);
        });

        $('#input-sender').blur(function(){
            var srollPos = $(window).scrollTop();
            $('.mask').css("top",srollPos);
        });

        document.addEventListener("touchmove", function(e) {
          if (flag == 0) {
              e.preventDefault();
              e.stopPropagation();
           }
        }, false);

        $("#returnTop").click(function() {
            var speed = 200; //滑动的速度
            $('body,html').animate({
                scrollTop: 0
            }, speed);
            return false;
        });

        $('.female').click(function() {
            $('.male').addClass("gender-off");
            $(this).removeClass("gender-off");
            $('.box-message').addClass("box-message-right");
            $('.box-send').addClass("box-send-right");
            $('#hidden').attr("value", "1");
        });
        $('.male').click(function() {
            $('.female').addClass("gender-off");
            $(this).removeClass("gender-off");
            $('.box-message').removeClass("box-message-right");
            $('.box-send').removeClass("box-send-right");
            $('#hidden').attr("value", "0");
        });

        $('.anonymous').click(function() {
            if ($(this).hasClass("anonymous-on")) {
                $(this).removeClass("anonymous-on");
                $(this).siblings("input").attr("value", "");
                $(this).siblings("input").show(200);
            } else {
                $(this).addClass("anonymous-on");
                $(this).siblings("input").hide(200);
                $(this).siblings("input").attr("value", "匿名");
            }
        });
            // dropload
    $('.outermainview').dropload({
        scrollArea : window,
        domUp : {
            domClass   : 'dropload-up',
            domRefresh : '<div class="dropload-refresh" id="dropload-up">↓下拉刷新</div>',
            domUpdate  : '<div class="dropload-update">↑释放更新</div>',
            domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>'
        },
        domDown : {
            domClass   : 'dropload-down',
            domRefresh : '<div class="dropload-refresh" id="dropload-down">↑上拉加载更多</div>',
            domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
            domNoData  : '<div class="dropload-noData">暂无数据</div>'
        },
        loadUpFn : function(me){
            $('.mainview').html("");
            console.log("执行up了"+num);
            num = 0;
            $('#dropload-down').hide();
            $.ajax({
                url: '/home/lovewall/ajaxGetpost',
                data: {
                    page: num,
                    type: type
                },
                success: function(data) {
                    var arr = [];
                    $.each(data, function(i, e) {
                        if (e.gender == 1) {
                            arr.push('<div class="mainview-box mainview-box-reverse">')
                        } else arr.push('<div class="mainview-box">')

                        arr.push(
                            '<div style="display:none;" class="hidden-gender">' + e.gender + '</div>' +
                            '<div class="mainview-box-dialog">' +
                            '<div class="dialog-toppanel">' +
                            '<svg class="icon" aria-hidden="true">' +
                            '<use xlink:href=' + e.image + '></use>' +
                            '</svg>' +
                            '<div class="fromwho">' + e.sender + '</div>' +
                            '<div class="towhom">To ' + e.receiver + '</div>' +
                            '<div class="time">' + e.sendtime + '</div>' +
                            '</div>' +
                            '<div class="text"><a href="lovewallDetail?postid=' + e.postid +'">' + e.text + '</a></div>' +
                            '<div class="dialog-bottompanel">' +
                            '<div class="dialog-bottompanel-like">' +
                            '<div style="display:none;" class="hidden-postid">' + e.postid + '</div>' +
                            '<svg class="iconlike" aria-hidden="true">' +
                            '<use xlink:href="#icon-like"></use>' +
                            '</svg>' +
                            '<span class="count">' + e.like_number + '</span>' +
                            '</div>' +
                            '<a class="dialog-bottompanel-comment" href="lovewallDetail?postid=' + e.postid +'">' +
                            '<svg class="iconcomment" aria-hidden="true">' +
                            '<use xlink:href="#icon-pinglun1"></use>' +
                            '</svg>' +
                            '<span class="count">' + e.comment_number + '</span>' +
                            '</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>')
                    });
                    var html = arr.join('');
                    $('.mainview').append(html);
                    $('#dropload-down').show();
                    num += 1;
                    
                    me.resetload();
                },
                error: function(){
                    alert("加载数据出错");
                    me.resetload();
                },
                complete: function() {
                    $('.dialog-bottompanel-like').each(function() {
                        console.log("jiazaidianzan");
                        var localstorage = window.localStorage;
                        var data = JSON.parse(localstorage.getItem("liked-posts")) || [];
                        for (var i = 0; i < data.length; i++) {
                            if (data[i] == $(this).find('.hidden-postid').text())
                                $(this).find("use").attr("xlink:href", "#icon-dianzan");
                        }
                    });

                }

            });



        },
        loadDownFn : function(me){
            console.log("执行down了"+num);
            $.ajax({
                url: '/home/lovewall/ajaxGetpost',
                data: {
                    page: num,
                    type: type
                },
                success: function(data) {
                    var arr = [];
                    $.each(data, function(i, e) {
                        if (e.gender == 1) {
                            arr.push('<div class="mainview-box mainview-box-reverse">')
                        } else arr.push('<div class="mainview-box">')

                        arr.push(
                            '<div style="display:none;" class="hidden-gender">' + e.gender + '</div>' +
                            '<div class="mainview-box-dialog">' +
                            '<div class="dialog-toppanel">' +
                            '<svg class="icon" aria-hidden="true">' +
                            '<use xlink:href=' + e.image + '></use>' +
                            '</svg>' +
                            '<div class="fromwho">' + e.sender + '</div>' +
                            '<div class="towhom">To ' + e.receiver + '</div>' +
                            '<div class="time">' + e.sendtime + '</div>' +
                            '</div>' +
                            '<div class="text"><a href="lovewallDetail?postid=' + e.postid +'">' + e.text + '</a></div>' +
                            '<div class="dialog-bottompanel">' +
                            '<div class="dialog-bottompanel-like">' +
                            '<div style="display:none;" class="hidden-postid">' + e.postid + '</div>' +
                            '<svg class="iconlike" aria-hidden="true">' +
                            '<use xlink:href="#icon-like"></use>' +
                            '</svg>' +
                            '<span class="count">' + e.like_number + '</span>' +
                            '</div>' +
                            '<a class="dialog-bottompanel-comment" href="lovewallDetail?postid=' + e.postid +'">' +
                            '<svg class="iconcomment" aria-hidden="true">' +
                            '<use xlink:href="#icon-pinglun1"></use>' +
                            '</svg>' +
                            '<span class="count">' + e.comment_number + '</span>' +
                            '</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>')
                    });
                    var html = arr.join('');
                    $('.mainview').append(html);
                    num += 1;
                    
                    me.resetload();
                },
                error: function(){
                    alert("加载数据出错");
                    me.resetload();
                },
                complete: function() {
                    $('.dialog-bottompanel-like').each(function() {
                        console.log("jiazaidianzan");
                        var localstorage = window.localStorage;
                        var data = JSON.parse(localstorage.getItem("liked-posts")) || [];
                        for (var i = 0; i < data.length; i++) {
                            if (data[i] == $(this).find('.hidden-postid').text())
                                $(this).find("use").attr("xlink:href", "#icon-dianzan");
                        }
                    });
                    console.log($(document).height());
                    mainviewlength_after=$('.mainview').children().length;
                    if(mainviewlength_after==mainviewlength_before){
                        $('#dropload-down').text("没有更多啦");
                    }else{
                        $('#dropload-down').text("↑上拉加载更多");
                        }

                }

            });
            mainviewlength_before=$('.mainview').children().length;


        },
        threshold : 200,
        autoLoad: false
    });

        function getpost() {
            $('#dropload-down').hide();
            console.log("执行首次"+num);
            $.ajax({
                url: '/home/lovewall/ajaxGetpost',
                data: {
                    page: num,
                    type: type
                },
                async: false,
                success: function(data) {
                    var arr = [];
                    $.each(data, function(i, e) {
                        if (e.gender == 1) {
                            arr.push('<div class="mainview-box mainview-box-reverse">')
                        } else arr.push('<div class="mainview-box">')

                        arr.push(
                            '<div style="display:none;" class="hidden-gender">' + e.gender + '</div>' +
                            '<div class="mainview-box-dialog">' +
                            '<div class="dialog-toppanel">' +
                            '<svg class="icon" aria-hidden="true">' +
                            '<use xlink:href=' + e.image + '></use>' +
                            '</svg>' +
                            '<div class="fromwho">' + e.sender + '</div>' +
                            '<div class="towhom">To ' + e.receiver + '</div>' +
                            '<div class="time">' + e.sendtime + '</div>' +
                            '</div>' +
                            '<div class="text"><a href="lovewallDetail?postid=' + e.postid +'">' + e.text + '</a></div>' +
                            '<div class="dialog-bottompanel">' +
                            '<div class="dialog-bottompanel-like">' +
                            '<div style="display:none;" class="hidden-postid">' + e.postid + '</div>' +
                            '<svg class="iconlike" aria-hidden="true">' +
                            '<use xlink:href="#icon-like"></use>' +
                            '</svg>' +
                            '<span class="count">' + e.like_number + '</span>' +
                            '</div>' +
                            '<a class="dialog-bottompanel-comment" href="lovewallDetail?postid=' + e.postid +'">' +
                            '<svg class="iconcomment" aria-hidden="true">' +
                            '<use xlink:href="#icon-pinglun1"></use>' +
                            '</svg>' +
                            '<span class="count">' + e.comment_number + '</span>' +
                            '</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>')
                    });
                    var html = arr.join('');
                    $('.mainview').append(html);
                    num += 1;
                    $('#dropload-down').show();
                },
                complete: function() {                
                    $('.dialog-bottompanel-like').each(function() {
                        var localstorage = window.localStorage;
                        var data = JSON.parse(localstorage.getItem("liked-posts")) || [];
                        for (var i = 0; i < data.length; i++) {
                            if (data[i] == $(this).find('.hidden-postid').text())
                                $(this).find("use").attr("xlink:href", "#icon-dianzan");
                        }
                    });
                    console.log("这里够吗"+$(document).height());
                    $('body').scrollTop(sessionstorage.getItem("height"));
                    if($(document).height()<sessionstorage.getItem("height"))
                        getpost();
                }

            });
        }

    });
    </script>
    <script>

</script>
 
</body>

</html>