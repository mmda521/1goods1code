<?php
/**
 *库位操作
 *
 *
 **/
class Fwsy extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common_function');
        $this->load->library("common_page");  
        $this->load->model('product_model');  
        $this->load->model('origin_model');
		$this->load->model('port_model');
		$this->load->model('shop_model');	
        $this->load->model('search_model'); 
		$this->load->model('qradd_model');
    }


	
    /**
    *index页面
    *
    *
    * */
     public function search()
    {
         $this->load->view('1goods1code/input_fwid');
		
    }
	
	/**
    *index页面
    *
    *
    * */
     public function lookfor()
    {
         $this->load->view('1goods1code/fw_search');
		
    }
	
	 public function search_for()
    {
		$data = $this->input->get_post("data");
		//PC::debug($data); 
		$list = $this->search_model->get_list($data);
		$QRInfo['QR_No'] = $list['QR_No'];
		$QRInfo['QR_Count'] = $list['QR_Count'];
		$QRInfo['QR_FWTime'] = $list['QR_FWTime'];
		$itemInfo = $this->product_model->search_ItemID_Ref($list['QR_ItemID_Ref']);
		$QRInfo['product_ItemNo'] = $itemInfo['product_ItemNo'];
		$QRInfo['product_ItemName'] = $itemInfo['product_ItemName'];
		$QRInfo['product_InspectionDate'] = $itemInfo['product_InspectionDate'];
		$QRInfo['product_InspectionNo'] = $itemInfo['product_InspectionNo'];
		$QRInfo['product_DeclarationDate'] = $itemInfo['product_DeclarationDate']; 
		$QRInfo['product_DeclarationNo'] = $itemInfo['product_DeclarationNo'];
		$origininfo = $this->origin_model->search_origininfo($itemInfo['product_CountryOfOrigin']);
		$QRInfo['product_OriginName'] = $origininfo['product_OriginName'];
		$portinfo = $this->port_model->search_portinfo($itemInfo['product_PortOfShipment']);			  
		$QRInfo['product_PortName'] = $portinfo['product_PortName'];
		$shopinfo = $this->shop_model->search_shopinfo($itemInfo['product_ShopID']);
		$QRInfo['product_SellerName'] = $shopinfo['product_SellerName'];
		$list['info']=$QRInfo;
		//PC::debug($list['info']);
        //$this->load->view('1goods1code/FW_Mobile',$list);
		$this->load->view('1goods1code/fw_result',$list);
		
    }
	
	 public function dosearch()
    {
       //$openid ="oyTynwxmY6Tqd3NDyaj70NX4JAXY";	   
	   $fwid = $this->input->get_post("fwid");	   
	   $list = $this->search_model->get_list($fwid);
	   //PC::debug($list);
	   if(empty($list)) {
            echo result_to_towf_new('1', 0, '您输入的防伪码无效,请重新输入。', NULL);
            exit();
        }
		else 
		{
		     if($list['QR_Active']=='N')
			{
			 echo result_to_towf_new('1', 0, '请激活商品信息后再来', NULL);
             exit();	
			}
		 else
	        { 
		     $data=$fwid;              
             echo result_to_towf_new4('1', 1, 'success',null,$data);  	
     	      //PC::debug($QRInfo);  
	        }	
		}
      
        
    }
	
}
