<!DOCTYPE html>
<!-- saved from url=(0042)http://taiwanyou.yonho.com/2016/index.html -->
<html data-dpr="1" style="font-size: 200px;">
<head lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>输入口令</title>
<meta charset="UTF-8">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/jquery-1.8.1.min.js"></script> 	
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/Js/validate/validator.js"></script>
	<link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/Js/admin.js"></script>
   <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>
<link href="<?php echo base_url();?>/webroot/OGOC/css/gloabl.css" rel="stylesheet">
<link href="<?php echo base_url();?>/webroot/OGOC/css/index1.css" rel="stylesheet">
<link href="<?php echo base_url();?>/webroot/OGOC/css/deling.css" rel="stylesheet">
	<script>
		function search(){
			var url="<?php echo site_url("search1/dosearch");?>?inajax=1";
			var data_ = {
				'time':<?php echo time();?>,
				'action':'ajax_data',
				'fwid':$("#fwid").val(),
				'openid':$("#openid").val()
			} ;
			$.ajax({
				type: "POST",
				url: url,
				data: data_,
				cache:false,
				dataType:"json",
				//  async:false,
				success: function(msg){
					var list = msg.resultinfo.list;
					var money1=msg.resultinfo.money;
					var num=msg.resultinfo.num;
					if(msg.resultcode<0){
						BUI.Message.Alert(msg.resultinfo.errmsg,'error');
						//BUI.Message.Alert("没有权限执行此操作",'error');
						return false ;
					}else if(msg.resultcode == 0 ){
						//BUI.Message.Alert(msg.resultinfo.errmsg,'error');
						window.location.href = "<?php echo site_url('search1/search2');?>";
						return false ;
					} else {
						window.location.href = "<?php echo site_url('search1/search1');?>?money="+money1+"&&num="+num;
						//BUI.Message.Alert(msg.resultinfo.errmsg,'success');
						//$("#result_").html(msg.resultinfo.obj);
					}
				},
				beforeSend:function(){
					$("#result_").html('<font color="red"><img src="<?php echo base_url();?>/webroot/CBS_Platform/Images/progressbar_microsoft.gif"></font>');
				},
				error:function(){
					BUI.Message.Alert("服务器繁忙",'error');
				}

			});
		}
	</script>
</head>
<body class="Pos" style="overflow: hidden; width: 3.2rem;">
<div class="html">
		<div class="index_Bg Pos" style="height: 579px;"> <img src="<?php echo base_url();?>/webroot/OGOC/images/Yoho_logo.png" class="index_Bg_Logo Margin-left">
				<div class="searchbox" style="margin-top:.2rem;">
						<form name="cscsearch"  method="post" id="cscsearch">
								<div class="l">
										<div class="m">
												<input name="fwid" id="fwid" type="text" class="searchkey " value="请输入口令号码" onfocus="glb_searchTextOnfocus(this);"  onblur="glb_searchTextOnBlur(this);" maxlength="70" />
												<input name="openid" id="openid" type="hidden" value="<?php if(isset($_SESSION['openid'])) echo $_SESSION['openid']; ?>"/>
												<button type="button"  class="searchbut" onclick="search()"></button>
										</div>
								</div>
						</form>
				</div>
		</div>
	<div ><img src="<?php echo base_url();?>/webroot/OGOC/images/tips.png" class="index_sign1 Pob">  </div>
</div>
</div>
<script src="<?php echo base_url();?>/webroot/OGOC/js/deling.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/flexible.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/jquery.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/index.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/common.js"></script> 
<script src="<?php echo base_url();?>/webroot/OGOC/js/jquery.kxbdMarquee.js"></script>
</body>
</html>
