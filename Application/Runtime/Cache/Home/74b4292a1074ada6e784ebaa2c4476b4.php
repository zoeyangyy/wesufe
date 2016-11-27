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
        <div class="list__wrapper">
            <!-- SVG -->
            <div class="svg__wrapper">
                <svg width="100%" height="180" viewBox="0 0 320 180" xmlns="http://www.w3.org/2000/svg" version="1.1">
                    <defs>
                        <filter id="goo">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                            <feBlend in="SourceGraphic" in2="goo" />
                        </filter>
                        <filter id="fgoo">
                            <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                            <feComposite in="SourceGraphic" in2="goo" operator="atop" />
                        </filter>
                    </defs>
                    <g id="gooey-group">
                        <path id="curve" d="M0 90 Q 161 90 322 90" fill="#CB8589"></path>
                    </g>
                    <g id="circle_group">
                        <circle id="circle" cx="160" cy="190" r="20" fill="rgba(255,255,255,0)"></circle>
                    </g>
                    <!-- <path id="bottom-line" d="M0,120 L320,120 L320,90 L0,90" fill="white" stroke="white"></path> -->
                </svg>
                <svg width="90" height="90" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" version="1.1">
                    <path id="progress" d="M45,100a55,55 0 1,0 110,0a55,55 0 1,0 -110,0" fill="transparent" stroke="white" stroke-width="8"></path>
                </svg>
            </div>
            <div class="mainview">
                
            </div>
            <div class="loadmore">正在加载中…</div>
        </div>
    </div>
    <div class="bottompanel">
        <div class="bar"></div>
        <svg class="iconpost" aria-hidden="true">
            <use xlink:href="#icon-aixin"></use>
        </svg>
        <div class="bar2"></div>
        <svg class="iconbacktop" aria-hidden="true">
            <use xlink:href="#icon-back2top"></use>
        </svg>
        <a href="#" onclick="gotoTop();return false;" class="totop"></a>
    </div>
    <div class="mask"></div>
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
            <input name="openid" id="openid" style="display:none;" value="<?php echo ($openid); ?>">
            <div class="message-towhom">
                FROM:&nbsp;
                <input type="text" name="sender" placeholder="某某">
                <div class="anonymous">匿名</div>
            </div>
            <div class="message-towhom">
                TO:&nbsp;
                <input type="text" name="receiver" placeholder="某某">
            </div>
            <div class="message-text">
                <textarea class="weui-textarea" placeholder="想说却还没说的" rows="3" name="text"></textarea>
                <div class="weui-textarea-counter"><span id="enterchar">0</span>/200</div>
            </div>
        </div>
        <div class="box-send">
            <button type="submit">发 &nbsp;&nbsp; 送</button>
        </div>
    </form>
    <div class="cancel">
        <svg class="iconcancel" aria-hidden="true">
            <use xlink:href="#icon-close"></use>
        </svg>
    </div>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    <script type="text/javascript" src="/Public/js/iscroll-probe.js"></script>
    
    <script type="text/javascript" src="//at.alicdn.com/t/font_fxyfioupbtaf9a4i.js"></script>
    <script src="//cdn.bootcss.com/velocity/1.2.3/velocity.min.js"></script>

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

        var num=0;
        var type="time";
        var mainviewlength_before=0;
        var mainviewlength_after=0;
        num=getpost(num,type);

        $('#sortTime').click(function() {
            $(this).addClass("toppanel-box-on");
            $('#sortLike').removeClass("toppanel-box-on");
            $('.mainview').html("");
            num=0;
            type="time";
            num=getpost(num,type);

        });
        $('#sortLike').click(function(){
            $(this).addClass("toppanel-box-on");
            $('#sortTime').removeClass("toppanel-box-on");
            $('.mainview').html("");
            num=0;
            type="like";
            num=getpost(num,type);

        });



        $('.mainview').on('click','.dialog-bottompanel-like',function(event) {
            if ($(event.target).find("use").attr("xlink:href") == "#icon-like") {
                $(event.target).find("span").text(parseInt($(event.target).find("span").text()) + 1);
                $(event.target).find("use").attr("xlink:href", "#icon-dianzan");
                var postid = $(event.target).find('.hidden-postid').text();
                if(window.localStorage){
                	var storage=window.localStorage;

					var data=JSON.parse(storage.getItem("liked-posts"))||[];
					data.push(postid);
					var stringdata=JSON.stringify(data);
		            storage.setItem("liked-posts",stringdata);

                }
                $.post("/home/lovewall/ajaxLike",{postid:postid,type:"1"},function(data){});

            } else if ($(event.target).find("use").attr("xlink:href") == "#icon-dianzan") {
                $(event.target).find("span").text(parseInt($(event.target).find("span").text()) - 1);
                $(event.target).find("use").attr("xlink:href", "#icon-like");
                var postid = $(event.target).find('.hidden-postid').text();                
                if(window.localStorage){
                	var storage=window.localStorage;

					var data=JSON.parse(storage.getItem("liked-posts"))||[];
					for(var i=0;i<data.length;i++){
						if(data[i]==postid)
							data.splice(i,1);
					}

					var stringdata=JSON.stringify(data);
		            storage.setItem("liked-posts",stringdata);
                }
                $.post("/home/lovewall/ajaxLike",{postid:postid,type:"0"},function(data){});
            }

        });

        $('.iconpost').click(function() {
            $('.mask').slideToggle(500);
            $('.bomb-box').slideToggle(500);
            $('.cancel').slideToggle(500);
            $('body').css("overflow","hidden");
            // $('body').css("position","fixed");

        });

        $('.cancel').click(function() {
            $('.mask').slideToggle(500);
            $('.bomb-box').slideToggle(500);
            $('.cancel').slideToggle(500);
            $('body').css("overflow","");

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

        function getpost(num,type) {
            var v=$('#openid').attr("value");
            $.ajax({url:'/home/lovewall/ajaxGetpost',data:{
                page: num,
                type: type
            },
                success:function(data) {
                    var arr = [];
                    $.each(data, function(i, e) {
                        if(e.gender==1){
                            arr.push('<div class="mainview-box mainview-box-reverse">')
                        }
                        else arr.push('<div class="mainview-box">')

                        arr.push(
                            '<div style="display:none;" class="hidden-gender">'+e.gender+'</div>'+
                            '<div class="mainview-box-dialog">' +
                            '<div class="dialog-toppanel">' +
                            '<svg class="icon" aria-hidden="true">' +
                            '<use xlink:href='+e.image+'></use>' +
                            '</svg>' +
                            '<div class="fromwho">' + e.sender + '</div>' +
                            '<div class="towhom">To ' + e.receiver + '</div>' +
                            '<div class="time">' + e.sendtime + '</div>' +
                            '</div>' +
                            '<a class="text" href="lovewallDetail?postid='+e.postid+'&openid='+v+'">' + e.text + '</a>' +
                            '<div class="dialog-bottompanel">' +
                            '<div class="dialog-bottompanel-like">' +
                            '<div style="display:none;" class="hidden-postid">'+e.postid+'</div>'+
                            '<svg class="iconlike" aria-hidden="true">' +
                            '<use xlink:href="#icon-like"></use>' +
                            '</svg>' +
                            '<span class="count">' + e.like_number + '</span>' +
                            '</div>' +
                            '<a class="dialog-bottompanel-comment" href="lovewallDetail?postid='+e.postid+'&openid='+$('#openid').attr("value")+'">' +
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
                },
                complete:function(){
                    $('.dialog-bottompanel-like').each(function(){
                        console.log("lalala");
                        var storage = window.localStorage;
                        var data=JSON.parse(storage.getItem("liked-posts"))||[];
                        for(var i=0;i<data.length;i++){
                            if(data[i]==$(this).find('.hidden-postid').text())
                                $(this).find("use").attr("xlink:href", "#icon-dianzan");
                        }
                    });
                    mainviewlength_after=$('.mainview').children().length;
                    if(mainviewlength_after==mainviewlength_before){
                        $('.loadmore').text("没有更多啦");
                    }else{
                        $('.loadmore').text("正在加载中…");
                        }
                }

            });
            mainviewlength_before=$('.mainview').children().length;
            num+=5;
            return num;
        }

        var range = 40; //距下边界长度/单位px  
        var totalheight = 0;
        var srollPos = 0;
        var srollPosRecord = 0;
        var START = undefined,
            LIMIT = 100,

            LIST = $('.list__wrapper'),
            CURVE = $('#curve'),
            CIRCLE = $('#circle'),
            FRICTION = 1,
            FPS = 35,
            DIFFERENCE,
            ANIMATING,
            TRANSLATE_HEIGHT = 90,
            REACHED_END = false,
            CURVE_HEIGHT = 190,
            START_CURVE = 'M-10 90 Q 161 90 332 90',
            END_CURVE = 'M-10 90 Q 161 120 332 90';

        $(".list__wrapper").on('touchstart mousedown', function(event) {
            // event.stopPropagation(); 
            // event.preventDefault();
            START = event.clientY || event.originalEvent.touches[0].clientY || event.originalEvent.changedTouches[0].clientY;

            $(window).on('touchmove mousemove', function(event) {

                console.log("start" + START);
                if (ANIMATING) {
                    return false;
                }
                if (event.type === 'touchmove') {
                    var touch = event.originalEvent.touches[0] || event.originalEvent.changedTouches[0];
                    DIFFERENCE = (START - touch.clientY) * (-1);
                    console.log("DI" + DIFFERENCE);
                    srollPos = $(window).scrollTop(); //滚动条距顶部距离(页面超出窗口的高度)   
                    console.log("srollPos" + srollPos);

                } else {
                    DIFFERENCE = (START - event.clientY) * (-1);
                }
                if (DIFFERENCE < 0) {

                    totalheight = parseFloat($(window).height()) + parseFloat(srollPos);
                    // $('.toppanel').offset({top:srollPos,left:0});
                    if (($(document).height() - range) <= totalheight) {
                        num=getpost(num,type);
                    }
                } else {

                    if (srollPosRecord == 0 && srollPos == 0) {
                        event.stopPropagation();
                        event.preventDefault();

                        if (DIFFERENCE < TRANSLATE_HEIGHT) {
                            translateSVG(DIFFERENCE);
                            setOpacity(DIFFERENCE);
                            REACHED_END = false;

                        } else if (DIFFERENCE > TRANSLATE_HEIGHT && DIFFERENCE < CURVE_HEIGHT) {
                            outerCurve(DIFFERENCE);
                            setOpacity(DIFFERENCE);
                            REACHED_END = false;
                        } else if (DIFFERENCE >= CURVE_HEIGHT) {
                            REACHED_END = true;
                        }
                    }
                }
            });
        });

        $(window).on('touchend mouseup', function(event) {
            srollPosRecord = srollPos;
            console.log("record" + srollPosRecord);
            DIFFERENCE = 0;
            START = 0;
            if (REACHED_END) {
                runAnimation();
                $('.mainview').html("");
                    num=0;
                    num=getpost(num,type);
            } else {
                backToStart();
            }
            $(window).off('mousemove');
        });

        function backToStart() {
            if (DIFFERENCE > TRANSLATE_HEIGHT) {
                setTimeout(function() {
                    $({
                        x: parseInt($('.list__wrapper').css('transform').split(',')[5])
                    }).animate({
                        x: -186
                    }, {
                        duration: 300,
                        step: function(now) {
                            $('.list__wrapper').css({
                                transform: 'translate3d(0,' + now + 'px,0)'
                            })
                        }
                    });
                }, 100);
                $('.mainview').velocity({
                    opacity: 1,
                    duration: 300,
                    delay: 200
                });

                $("#curve").velocity({
                    tween: [90, DIFFERENCE]
                }, {
                    duration: 150,
                    loop: false,
                    /*easing: [ 300, 8 ],*/
                    easing: 'easeOutCubic',
                    progress: function(e, c, r, s, t) {
                        if (t > 90) {
                            $('#curve').attr('fill', '#CB8589');
                        } else {
                            $('#curve').attr('fill', 'white');
                        }
                        createCurve(t);
                    }
                });
            } else {
                $({
                    x: parseInt($('.list__wrapper').css('transform').split(',')[5])
                }).animate({
                    x: -186
                }, {
                    duration: 300,
                    step: function(now) {
                        $('.list__wrapper').css({
                            transform: 'translate3d(0,' + now + 'px,0)'
                        })
                    }
                });
                $('.mainview').velocity({
                    opacity: 1,
                    duration: 300,
                    delay: 200
                });
                $("#curve").velocity({
                    tween: [90, DIFFERENCE]
                }, {
                    duration: 150,
                    loop: false,
                    /*easing: [ 300, 8 ],*/
                    easing: 'easeOutCubic',
                    progress: function(e, c, r, s, t) {
                        if (t > 90) {
                            $('#curve').attr('fill', '#CB8589');
                        } else {
                            $('#curve').attr('fill', 'white');
                        }
                        createCurve(t);
                    }
                });
            }
        }

        function translateSVG(offset) {
            var dist = offset - 186;
            if (dist > -188) {
                $(LIST).css({
                    transform: 'translate3d(0,' + dist + 'px,0)'
                });
            }
        }

        function setOpacity(distance) {
            distance = 140 - distance;
            var pct = distance / 140;
            $('.mainview').css({
                opacity: pct
            });
        }

        function runAnimation() {
            ANIMATING = true;

            $('svg:first-child').css({
                'filter': 'url(#goo)',
                '-webkit-filter': 'url(#goo)',
                '-moz-filter': 'url(#goo)',
                '-o-filter': 'url(#goo)',
                '-ms-filter': 'url(#goo)'
            });
            $("#curve").velocity({
                tween: [90, 200]
            }, {
                duration: 700,
                loop: false,
                easing: [0, 3, .3, 0.4],
                progress: function(e, c, r, s, t) {
                    console.log("b"+t);
                    if (t > 90) {
                        $('#curve').attr('fill', '#CB8589');
                    } else {
                        $('#curve').attr('fill', 'white');
                    }
                    createCurve(t);
                }
            });
            setTimeout(function() {
                $('#circle_group').attr({
                    'cy': 110
                });
                $('#circle').attr({
                    fill: 'rgba(255,255,255,1)'
                });
                $('#circle').velocity({
                    cy: 45
                }, {
                    duration: 200,
                    easing: 'easeOutSine'
                });

                $('#progress').velocity({
                    strokeDashoffset: 0
                }, {
                    duration: 800,
                    delay: 300
                });
                $('svg:nth-child(2)').velocity({
                    scale: 1.15,
                    opacity: 0,
                }, {
                    duration: 400,
                    delay: 1200,
                    easing: [.11, 1, .34, .98]
                });
                setTimeout(function() {
                    $('#curve').attr('d', END_CURVE);
                }, 1450);
                setTimeout(function() {
                    $('svg:first-child').css({
                        'filter': 'none',
                        '-webkit-filter': 'none',
                        '-moz-filter': 'none',
                        '-o-filter': 'none',
                        '-ms-filter': 'none'
                    });
                }, 1800);
                $('#circle').velocity({
                    cy: 140
                }, {
                    duration: 450,
                    delay: 1300,
                    complete: function() {
                        $('#curve').attr('d', START_CURVE);
                        $({
                            x: parseInt($('.list__wrapper').css('transform').split(',')[5])
                        }).animate({
                            x: -186
                        }, {
                            step: function(now) {
                                $('.list__wrapper').css({
                                    transform: 'translate3d(0,' + now + 'px,0)'
                                })
                            }
                        });
                        $('.mainview').velocity({
                            opacity: 1
                        }, 500);
                        $('#circle').attr('cy', 190);
                        $('#circle').attr({
                            fill: 'rgba(255,255,255,0)'
                        });
                        $('#progress').css({
                            strokeDashoffset: 345.6
                        });
                        $('svg:nth-child(2)').velocity({
                            scale: 1,
                            opacity: 1
                        }, 0)
                        REACHED_END = false;
                        ANIMATING = false;
                    }
                })
            }, 50);

        };

        function outerCurve(height) {
            var FRICTION_HEIGHT = height * FRICTION;
            var d = "M0 90 Q 161 " + FRICTION_HEIGHT + " 322 90"
            $(CURVE).attr({
                d: d,
                fill: '#CB8589'
            });
        }

        function createCurve(height) {
            var FRICTION_HEIGHT = height * FRICTION;
            var d = "M-10 90 Q 161 " + FRICTION_HEIGHT + " 332 90"
            $(CURVE).attr('d', d);
        }

        function gotoTop(acceleration,stime) {
       acceleration = acceleration || 0.1;
       stime = stime || 10;
       var x1 = 0;
       var y1 = 0;
       var x2 = 0;
       var y2 = 0;
       var x3 = 0;
       var y3 = 0; 
       if (document.documentElement) {
           x1 = document.documentElement.scrollLeft || 0;
           y1 = document.documentElement.scrollTop || 0;
       }
       if (document.body) {
           x2 = document.body.scrollLeft || 0;
           y2 = document.body.scrollTop || 0;
       }
       var x3 = window.scrollX || 0;
       var y3 = window.scrollY || 0;
     
       // 滚动条到页面顶部的水平距离
       var x = Math.max(x1, Math.max(x2, x3));
       // 滚动条到页面顶部的垂直距离
       var y = Math.max(y1, Math.max(y2, y3));
     
       // 滚动距离 = 目前距离 / 速度, 因为距离原来越小, 速度是大于 1 的数, 所以滚动距离会越来越小
       var speeding = 1 + acceleration;
       window.scrollTo(Math.floor(x / speeding), Math.floor(y / speeding));
     
       // 如果距离不为零, 继续调用函数
       if(x > 0 || y > 0) {
           var run = "gotoTop(" + acceleration + ", " + stime + ")";
           window.setTimeout(run, stime);
       }
    }
    });
                
    </script>
 
</body>

</html>