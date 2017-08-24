<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>防伪码查询</title>

    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta name="viewport" content="width=device-width, user-scalable=yes" />
<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/jquery-1.8.1.min.js"></script> 	
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/Js/validate/validator.js"></script>
	<link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/Js/admin.js"></script>
   <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>/webroot/CBS_Platform/Css/search.css">
    <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/Js/search.js"></script>
<script type="text/javascript">
		function search(){
			var url="<?php echo site_url("fwsy/dosearch");?>?inajax=1";
			var data_ = {
				'time':<?php echo time();?>,
				'action':'ajax_data',
				'fwid':$("#fwid").val(),
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
						//BUI.Message.Alert(msg.resultinfo.errmsg,'error');
						BUI.Message.Alert("没有权限执行此操作",'error');
						return false ;
					}else if(msg.resultcode == 0 ){
						BUI.Message.Alert(msg.resultinfo.errmsg,'error');						
						return false ;
					} else {
						window.location.href = "<?php echo site_url('fwsy/search_for');?>?data="+msg.resultinfo.data;
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
		/* $(document).ready(function(){
	
		//重置
		$("#res").click(function(){
			
			$("#fw_search").val('');

			});

		});	 */
		 function doReset(){  
      document.getElementById("fw_search").value="";
      }  
	</script>
</head>
<body>
    <header>
        <img src="<?php echo base_url();?>/webroot/CBS_Platform/Images/headerImg.png">
    </header>

    <div class="box">
        <div class="triangle-down"></div>
        <div class="parallelogram">
            <p class="font_20">防伪查询</p>
        </div>
    </div>

    <div class="code">
        <p class="font_20">验证真伪，请先扫描二维码，然后刮开涂层，输入6位数字防伪溯源码</p>
        <form>
		<input type="text" name="fwid" id="fwid" placeholder="请输入6位防伪码"/>
        <p class="font_16 top_24">如有疑问，请在工作日时间，拨打400-6822-718咨询(工作日：周一至周五，上午8:00至22:00)。</p>
        <button type="button" class="button blue" id="fw_search" onclick="search()">查询</button>
        <button type="reset" class="button white" id="res" onClick="doReset()">重置</button>
      </form>
   </div>

    <div class="width_500">
        <p class="font_20">温馨提示：跨境商品促销信息，请关注郑欧商城微信订阅号：郑欧商城网</p>
    </div>

    <footer class="info">
        <p class="font_20">郑州国际陆港开发建设有限公司</p>
        <p class="p1 font_20">地址：河南郑州经济技术开发区经北四路与四港联动交叉口以西路北（国际陆港园区）</p>
        <div class="pla_hold"></div>
    </footer>
</body>
</html>