<?php 
if (! defined('BASEPATH')) {
	exit('Access Denied');
}
?>
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

<form action="#" method="post" class="definewidth m2"  name="edit_form" id="edit_form" style="height:330px ; overflow:auto">
<table class="table table-bordered table-hover m10">

    <tr>
        <td class="tableleft"><span>*</span>商家名称</td>
        <td><input type="text" name="product_SellerName" id="product_SellerName" value="<?php if(isset($info['product_SellerName'])) echo $info['product_SellerName']; ?>"  /></td>
    </tr>
    <tr>
        <td class="tableleft"><span>*</span>联系人</td>
        <td><input type="text" name="product_ShopContactPerson" id="product_ShopContactPerson" value="<?php if(isset($info['product_ShopContactPerson'])) echo $info['product_ShopContactPerson']; ?>" /></td>
    </tr> 
    <tr>
        <td class="tableleft">联系方式</td>
        <td><input type="text" name="product_ShopPhoneNo" id="product_ShopPhoneNo" value="<?php if(isset($info['product_ShopPhoneNo'])) echo $info['product_ShopPhoneNo']; ?>"/></td>
    </tr> 		
    <tr>
        <td class="tableleft">邮箱</td>
        <td><input type="text" name="product_ShopEmail" id="product_ShopEmail" value="<?php if(isset($info['product_ShopEmail'])) echo $info['product_ShopEmail']; ?>" /></td>
    </tr>
        <input type="hidden" name="product_ShopID" id="product_ShopID" value="<?php if(isset($info['product_ShopID'])) echo $info['product_ShopID']; ?>"/>
    
      
</table>
</form>
</body>
</html>  


 