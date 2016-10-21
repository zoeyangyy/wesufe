<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,,user-scalable=no">
    <title>bookitem</title>
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.0.2/weui.min.css" />
</head>

<body>
    <div class="weui-media-box weui-media-box_text">
    	<img src=<?php echo ($bookinfo["image"]); ?> alt="图片不存在">
        <h4 class="weui-media-box__title">剩余数目：<?php echo ($bookinfo["available_number"]); ?></h4>
        <p class="weui-media-box__desc">ISBN：<?php echo ($bookinfo["ISBN"]); ?></p>
        <p class="weui-media-box__desc">总结：<?php echo ($bookinfo["summary"]); ?></p>       
        <?php if(is_array($storeinfo)): $i = 0; $__LIST__ = $storeinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sinfo): $mod = ($i % 2 );++$i;?><p class="weui-media-box__desc">
                状态：<?php echo ($sinfo["status"]); ?> 书号：<?php echo ($sinfo["booknumber"]); ?> 条形码：<?php echo ($sinfo["barcode"]); ?> 位置：<?php echo ($sinfo["place"]); ?> 年份：<?php echo ($sinfo["year"]); ?>
            </p><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</body>

</html>