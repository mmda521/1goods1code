<!DOCTYPE html>
<!-- saved from url=(0042)http://taiwanyou.yonho.com/2016/index.html -->
<html data-dpr="1" style="font-size: 200px;">
<head lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>红包</title>
<meta charset="UTF-8">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link href="<?php echo base_url();?>/webroot/OGOC/css/gloabl.css" rel="stylesheet">
<link href="<?php echo base_url();?>/webroot/OGOC/css/index1.css" rel="stylesheet">
<link href="<?php echo base_url();?>/webroot/OGOC/css/deling.css" rel="stylesheet">
<style type="text/css"> 
</style>
</head>
<body class="Pos" style="overflow: hidden; width: 3.2rem;">
<div class="html">
    <div class="index_Bg Pos" style="height: 579px; background:url(<?php echo base_url();?>/webroot/OGOC/images/packet_bg.png) no-repeat center -1rem  #fffbc8;">
        <img src="<?php echo base_url();?>/webroot/OGOC/images/Yoho_logo.png" class="index_Bg_Logo Margin-left">
		<img src="<?php echo base_url();?>/webroot/OGOC/images/packet_img.png" class="index_sign Pob">
        <div class="index_btn">
           <img src="<?php echo base_url();?>/webroot/OGOC/images/bottom.png">
        </div>
    </div>
	<!--<div class="html">
	<div class="main"> <img src="images/packet_img.png" class="packet_red" > </div>-->
		 <?php if($_GET['money']%100!=0){?>
		<div class="Money"><span style="font-size:.3rem;color:#ead70e;"><?php echo $_GET['money']/100;?></span></div>
        <?php }else{?>
            <div class="Moneyy" style="  top: .4rem;left: 1.56rem; position: fixed; z-index: 10;"><span style="font-size:.3rem;color:#ead70e;"><?php echo $_GET['money']/100;?></span></div>
        <?php }?>
        <?php if($_GET['num']>1){?>
		<div class="Get_money">您已成功领取<span style="font-size:.153rem;color:#dd3c0e;">总金额为<?php echo $_GET['money']/100;?></span>元的裂变红包，您可以把剩下的<?php echo $_GET['num'];?>个红包发送给您的<?php echo $_GET['num'];?>个好友</span>，请到微信零钱查收。</div>
        <?php }else{?>
            <div class="Get_money">您已成功领取总金额为<span style="font-size:.153rem;color:#dd3c0e;"><?php echo $_GET['money']/100;?></span>元的红包，请到微信零钱查收。</div>
        <?php }?>
</div>
<div class="index_btn">  </div>
<script src="<?php echo base_url();?>/webroot/OGOC/js/deling.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/flexible.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/jquery.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/index.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/common.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/jquery.kxbdMarquee.js"></script>
</body>
</html>