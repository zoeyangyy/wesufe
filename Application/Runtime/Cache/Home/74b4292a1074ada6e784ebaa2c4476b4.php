<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,maximum-scale=1,initial-scale=1,user-scalable=no">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/css/vendor.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css" />
    
</head>

<body>
    
    <div class="lovewallPanel">
        <div class="toppanel" style="background:url('/Public/img/banner.jpg')">
            <a class="toppanel-box toppanel-box-on" id="sortTime" href="javascript:void(0)">最新&nbsp; ↑↓</a>
            <a class="toppanel-box" id="sortLike" href="javascript:void(0)">热度最高</a>
        </div>
        <div id="wrapper">
            <div id="scroller">
                <div id="pullDown" class="">
                    <div class="pullDownLabel"></div>
                </div>
                <div class="pulldown-tips">下拉刷新</div>
                <div class="mainview">
                    <div class="mainview-box">
                        <div class="mainview-box-dialog">
                            <div class="dialog-toppanel">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-09"></use>
                                </svg>
                                <div class="fromwho">某某</div>
                                <div class="towhom">To 某某</div>
                                <div class="time">2016/11/13 18:27</div>
                            </div>
                            <div class="text">满地都是六便士,他却抬头看见了月亮。</div>
                            <div class="dialog-bottompanel">
                                <div class="dialog-bottompanel-like">
                                    <svg class="iconlike" aria-hidden="true">
                                        <use xlink:href="#icon-like"></use>
                                    </svg>
                                    <span class="count">0</span>
                                </div>
                                <div class="dialog-bottompanel-comment">
                                    <svg class="iconcomment" aria-hidden="true">
                                        <use xlink:href="#icon-pinglun1"></use>
                                    </svg>
                                    <span class="count">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mainview-box">
                        <div class="mainview-box-dialog">
                            <div class="dialog-toppanel">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-09"></use>
                                </svg>
                                <div class="fromwho">某某</div>
                                <div class="towhom">To 某某</div>
                                <div class="time">2016/11/13 18:27</div>
                            </div>
                            <div class="text">The first two Sass color functions we will use are lighten and darken. As you might imagine.</div>
                            <div class="dialog-bottompanel">
                                <div class="dialog-bottompanel-like">
                                    <svg class="iconlike" aria-hidden="true">
                                        <use xlink:href="#icon-like"></use>
                                    </svg>
                                    <span class="count">0</span>
                                </div>
                                <div class="dialog-bottompanel-comment">
                                    <svg class="iconcomment" aria-hidden="true">
                                        <use xlink:href="#icon-pinglun1"></use>
                                    </svg>
                                    <span class="count">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mainview-box mainview-box-reverse">
                        <div class="mainview-box-dialog">
                            <div class="dialog-toppanel">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-12"></use>
                                </svg>
                                <div class="fromwho">费渡</div>
                                <div class="towhom">To 于连</div>
                                <div class="time">2016/11/13 18:27</div>
                            </div>
                            <div class="text">贝尚松是法国一座古城，城墙高大。初到神学院，那门上的铁十字架，修士的黑色道袍，和他们麻木不仁的面孔都使于连感到恐怖。他对于连说：“嘻笑就是虚伪的舞台”。</div>
                            <div class="dialog-bottompanel">
                                <div class="dialog-bottompanel-like">
                                    <svg class="iconlike" aria-hidden="true">
                                        <use xlink:href="#icon-like"></use>
                                    </svg>
                                    <span class="count">0</span>
                                </div>
                                <div class="dialog-bottompanel-comment">
                                    <svg class="iconcomment" aria-hidden="true">
                                        <use xlink:href="#icon-pinglun1"></use>
                                    </svg>
                                    <span class="count">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pullUp" class="">
                <div class="pullUpLabel">加载更多</div>
            </div>
        </div>
        <div class="bottompanel">
            <div class="bar"></div>
            <svg class="iconpost" aria-hidden="true">
                <use xlink:href="#icon-aixin"></use>
            </svg>
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
                <input name="openid" style="display:none;" value="<?php echo ($openid); ?>">
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
    
    <script type="text/javascript" src="//at.alicdn.com/t/font_cty8l93th6jyk3xr.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.mask').hide();
        $('.bomb-box').hide();
        $('.cancel').hide();



        $('.weui-textarea').on('keyup', function(event) {
            var len = $(this).val().length;
            if (len >= 200) {
                $(this).val($(this).val().substring(0, 200));
            } else {
                $('#enterchar').text(len);
            }
        });

        $('.toppanel-box').click(function() {
            $('.toppanel-box').each(function() {
                $(this).removeClass("toppanel-box-on");
            });
            $(this).addClass("toppanel-box-on");
        });

        $('.dialog-bottompanel-like').click(function() {
            if ($(this).find("use").attr("xlink:href") == "#icon-like") {
                $(this).find("span").text(parseInt($(this).find("span").text()) + 1);
                $(this).find("use").attr("xlink:href", "#icon-dianzan");
            } else {
                $(this).find("span").text(parseInt($(this).find("span").text()) - 1);
                $(this).find("use").attr("xlink:href", "#icon-like");
            }

        });

        $('.iconpost').click(function() {
            $('.mask').slideToggle(500);
            $('.bomb-box').slideToggle(500);
            $('.cancel').slideToggle(500);

        });

        $('.cancel').click(function() {
            $('.mask').slideToggle(500);
            $('.bomb-box').slideToggle(500);
            $('.cancel').slideToggle(500);
        });

        $('.female').click(function() {
            $('.male').addClass("gender-off");
            $(this).removeClass("gender-off");
            $('.box-message').addClass("box-message-right");
            $('.box-send').addClass("box-send-right");
            $('#hidden').attr("value","1");
        });
        $('.male').click(function() {
            $('.female').addClass("gender-off");
            $(this).removeClass("gender-off");
            $('.box-message').removeClass("box-message-right");
            $('.box-send').removeClass("box-send-right");
            $('#hidden').attr("value","0");
        });

        $('.anonymous').click(function() {
            if ($(this).hasClass("anonymous-on")) {
                $(this).removeClass("anonymous-on");
                $(this).siblings("input").attr("value","");
                $(this).siblings("input").show(200);
            } else {
                $(this).addClass("anonymous-on");
                $(this).siblings("input").hide(200);
                $(this).siblings("input").attr("value","匿名");
            }
        });

        var myScroll,
            pullDown = $("#pullDown"),
            pullUp = $("#pullUp"),
            pullDownLabel = $(".pullDownLabel"),
            pullUpLabel = $(".pullUpLabel"),
            container = $('.mainview'),
            loadingStep = 0; //加载状态0默认，1显示加载状态，2执行加载数据，只有当为0时才能再次加载，这是防止过快拉动刷新  

        pullDown.hide();
        pullUp.hide();

        myScroll = new IScroll("#wrapper", {
            scrollbars: false,
            mouseWheel: false,
            interactiveScrollbars: true,
            shrinkScrollbars: 'scale',
            fadeScrollbars: true,
            scrollY: true,
            probeType: 2,
            bindToWrapper: true
        });
        myScroll.on("scroll", function() {
            if (loadingStep == 0 && !pullDown.attr("class").match('refresh|loading') && !pullUp.attr("class").match('refresh')) {
                if (this.y > 40) { //下拉刷新操作  
                    $(".pulldown-tips").hide();
                    pullDown.addClass("refresh").show();
                    pullDownLabel.text("松手刷新数据");
                    loadingStep = 1;
                    myScroll.refresh();
                } else if (this.y < (this.maxScrollY - 14)) { //上拉加载更多  
                    pullUp.addClass("refresh").show();
                    pullUpLabel.text("正在载入");
                    loadingStep = 1;
                    pullUpAction();
                }
            }
        });
        myScroll.on("scrollEnd", function() {
            if (loadingStep == 1) {
                if (pullDown.attr("class").match("refresh")) { //下拉刷新操作  
                    pullDown.removeClass("refresh").addClass("loading");
                    pullDownLabel.text("正在刷新");
                    loadingStep = 2;
                    pullDownAction();
                }
            }
        });

        function pullDownAction() {
            setTimeout(function() {
                var li, i;
                for (i = 0, li = ""; i < 3; i++) {
                    li += "<li>" + "new Add " + new Date().toLocaleString() + " ！" + "</li>";
                }
                container.prepend(li);
                pullDown.attr('class', '').hide();
                myScroll.refresh();
                loadingStep = 0;
                $(".pulldown-tips").show();
            }, 1000);
        }

        function pullUpAction() {
            setTimeout(function() {
                var li, i;
                for (i = 0, li = ""; i < 3; i++) {
                    li += "<li>" + "new Add " + new Date().toLocaleString() + " ！" + "</li>";
                }
                container.append(li);
                pullUp.attr('class', '').hide();
                myScroll.refresh();
                loadingStep = 0;
            }, 1000);
        }

        document.addEventListener('touchmove', function(e) {
            e.preventDefault();
        }, false);

    });
    </script>
 
</body>

</html>