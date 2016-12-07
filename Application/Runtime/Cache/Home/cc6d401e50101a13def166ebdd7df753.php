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
    
  <link href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" rel="stylesheet" type="text/css"/>

</head>

<body>
    
   


    <script type="text/javascript" src="/Public/js/vendor.js"></script>
    

<script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

  
    <script type="text/javascript">
    $(document).ready(function() {
      toastr.options={
        positionClass: "toast-top-center",
        closeButton:true,
      };
      var $toast = toastr['info']('绑定成功');  

    });
    </script>
 
</body>

</html>