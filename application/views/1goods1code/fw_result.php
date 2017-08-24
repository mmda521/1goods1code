<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>溯源信息结果</title>
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta name="viewport" content="width=device-width, user-scalable=yes" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>/webroot/CBS_Platform/Css/search.css">
    <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/Js/search.js"></script>
</head>
<body>
    <header>
        <img src="<?php echo base_url();?>/webroot/CBS_Platform/Images/headerImg.png">
    </header>
    <div class="box">
        <div class="triangle-down"></div>
        <div class="parallelogram">
            <p>进口商品官方溯源信息</p>
        </div>
    </div>
    <div class="info_list">
        <ul>
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
        </ul>
    </div>

    <div class="width_500">
        <p>温馨提示：跨境商品促销信息，请关注郑欧商城微信订阅号：郑欧商城网</p>
    </div>

    <footer class="info">
        <p>郑州国际陆港开发建设有限公司</p>
        <p class="p1">地址：河南郑州经济技术开发区经北四路与四港联动交叉口以西路北（国际陆港园区）</p>
        <div class="pla_hold"></div>
    </footer>
</body>
</html>