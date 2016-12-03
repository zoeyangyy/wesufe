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
    
    <div class="library">
        <div class="toppanel">
            <svg class="icon" aria-hidden="true">
            <use xlink:href="#icon-daxue"></use>
        </svg>
            <p>上海财经大学图书馆</p>
        </div>
        <div class="weui-search-bar" id="searchBar">
            <form class="weui-search-bar__form" action="/home/learn/library" method="post">
                <div class="weui-search-bar__box">
                    <i class="weui-icon-search"></i>
                    <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required="" name="book" data-keyword="<?php echo ($keyword); ?>">
                    <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                </div>
                <label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
                    <i class="weui-icon-search"></i>
                    <span>搜索</span>
                </label>
            </form>
            <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
        </div>
        <div class="panel">
            <div class="panel-bd">
            </div>
            <div class="loadmore">正在加载中</div>
        </div>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    
    <script src="//at.alicdn.com/t/font_8lwn5qxd2jn0cnmi.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var range = 50; //距下边界长度/单位px  
        var num = 1;
        var totalheight = 0;
        num = getbook(num);
        console.log("num"+num);
        
        if($('.panel-bd').children().length==0)
        $('.loadmore').text("没有找到相关图书");
        
        $(window).scroll(function() {
            var srollPos = $(window).scrollTop(); //滚动条距顶部距离(页面超出窗口的高度)   
            totalheight = parseFloat($(window).height()) + parseFloat(srollPos);

            if (($(document).height() - range) <= totalheight) {
                num = getbook(num);
                if(num==0){
                    $('.loadmore').text("没有更多了");
                }
            }
        });
    

    });

function getbook(num) {
        var book = $('#searchInput').data('keyword');
        $.ajax({type:'GET',url:'/home/learn/ajaxGetbook',data:{
                book: book,
                page: num
            },
            success:function(data) {
                console.log("datalength"+data.length);
                if(data.length==0){
                    console.log("guolailma");
                    return 0;
                }
                var arr = [];
                $.each(data, function(i, e) {
                    arr.push('<a class="panel-bd-box" href="bookitem?url=' + e.url + '&bookname='+e.bookname+'&author='+e.author+'">' +
                        '<div class="box-content">' +
                        '<p class="bookname">' + e.bookname + '</p>' +
                        '<div class="line"></div>' +
                        '<p class="author">' + e.author + ' &nbsp;&nbsp;&nbsp;' + e.publisher + '</p>' +
                        '<p class="pulisher"></p>' +
                        '<p class="number">' + e.booknumber + '</p>' +
                        '<p class="type"></p>' +
                        '</div>' +
                        '<div class="box-icon"><svg class="icon" aria-hidden="true"><use xlink:href="#icon-arrowright"></use></svg></div>' +
                        '</a>')
                });
                var html = arr.join('');
                $('.panel-bd').append(html);
            },
            error:function(){
                return 0;
            }}
        );
        console.log("diyici");
        return ++num;
    }
    
    </script>
    <script type="text/javascript" class="searchbar js_show">
    $(function() {
        var $searchBar = $('#searchBar'),
            $searchResult = $('#searchResult'),
            $searchText = $('#searchText'),
            $searchInput = $('#searchInput'),
            $searchClear = $('#searchClear'),
            $searchCancel = $('#searchCancel');

        function hideSearchResult() {
            $searchResult.hide();
            $searchInput.val('');
        }

        function cancelSearch() {
            hideSearchResult();
            $searchBar.removeClass('weui-search-bar_focusing');
            $searchText.show();
        }

        $searchText.on('click', function() {
            $searchBar.addClass('weui-search-bar_focusing');
            $searchInput.focus();
        });
        $searchInput
            .on('blur', function() {
                if (!this.value.length) cancelSearch();
            })
            .on('input', function() {
                if (this.value.length) {
                    $searchResult.show();
                } else {
                    $searchResult.hide();
                }
            });
        $searchClear.on('click', function() {
            hideSearchResult();
            $searchInput.focus();
        });
        $searchCancel.on('click', function() {
            cancelSearch();
            $searchInput.blur();
        });
    });
    </script>
 
</body>

</html>