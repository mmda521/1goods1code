<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<!-- saved from url=(0066)http://sy.kjb2c.com/fwm.do?id=912b26b4-ac23-40a4-9084-230f8f67c403 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">
    
    <meta name="viewport" content="width=device-width">
    <title>防伪码查询</title>
	<link rel="stylesheet" type="text/css" href="../../../webroot/TDC_Mobile/fwmreset.css">
	<link rel="stylesheet" type="text/css" href="../../../webroot/TDC_Mobile/fwm3.css">
	<script src="../../../webroot/TDC_Mobile/jquery.js" type="text/javascript"></script>
	<script src="../../../webroot/TDC_Mobile/checkbox.js" type="text/javascript"></script>
	
	<link rel="stylesheet" type="text/css" href="../../../webroot/TDC_Mobile/lightbox.css">
	<script src="../../../webroot/TDC_Mobile/jquery-1.11.0.min.js"></script>
	<script src="../../../webroot/TDC_Mobile/lightbox.js"></script>
		
	<script language="javascript">
		$(document).ready(function(){
		function RWidth(){
		var W=$(window).width();
		$(".list_in").find("li.right").css("width",parseInt(W)-20-90);
		$(".content").css("width",parseInt(W)-20);
		$("h1.header").css("width",parseInt(W)-90);
		}
		RWidth()
		$(window).resize(function(){RWidth()});
		});
	</script>
</head>
<body>
<header class="d">
	<h1 class="header" style="width: 1830px;">郑州国际陆港进口商品防伪溯源查询</h1>
</header>
  <article style="padding:0 10px">
   <aside class="result">查询结果</aside>
   <div class="panel">
    <h2>进口商品官方溯源信息</h2>
    <ul id="foodInfo">
		<li>商品名称：<?php echo $info['product_ItemName'];?></li>
		<li>原产国（地）：<?php echo $info['product_OriginName'];?></li>
		<li>进口商/代理商：<?php echo $info['product_SellerName'];?></li>			
		<li>启运地：<?php echo $info['product_PortName'];?></li>
		<li>报检日期：<?php echo $info['product_InspectionDate'];?></li>
		<li>报检单号：<?php echo $info['product_InspectionNo'];?></li>
		<li>报关日期：<?php echo $info['product_DeclarationDate'];?></li>
		<li>报关单号：<?php echo $info['product_DeclarationNo'];?></li>		
		<li>二维码序号：<?php echo sprintf("%013d",$info['QR_No']);?></li>
		<li>防伪信息：<?php
			if ($info['QR_Count']+1 == 1 ) {
			echo "您好，您通过手机网页查询本款商品，经系统核对，本款商品系通过正规渠道进口，请按标签所示保质期限使用。该防伪码总共被查询1次，查询有效！";
		    $data = array(
		    	'QR_Count' => $info['QR_Count']+1,
		    	'QR_FWTime' => date('y-m-d H:i:s',time())
		    	);
    		$this->qradd_model->update($data,$info['QR_No']);
		}
		else {
    		$count = $info['QR_Count']+1;
    		echo "这是第".$count."次查询，首次查询时间为".$info['QR_FWTime']."<br>请致电400-6822-718进行咨询";
    		$data = array('QR_Count' => $info['QR_Count']+1);
    		$this->qradd_model->update($data,$info['QR_No']);

    	}

		?></li>
		<br>
	</ul>
   </div>

   <footer>
   		<p>请刮开你所购买商品上的防伪标识，在本页查询验证码框里输入防伪码。</p>
        <p>请确保输入的防伪码正确无误，在输入防伪码后，点击进入查询，即可识别产品真伪。</p>
        <p>如果您输入的防伪码正确无误，则查询系统提示：你所购买的产品是正品，并显示相关产品信息。</p>
        <p>如果您输入的防伪码已经被查询过，则查询系统提示：该防伪码已被查询过几次，并显示上次查询时间。</p>
        <p>如果您输入的防伪码在数据库里不存在或已被过期删除，则查询系统提示：该防伪码不存在，请谨防假冒。</p>
        <p>免费声明：本系统仅能验证进口产品所属生产厂商或服务商，商品售后服务请直接联系您的销售商，请知悉。</p>
   </footer>
   
  	</article>





<script type="text/javascript" language="javascript">

	var wait=60;
	function time() {
		if (wait == 0) {
			$("#wait").hide();
		    $("#cx").show();
			wait = 60;
		} else {
			$("#wait").html(wait+"秒后可重新查询");
			$("#wait").show();
			$("#cx").hide();
			
			wait--;
			setTimeout(function(){
				time();
			},
			1000);
		}
	}
	

</script>
</body></html>