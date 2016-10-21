<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,,user-scalable=no">
    <title>library</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.0.2/weui.min.css" />
</head>

<body>
    <?php if(is_array($books)): $i = 0; $__LIST__ = $books;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$book): $mod = ($i % 2 );++$i;?><a href="bookitem?url=<?php echo ($book["url"]); ?>">
            <div class="weui-media-box weui-media-box_text">
                <h4 class="weui-media-box__title">书名：<?php echo ($book["bookname"]); ?> </h4>
                <p class="weui-media-box__desc">出版社：<?php echo ($book["publisher"]); ?></p>
                <p class="weui-media-box__desc">作者：<?php echo ($book["author"]); ?></p>
                <p class="weui-media-box__desc">图书类型<?php echo ($book["booktype"]); ?></p>
                <p class="weui-media-box__desc">书号<?php echo ($book["booknumber"]); ?></p>
            </div>
        </a><?php endforeach; endif; else: echo "" ;endif; ?>
</body>

</html>