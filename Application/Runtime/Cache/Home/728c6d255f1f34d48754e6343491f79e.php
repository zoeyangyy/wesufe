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
    
    <div class="library">
        <div class="toppanel">
            <i class="iconfont">&#xe602;</i>
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
        </div>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    <script type="text/javascript" src="/Public/js/iscroll-probe.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        var range = 50; //距下边界长度/单位px  
        var num = 1;
        var totalheight = 0;
        num = getbook(num);
        $(window).scroll(function() {
            var srollPos = $(window).scrollTop(); //滚动条距顶部距离(页面超出窗口的高度)   
            totalheight = parseFloat($(window).height()) + parseFloat(srollPos);
            if (($(document).height() - range) <= totalheight) {
                num = getbook(num);
            }
        });
    });

    function getbook(num) {
        var book = $('#searchInput').data('keyword');
        $.get('/home/learn/ajaxGetbook', {
                book: book,
                page: num
            },
            function(data) {
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
                        '<div class="box-icon"><i class="iconfont">&#xe669;</i></div>' +
                        '</a>')
                });
                var html = arr.join('');
                $('.panel-bd').append(html);
            }
        );
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