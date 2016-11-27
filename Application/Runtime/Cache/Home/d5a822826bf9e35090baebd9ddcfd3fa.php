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
    
<div class="librarysearch">
    
    <div class="toppanel">
        <h4>上海财经大学图书馆</h4>
        <p>厚德博学，经济匡时</p>
    </div>
    <div class="topimage">
        <!-- <i class="iconfont">&#xe66d;</i> -->
          <img src="/Public/img/linn.gif" alt="Linn">
    </div> 
    <div class="search-bar" id="searchBar">
        <form class="search-bar__form" action="/home/learn/library" method="post">
            <div class="search-bar__box">
                <!-- <i class="icon-search">&#xe67c;</i> -->
                <input type="search" class="search-bar__input" placeholder="输入图书名、作者名" name="book">
            </div>
            <div class="search-button">
                <button id="search" type="submit">搜索</button>
            </div>
        </form>
    </div>
</div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    <script type="text/javascript" src="/Public/js/iscroll-probe.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
       
    });
    </script>
 
</body>

</html>