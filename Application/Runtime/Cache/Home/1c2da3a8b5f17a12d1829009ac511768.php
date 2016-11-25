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
    
    <div class="lovewallDetail">
        <div class="toppanel">
            <div class="mainview-box mainview-box-reverse">
                <div class="mainview-box-dialog">
                    <div class="dialog-toppanel">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="<?php echo ($post[image]); ?>"></use>
                        </svg>
                        <div class="fromwho"><?php echo ($post[sender]); ?></div>
                        <div class="towhom">To <?php echo ($post[receiver]); ?></div>
                        <div class="time"><?php echo ($post[sendtime]); ?></div>
                    </div>
                    <div class="text"><?php echo ($post[text]); ?></div>
                </div>
            </div>
        </div>
        <div class="mainview">
            <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="mainview-box">
                    <div class="mainview-box-icon">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="<?php echo ($vo[image]); ?>"></use>
                        </svg>
                    </div>
                    <div class="mainview-box-dialog">
                        <div class="text"><?php echo ($vo[text]); ?></div>
                        <div class="time"><?php echo ($vo[sendtime]); ?></div>
                        <div class="eachopenid" style="display:none;"><?php echo ($vo[openid]); ?></div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <form class="bottompanel" action="/home/lovewall/comment" method="post">
            <div class="bottompanel-input">
            	<input name="openid" type="hidden" id="openid" value="<?php echo ($openid); ?>">
            	<input name="postid" style="display:none;" value="<?php echo ($postid); ?>">
                <input type="text" name="comment" placeholder="发表评论">
            </div>
            <button type="submit">发送</button>
        </form>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    <script type="text/javascript" src="/Public/js/iscroll-probe.js"></script>
    
    <script type="text/javascript" src="//at.alicdn.com/t/font_nhvh6mu77u0ltyb9.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
            console.log($('#openid').attr("value"));
    		$('.eachopenid').each(function(){
    			if($(this).text()==$('#openid').attr("value"))
    				$(this).parent().parent().addClass("mainview-box-reverse");
    		});
    	});
    </script>
 
</body>

</html>