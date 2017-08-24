<?php
/**
 *库位操作
 *
 *
 **/
class Qr_recover extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common_function');
        $this->load->helper('guid');
        $this->load->library("common_page");  
        $this->load->model('qr_active_model');
		$this->load->model('product_model');
		$this->load->model('origin_model');
		$this->load->model('port_model');
		$this->load->model('shop_model');
        $this->load->model('qradd_model');		
        $this->load->library('session');    
    }

	   public function welcome()
    {
         $this->load->view('1goods1code/welcome');
		
    }
	
    /**
    *index页面
    *
    *
    * */
     public function index()
    {
         $this->load->view('1goods1code/qr_recover');	
    }
	
	
	 public function active()
    {
         $this->load->view('1goods1code/qr_active');	
    }
	 /**
    *ajax获取数据
	查看功能
    *
    *
    * */
    public function ajax_data(){
        //获取分页第几页
        $page = $this->input->get_post("page"); 
        if($page <=0 ){
            $page = 1 ;
        }
        //数据分页
        $limit = 5;//每一页显示的数量
        $offset = ($page-1)*$limit;//偏移量

        $condition = array();
        $startNum = $this->input->get_post("startNum");
        if(!empty($startNum)){
            $condition['QR_No>='] = $startNum;
        }
		
        $endNum = $this->input->get_post("endNum");
        if(!empty($endNum)){
            $condition['QR_No<='] = $endNum;
        }
        
        $total = $this->qr_active_model->count_num($condition);      
        $page_string = $this->common_page->page_string($total, $limit, $page);
        //$list = $this->qr_active_model->get_list($condition,$limit,$offset);
        $list1 = $this->qr_active_model->search_data($condition, $limit, $offset);
		//PC::debug($list1);
		 foreach ($list1 as $k=>$v)
		  {
			  $QRInfo[$k]['QR_No'] = $v['QR_No'];
			  $QRInfo[$k]['QR_Active'] = $v['QR_Active'];
			  $QRInfo[$k]['QR_FWTime'] = $v['QR_FWTime'];
			  $itemInfo = $this->product_model->search_ItemID_Ref($v['QR_ItemID_Ref']);
			  $QRInfo[$k]['product_ItemNo'] = $itemInfo['product_ItemNo'];
			  $QRInfo[$k]['product_ItemName'] = $itemInfo['product_ItemName'];
			  $QRInfo[$k]['product_InspectionDate'] = $itemInfo['product_InspectionDate'];
			  $QRInfo[$k]['product_InspectionNo'] = $itemInfo['product_InspectionNo'];
			  $QRInfo[$k]['product_DeclarationDate'] = $itemInfo['product_DeclarationDate']; 
			  $QRInfo[$k]['product_DeclarationNo'] = $itemInfo['product_DeclarationNo'];
			  $origininfo = $this->origin_model->search_origininfo($itemInfo['product_CountryOfOrigin']);
			  $QRInfo[$k]['product_OriginName'] = $origininfo['product_OriginName'];
			  $portinfo = $this->port_model->search_portinfo($itemInfo['product_PortOfShipment']);			  
			  $QRInfo[$k]['product_PortName'] = $portinfo['product_PortName'];
			  $shopinfo = $this->shop_model->search_shopinfo($itemInfo['product_ShopID']);
			  $QRInfo[$k]['product_SellerName'] = $shopinfo['product_SellerName'];	
     	       if($QRInfo[$k]['QR_Active'] = ($v['QR_Active'] == 'Y' ) )   
			    {
				$QRInfo[$k]['QR_Active'] = '已激活';  
                }
              else
			   {
				$QRInfo[$k]['QR_Active'] = '未激活';
			   }
		  }		 
		//PC::debug($QRInfo);
        echo result_to_towf_new($QRInfo, 1, '成功', $page_string) ;
    }

	
	
   
	
	 /**
    *删除库位信息
    *
    *
    * */
     public function recover()
    { 
        $this->db->trans_start();
		 $startNum = $this->input->get_post("startNum");		 
         $endNum = $this->input->get_post("endNum");       
		$data = array(
			'QR_Active' => 'N',
			'QR_Count' => 0,
			'QR_FWTime' => NULL,
		   'QR_ItemID_Ref' => NULL		   
		       );
		for ($i=$startNum;$i<=$endNum;$i++) 
	{
		 $this->qradd_model->update($data,$i);						        
	}									   
	  $this->db->trans_complete();
		echo result_to_towf_new('1', 1, 'success', null);
    }

   
}
