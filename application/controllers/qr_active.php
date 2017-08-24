<?php
/**
 *库位操作
 *
 *
 **/
class Qr_active extends CI_Controller {

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
         $this->load->view('1goods1code/welcome', '');
		
    }
	
    /**
    *index页面
    *
    *
    * */
     public function index()
    {
         $this->load->view('1goods1code/qr_active_search');	
    }
	
	
	 /**
    *index页面
    *
    *
    * */
     public function qr_activeNo_search()
    {
         $this->load->view('1goods1code/qr_activeNo_search');	
    }
	
	 public function qr_activeTime_search()
    {
         $this->load->view('1goods1code/qr_activeTime_search');	
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
       if(empty($total)) {
            echo result_to_towf_new('1', 0, '找不到符合此条件的数据', NULL);
            exit();
        }			
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
		  /*  foreach($QRInfo as $k1=>$v1){
               if($QRInfo[$k]['QR_Active'] = ($v['QR_Active'] == 'Y' ) )   
			    {
				$QRInfo[$k]['QR_Active'] = '已激活';  
                }
              else
			   {
				$QRInfo[$k]['QR_Active'] = '未激活';
			   }
             }			 */   
		//PC::debug($QRInfo);
        echo result_to_towf_new($QRInfo, 1, '成功', $page_string) ;
    }

	
	
	 public function ajax_data_searchTime(){
        //获取分页第几页
        $page = $this->input->get_post("page"); 
        if($page <=0 ){
            $page = 1 ;
        }
        //数据分页
        $limit = 5;//每一页显示的数量
        $offset = ($page-1)*$limit;//偏移量

        $condition = array();
        $startTime = $this->input->get_post("startTime");
        if(!empty($startTime)){
            $condition['QR_FWTime>='] = $startTime;
        }
		
        $endTime = $this->input->get_post("endTime");
        if(!empty($endTime)){
            $condition['QR_FWTime<='] = $endTime;
        }
        //PC::debug($condition);
        $total = $this->qr_active_model->count_num($condition); 
		if(empty($total)) {
            echo result_to_towf_new('1', 0, '找不到符合此条件的数据', NULL);
            exit();
        }	
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
    *新增页面
    *
    *
    * */
     public function activeproduct()
    { 
        $product_ItemID = $this->input->get_post("product_ItemID");	
		//PC::debug($product_ItemID);
		$list['info'] = $this->product_model->get_list_row_row($product_ItemID);
		//PC::debug($list);
         $this->load->view('1goods1code/activeproduct',$list);
    }

	    /**
    *添加处理
    *
    *
    * */
    public function do_activeproduct(){
		$this->db->trans_start();	
		 $startNum = $this->input->get_post("startNum");
       if(empty($startNum)) {
            echo result_to_towf_new('1', 0, '起始号段不能为空', NULL);
            exit();
        }		 
		 $endNum = $this->input->get_post("endNum");
		 if(empty($endNum)) {
            echo result_to_towf_new('1', 0, '结束号段不能为空', NULL);
            exit();
        }	
         $itemName = $this->input->get_post("itemName");
         $arritemID = explode('^',$itemName);
		 $itemID = $arritemID[0];
		 $itemNo = $arritemID[1];
		 $itemName = $arritemID[2];
		 for ($i=$startNum;$i<=$endNum;$i++) 
		  {
		   $list1 = $this->qr_active_model->master_data($i);
		//PC::debug($list1);
			while( $list1['QR_Active']=='Y')
			 { 	
                echo result_to_towf_new('1', 0, '商品中已有激活的号段,请回收后再来激活', NULL);
                exit();
			  }  
							  
		  } 
						    
		 for ($i=$startNum;$i<=$endNum;$i++) 		  
		   {			   
			 $data = array(
			  'QR_ItemID_Ref' => $itemID,
			  'QR_Active' => 'Y',
			 // 'QR_FWTime' => date('y-m-d H:i:s',time())	 					  
				);
			 $this->qradd_model->update($data,$i);	
			//PC::debug($data);
			}	
		$this->db->trans_complete();										
        echo result_to_towf_new('1', 1, 'success', null);
    }
	
}