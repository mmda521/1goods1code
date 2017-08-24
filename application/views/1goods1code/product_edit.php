<!DOCTYPE html>
<html>
<head>
    <title>用户编辑</title>
    <meta charset="UTF-8">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/webroot/CBS_Platform/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/webroot/CBS_Platform/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/webroot/CBS_Platform/Css/style.css" />   
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/jquery-1.8.1.min.js"></script> 	
	<script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>
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
<form method="post" name="edit_form" id="edit_form">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="tableleft"><span>*</span>商品编号</td>
            <td><input type="text" name="product_id" id="product_id" value="<?php echo $info['product_ItemNo'];?>"/></td>
            <td class="tableleft"><span>*</span>商品名称</td>
            <td><input type="text" name="product_name" id="product_name" value="<?php echo $info['product_ItemName'];?>"/></td>
        </tr>
       <tr>
            <td class="tableleft"><span>*</span>原产地</td>
			<td><select id="country" name="country">
				  <option value="">请选择</option>
                    <?php
                    $query = $this->db->query('SELECT * FROM  product_origininfo');
						 foreach($query->result_array() as $row){
                        if($info['product_CountryOfOrigin']==$row['product_OriginID']){?>
                            <option selected="selected" value="<?php echo $row['product_OriginID'];?>"><?php echo $row['product_OriginName'];?></option>
                        <?php }else{?>						    
                            <option value="<?php echo $row['product_OriginID'];?>"><?php echo $row['product_OriginName'];?></option>
                        <?php } }?>
                </select> 
			</td>
            <td class="tableleft"><span>*</span>启运港</td>
			<td><select id="port" name="port">
				  <option value="">请选择</option>
                    <?php
                    $query = $this->db->query('SELECT * FROM  product_portinfo');
						 foreach($query->result_array() as $row){
                        if($info['product_PortOfShipment']==$row['product_PortID']){?>
                            <option selected="selected" value="<?php echo $row['product_PortID'];?>"><?php echo $row['product_PortName'];?></option>
                        <?php }else{?>						    
                            <option value="<?php echo $row['product_PortID'];?>"><?php echo $row['product_PortName'];?></option>
                        <?php } }?>
                </select> 
			</td>
        </tr>
        <tr>
            <td class="tableleft"><span>*</span>报检日期</td>
           <td><input readonly class="calendar" type="text" name="bj_date" id="bj_date" value="<?php echo $info['product_InspectionDate'];?>"/></td>
            <td class="tableleft"><span>*</span>报检单号</td>
            <td><input type="text" name="bj_id" id="bj_id" value="<?php echo $info['product_InspectionNo'];?>"/></td>
        </tr>
        <tr>
           <td class="tableleft"><span>*</span>报关日期</td>
           <td><input readonly class="calendar" type="text" name="bg_date" id="bg_date" value="<?php echo $info['product_DeclarationDate'];?>"/></td>
            <td class="tableleft"><span>*</span>报关单号</td>
            <td><input type="text" name="bg_id" id="bg_id" value="<?php echo $info['product_DeclarationNo'];?>"/></td>
        </tr>
        <tr>
            <td class="tableleft"><span>*</span>进口商</td>
           <td colspan="3"><select id="product_shop" name="product_shop">
				  <option value="">请选择</option>
                    <?php
                    $query = $this->db->query('SELECT * FROM  product_shopinfo');
						 foreach($query->result_array() as $row){
                        if($info['product_ShopID']==$row['product_ShopID']){?>
                            <option selected="selected" value="<?php echo $row['product_ShopID'];?>"><?php echo $row['product_SellerName'];?></option>
                        <?php }else{?>						    
                            <option value="<?php echo $row['product_ShopID'];?>"><?php echo $row['product_SellerName'];?></option>
                        <?php } }?>
                </select> 
			</td>			
        </tr>
    </table>
    <input type="hidden" name="product_ItemID" id="product_ItemID" value="<?php echo $info['product_ItemID'];?>"/>
</form>
</body>
</html>
<script type="text/javascript">
    BUI.use('bui/calendar',function(Calendar){
        var datepicker = new Calendar.DatePicker({
            trigger:'.calendar',
            autoRender : true
        });
    });
</script>
<script>
    $(function () {
        $("#btnSave").click(function(){
            if($("#myform").Valid() == false || !$("#myform").Valid()) {
                return false ;
            }
        });
    });
</script>
