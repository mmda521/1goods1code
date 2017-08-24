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
         <td class="tableleft">商品编号</td>
         <td><input type="text" name="product_id" id="product_id" class="abc input-default" placeholder="" value=""></td>
             <td class="tableleft">商品名称</td>
             <td><input type="text" name="product_name" id="product_name" class="abc input-default" placeholder="" value=""></td>
             </tr>
         <tr>
			<td colspan="6" style="text-align: center;"><button type="button" class="btn btn-primary" onclick="common_request(1)">查询</button>&nbsp;&nbsp;
			<button type="reset" class="btn btn-primary" id="res">重置</button></td>
		 </tr>
		  <a class="btn btn-success" id="addnew0" href="<?php echo site_url("qr_active/qr_activeNo_search");?>">查询激活号段<span class="glyphicon glyphicon-plus"></span></a>
	 </table>
</form>
<table class="table table-bordered table-hover definewidth">
    <thead>
    <tr>
        <th>商品编号</th>
        <th>商品名称</th>
        <th>原产地</th>
        <th>启运港</th>
        <th>报检日期</th>
        <th>报检单号</th>
		<th>报关日期</th>
        <th>报关单号</th>
        <th>进口商</th>
        <th>激活</th>
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
  var url="<?php echo site_url("product/ajax_data");?>?inajax=1";
  var data_ = {
    'page':page,
    'time':<?php echo time();?>,
    'action':'ajax_data',
	'product_id':$("#product_id").val(),
	'product_name':$("#product_name").val()
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
          shtml+='<td>'+list[i]['product_ItemNo']+'</td>';
          shtml+='<td>'+list[i]['product_ItemName']+'</td>';
          shtml+='<td>'+list[i]['product_CountryOfOrigin']+'</td>';
          shtml+='<td>'+list[i]['product_PortOfShipment']+'</td>';
          shtml+='<td>'+list[i]['product_InspectionDate']+'</td>';
		  shtml+='<td>'+list[i]['product_InspectionNo']+'</td>';
          shtml+='<td>'+list[i]['product_DeclarationDate']+'</td>';
          shtml+='<td>'+list[i]['product_DeclarationNo']+'</td>';
		  shtml+='<td>'+list[i]['product_ShopID']+'</td>';
		  shtml+='<td><a href="javascript:void(0)" name="success" onclick=\'active(\"'+list[i].product_ItemID+'\")\' class="icon-edit" title="激活'+list[i]['product_ItemID']+'"></a></td>';		  		          
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

	
	 function active(product_ItemID){
    var Overlay = BUI.Overlay
    var dialog = new Overlay.Dialog({
      title:"激活商品信息",
      width:600,
      height:300,
      loader : {
        url : '<?php echo site_url("qr_active/activeproduct");?>',
        autoLoad : false, //不自动加载
        params : {"showpage":"1"},//附加的参数
        lazyLoad : true //不延迟加载
      },
      mask:true,//遮罩层是否开启
      closeAction : 'destroy',
      success:function(){
        submit_active(product_ItemID); //编辑级别分类处理
        this.close();
      }
    });
    dialog.show();
    dialog.get('loader').load({"product_ItemID":product_ItemID});
  }
  function submit_active(product_ItemID){
    var data_ = $("#active_form").serializeArray();
    BUI.Message.Confirm('您确认要激活该商品吗？',function(){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('qr_active/do_activeproduct');?>" ,
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
                        BUI.Message.Alert('激活成功！');
						common_request(1);
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