<!DOCTYPE HTML>
<html>
 <head>
  <title> 二维码生成</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/webroot/CBS_Platform/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/webroot/CBS_Platform/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/webroot/CBS_Platform/Css/style.css" />   
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/jquery-1.8.1.min.js"></script> 	
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/Js/validate/validator.js"></script>
	<link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/Js/admin.js"></script>
   <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>
   <style type="text/css">
    body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
   </style>
<script type="text/javascript">
/*function xuanzhong(){
	var  myselect=document.getElementById("hb_type");
	for(i=0;i<myselect.length;i++){
        if(myselect[i].value == 0){
           $("#num").attr('disabled','disabled');//不可编辑，不可以传值
        }
    }
}*/
$(document).ready(function(){
 $("#hb_type").change(function(){
 var options=$("#hb_type option:selected");
   if(options.val()==1)
     {
	 $("#num").val("");
	 $("#num").attr('disabled',true);//不可编辑，不可以传值
	 }
	 else
	 {
	$("#num").attr('disabled',false);//不可编辑，不可以传值 
	//$("#num").removeAttr("disabled");
	 }
  });
});
/*$(document).ready(function(){
 $("#hb_type").click(function(){
	 if($("#hb_type").prop("checked"))
		 { 
	      $("#num").attr('disabled','disabled');
		 }
	else
	 {
	$("#num").attr('display','block');//不可编辑，不可以传值 
	 }
 });
 
});*/
</script>
 </head>
 <body>
<form action="<?php echo site_url("qr_add/export");?>" method="post">
     <table class="table table-bordered table-hover" >
         <tr>
         <td class="tableleft" style="font-size:14px;"><span>*</span>生成数量</td>
         <td style="padding-top:10px;"><input type="text" name="qr_num" id="qr_num" class="abc input-default" placeholder="请填写需要生成的二维码数量" style="width:200px; height:20px;"></td>
          <td class="tableleft"><span>*</span>二维码类型</td>
             <td>  <select id="qrtype" name="qrtype">
                     <option value="">请选择</option>
                     <option value="1">方形码</option>
                     <option value="2">圆形码</option>
                  </select>
			 </td>
			 <td class="tableleft"><span>*</span>红包类型</td>
             <td>  <select id="hb_type" name="hb_type">
                     <option value="">请选择</option>
                     <option value="1">普通红包</option>
                     <option value="2">裂变红包</option>
                  </select>
			 </td>           		 
			</tr>
		  <tr>
             <td class="tableleft"><span>*</span>红包金额</td>
             <td><input type="text" name="money" id="money" class="abc input-default" placeholder="请填写红包金额" value=""></td>            
             <td class="tableleft">红包人数</td>
             <td><input type="text" name="num" id="num" class="abc input-default" placeholder="请输入领取红包人数" value=""></td>
             <td class="tableleft">场景id</td>
             <td colspan="3">  <select id="scene_id" name="scene_id">
                     <option value="">请选择</option>
                     <option value="PRODUCT_1">商品促销</option>
                     <option value="PRODUCT_2">抽奖</option>
					 <option value="PRODUCT_3">虚拟物品兑奖</option>
                     <option value="PRODUCT_4">企业内部福利</option>
					 <option value="PRODUCT_5">渠道分润</option>
                     <option value="PRODUCT_6">保险回馈</option>
					 <option value="PRODUCT_7">彩票派奖</option>
                     <option value="PRODUCT_8">税务刮奖</option>
                  </select>
			 </td>
			
         </tr>
         <tr>
			<td colspan="6" style="text-align: center;"><button type="button" class="btn btn-primary" onclick="create()">生成</button>&nbsp;&nbsp;
			<button type="reset" class="btn btn-primary" id="res">重置</button></td>
		 </tr>
		<button type="submit" class="btn btn-success" >导出</button>
	 </table>
</form>
 <tbody id="result_">
  </tbody> 
</body>
</html>  
<script>
function create(){
  var url="<?php echo site_url("qr_add/create");?>?inajax=1";
  var data_ = {
    'time':<?php echo time();?>,
    'action':'ajax_data',
	'qr_num':$("#qr_num").val(),
	'qrtype':$("#qrtype").val(),
	'money':$("#money").val(),
	'hb_type':$("#hb_type").val(),
	'num':$("#num").val(),
	'scene_id':$("#scene_id").val()
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
      if(msg.resultcode<0){
        BUI.Message.Alert("没有权限执行此操作",'error');
        return false ;
      }else if(msg.resultcode == 0 ){
        BUI.Message.Alert(msg.resultinfo.errmsg,'error');
        return false ;        
      }else{        
         BUI.Message.Alert('&nbsp;&nbsp;'+msg.resultinfo.num+'<br/>'+msg.resultinfo.section,'success');
        $("#result_").html(msg.resultinfo.obj);
      }
     },
       beforeSend:function(){
        $("#result_").html('<font color="red"><img src="<?php echo base_url();?>webroot/CBS_Platform/Images/progressbar_microsoft.gif"></font>');
       },
       error:function(){
         BUI.Message.Alert("服务器繁忙",'error');
       }
      
    });   
}
</script>