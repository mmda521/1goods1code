<!DOCTYPE HTML>
<html>
 <head>
  <title> 搜索表单</title>
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
 </head>
 <body>
<form action="<?php echo site_url("location/ajax_data_export");?>" method="post">
     <table class="table table-bordered table-hover" >
         <tr>
         <td class="tableleft">起始号段</td>
         <td><input type="text" name="startNum" id="startNum" class="abc input-default"></td>
         <td class="tableleft">结束号段</td>
         <td><input type="text" name="endNum" id="endNum" class="abc input-default"></td>
         </tr>		 
		 <tr>
			<td colspan="4" style="text-align: center;"><button type="button" id="search" class="btn btn-primary" onclick="common_request(1)">查询</button>&nbsp;&nbsp;
			<button type="button" class="btn btn-primary" onclick="recover()">回收</button>&nbsp;&nbsp;
			<button type="reset" class="btn btn-primary" id="res">重置</button></td>
		 </tr>
     </table>
</form>
<table class="table table-bordered table-hover definewidth">
    <thead>
    <tr>
	    <th>二维码序列号</th>
        <th>二维码激活状态</th>
        <th>商品编号</th>
        <th>商品名称</th>
        <th>原产地</th>
        <th>启运港</th>
        <th>报检日期</th>
        <th>报检单号</th>
		<th>报关日期</th>
        <th>报关单号</th>
        <th>进口商</th>
       
    </tr>
    </thead>
  <tbody id="result_">
  </tbody>  
  </table>
  <div id="page_string" style="float:right;">
  
  </div> 

</body>
</html>  
<script>
$(document).ready(function(){
	
		//重置
		$("#res").click(function(){
			
			$("form :input").val('');

			});
			//end
		});	

$(function () {
  common_request(1);
});		
		

function common_request(page){
  var url="<?php echo site_url("qr_recover/ajax_data");?>?inajax=1";
  var data_ = {
    'page':page,
    'time':<?php echo time();?>,
    'action':'ajax_data',
	'startNum':$("#startNum").val(),
	'endNum':$("#endNum").val(),
  } ;
  $.ajax({
       type: "POST",
       url: url,
       data: data_,
       cache:false,
       dataType:"json",
     //  async:false,
       success: function(msg){
      var shtml = '' ;
      var list = msg.resultinfo.list;
      if(msg.resultcode<0){
        BUI.Message.Alert("没有权限执行此操作",'error');
        return false ;
      }else if(msg.resultcode == 0 ){
        BUI.Message.Alert(msg.resultinfo.errmsg,'error');
        return false ;        
      }else{ 
     for(var i in list){
				shtml+='<tr>'; 
                shtml+='<td>'+list[i]['QR_No']+'</td>';
				shtml+='<td>'+list[i]['QR_Active']+'</td>';			
				shtml+='<td>'+list[i]['product_ItemNo']+'</td>';
				shtml+='<td>'+list[i]['product_ItemName']+'</td>';
				shtml+='<td>'+list[i]['product_OriginName']+'</td>';
				shtml+='<td>'+list[i]['product_PortName']+'</td>';
				shtml+='<td>'+list[i]['product_InspectionDate']+'</td>';
				shtml+='<td>'+list[i]['product_InspectionNo']+'</td>';
				shtml+='<td>'+list[i]['product_DeclarationDate']+'</td>';
				shtml+='<td>'+list[i]['product_DeclarationNo']+'</td>';
				shtml+='<td>'+list[i]['product_SellerName']+'</td>';
				shtml+='</tr>';                          
		}
        $("#result_").html(shtml);
        
        $("#page_string").html(msg.resultinfo.obj);
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

function recover(){
       var startdata_=$("#startNum").val();
    if(!startdata_){
      BUI.Message.Alert('请先输入起始号段','error');
      return;
    }
	 var enddata_=$("#endNum").val();
    if(!enddata_){
      BUI.Message.Alert('请先输入结束号段','error');
      return;
    }
	var data1_ = $("#startNum").serializeArray();
    var data2_ = $("#endNum").serializeArray();
    var data_= data1_.concat(data2_);
        BUI.Message.Confirm('回收后不可恢复,是否继续回收？',function(){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('qr_recover/recover');?>" ,
                data: data_,
                cache:false,
                dataType:"json",
                //  async:false,
                success: function(msg){
                    if(msg.resultcode<0){
                        BUI.Message.Alert('没有权限执行此操作','error');
                        return false ;
                    }else if(msg.resultcode == 0 ){
                        BUI.Message.Alert(msg.resultinfo.errmsg ,'error');                        
                        return false ;
                    }else{
                        BUI.Message.Alert('回收成功！');
						//common_request(1);
                    }
                },
                error:function(){
                    BUI.Message.Alert('服务器繁忙请稍后','error');
                }

            });
        },'question');

    }

 function ajax_data(page){
       common_request(page); 
}
	
</script>
<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>