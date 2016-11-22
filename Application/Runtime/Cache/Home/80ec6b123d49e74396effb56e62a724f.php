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
    
    <div class="libraryitem">
        <div class="toppanel"></div>
        <div class="bookname"><?php echo ($bookname); ?></div>
        <div class="author"><?php echo ($author); ?></div>
        <div class="image">
            <img src=<?php echo ($bookinfo["image"]); ?>>
        </div>

        <div class="weui-panel weui-panel_access">
            <div class="weui-panel__hd">豆瓣简介</div>
            <div class="weui-panel__bd">
                <div class="weui-media-box weui-media-box_text">
                    <p class="weui-media-box__desc"><?php echo ($bookinfo["summary"]); ?></p>
                </div>
            </div>
        </div>
        <div class="weui-panel">
            <div class="weui-panel__hd">馆藏状态</div>
            <div class="weui-panel__bd">
            <?php if(is_array($storeinfo)): $i = 0; $__LIST__ = $storeinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sinfo): $mod = ($i % 2 );++$i;?><div class="weui-media-box weui-media-box_text">
                    <p class="weui-media-box__desc"><?php echo ($sinfo["place"]); ?><br/>
                    书号：<?php echo ($sinfo["booknumber"]); ?></p>
                    <ul class="weui-media-box__info">
                        <li class="weui-media-box__info__meta">条形码：<?php echo ($sinfo["barcode"]); ?></li>
                        <li class="weui-media-box__info__meta"><?php echo ($sinfo["year"]); ?></li>
                        <li class="weui-media-box__info__meta weui-media-box__info__meta_extra"><?php echo ($sinfo["status"]); ?></li>
                    </ul>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            if($('img').attr("src")=="../tpl/images/nobook.jpg")
                $('img').attr("src","/Public/img/book.jpg");
            $('.toppanel').css("background","url("+$('img').attr("src")+")");
            $('.toppanel').css("background-size","cover");
            $('.toppanel').css("opacity","0.7");
        });
    </script>
 
</body>

</html>