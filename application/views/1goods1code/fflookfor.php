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
<form action="<?php echo site_url("fflookfor/data_export");?>" method="post">
     <table class="table table-bordered table-hover" >
         <tr>
             <td class="tableleft">红包类型</td>
             <td>  <select id="hb_tupe" name="hb_tupe">
                     <option value="">请选择</option>
                     <option value="GROUP">裂变红包</option>
                     <option value="NORMAL">普通红包</option>
                 </select>
			</td>
			<td class="tableleft">红包状态</td>
             <td>  <select id="status" name="status">
                     <option value="">请选择</option>
                     <option value="SENDING">发放中</option>
                     <option value="SENT">已发放待领取</option>
					 <option value="FALLED">发放失败</option>
					 <option value="RECEIVED">已领取</option>
					 <option value="RFUND_ING">退款中</option>
					 <option value="REFUND">已退款</option>
                 </select>
			</td>
         </tr>
         <tr>
			<td colspan="6" style="text-align: center;"><button type="button" class="btn btn-primary" onclick="common_request(1)">查询</button>&nbsp;&nbsp;
			<button type="reset" class="btn btn-primary" id="res">重置</button></td>
		 </tr>
<button type="submit" class="btn btn-success" >导出</button>
     </table>
</form>
<table class="table table-bordered table-hover definewidth" style="width:1500px">
    <thead>
    <tr>
		<th>商户订单号</th>
        <th>红包单号</th>
        <th>红包状态</th>
        <th>发放类型</th>
        <th>红包类型</th>
        <th>红包金额</th>
        <th>红包发送时间</th>
        <th>红包退款时间</th>
        <th>红包退款金额</th>
        <th>活动名称</th>
		<th>编号</th>
		<th>裂变红包领取列表</th>
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
  var url="<?php echo site_url("fflookfor/ajax_data");?>?inajax=1";
  var data_ = {
    'page':page,
    'time':<?php echo time();?>,
    'action':'ajax_data',
	'hb_tupe':$("#hb_tupe").val(),
	'status':$("#status").val()
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
		  shtml+='<td>'+list[i]['mch_billno']+'</td>';
          shtml+='<td>'+list[i]['detail_id']+'</td>';
          shtml+='<td>'+list[i]['status']+'</td>';
          shtml+='<td>'+list[i]['send_type']+'</td>';
          shtml+='<td>'+list[i]['hb_type']+'</td>';
          shtml+='<td>'+list[i]['total_amount']+'</td>';
		  shtml+='<td>'+list[i]['send_time']+'</td>';
          shtml+='<td>'+list[i]['refund_time']+'</td>';
          shtml+='<td>'+list[i]['refund_amount']+'</td>';
          shtml+='<td>'+list[i]['act_name']+'</td>';
		  shtml+='<td>'+list[i]['rp_id']+'</td>';
          shtml+='<td>'+list[i]['list_list']+'</td>';
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
function ajax_data(page){
  common_request(page); 
}

</script>
<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>