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

        </div>
        <form class="bottompanel">
            <div class="bottompanel-input">
            	<input name="openid" type="hidden" id="openid" value="<?php echo ($openid); ?>">
            	<input name="postid" style="display:none;" id="postid" value="<?php echo ($postid); ?>">
                <input type="text" id="commentid" name="comment" placeholder="发表评论">
            </div>
            <input type="button" class="inputbutton" id="submit" value="发送">
        </form>
    </div>

    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    
    <script type="text/javascript" src="//at.alicdn.com/t/font_nhvh6mu77u0ltyb9.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){

            getcomment();

            var postid=$('#postid').attr("value");
            
            $('#submit').on("click",function(){
               
                var comment=$('#commentid').val();
                if(comment=="") alert("请填写评论");
                else{
                $('.mainview').html("");
                $('#commentid').val("");
                $.ajax({
                    url: '/home/lovewall/ajaxComment',
                    data: {
                        postid:postid,
                        comment:comment
                    },
                    success: function(data) {
                        var arr = [];
                        $.each(data, function(i, e) {
                            arr.push(
                                '<div class="mainview-box">'+
                                    '<div class="mainview-box-icon">'+
                                        '<svg class="icon" aria-hidden="true">'+
                                            '<use xlink:href='+e.image+'></use>'+
                                        '</svg>'+
                                    '</div>'+
                                    '<div class="mainview-box-dialog">'+
                                        '<div class="text">'+e.text+'</div>'+
                                        '<div class="time">'+e.sendtime+'</div>'+
                                        '<div class="eachopenid" style="display:none;">'+e.openid+'</div>'+
                                    '</div>'+
                                '</div>'
                              )
                        });
                        var html = arr.join('');  
                        $('.mainview').append(html);                    
                    },
                    complete: function(){
                        
                        $('.eachopenid').each(function(){
                            if($(this).text()==$('#openid').attr("value"))
                                $(this).parent().parent().addClass("mainview-box-reverse");
                        });
                    }
                });
                }
                 
            }); 
            function getcomment(){
                var postid=$('#postid').attr("value");
                $.ajax({
                    url: '/home/lovewall/ajaxGetcomment',
                    data: {
                        postid:postid,
                    },
                    success: function(data) {
                        var arr = [];
                        $.each(data, function(i, e) {
                            arr.push(
                                '<div class="mainview-box">'+
                                    '<div class="mainview-box-icon">'+
                                        '<svg class="icon" aria-hidden="true">'+
                                            '<use xlink:href='+e.image+'></use>'+
                                        '</svg>'+
                                    '</div>'+
                                    '<div class="mainview-box-dialog">'+
                                        '<div class="text">'+e.text+'</div>'+
                                        '<div class="time">'+e.sendtime+'</div>'+
                                        '<div class="eachopenid" style="display:none;">'+e.openid+'</div>'+
                                    '</div>'+
                                '</div>'
                              )
                        });
                        var html = arr.join('');
                        $('.mainview').append(html);                       
                    },
                    complete: function(){
                        $('.eachopenid').each(function(){
                            if($(this).text()==$('#openid').attr("value"))
                                $(this).parent().parent().addClass("mainview-box-reverse");
                        });
                    }
                });

            }
    	});
    </script>
 
</body>

</html>