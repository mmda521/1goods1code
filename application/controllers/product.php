<?php
/**
 *库位操作
 *
 *
 **/
class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common_function');
        $this->load->library("common_page");  
        $this->load->model('product_model');      
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
         $this->load->view('1goods1code/product', '');
		
    }
	
	
	
	
	/*导出功能 */
	 public function ajax_data_export(){	  			
	 $condition = array();
		
		 //获取检索号
        $index_no = $this->input->get_post("index_no");
        if(!empty($index_no)){
            $condition['index_no'] = $index_no;
        }
		
        //获取库位号
        $goodssite_no = $this->input->get_post("goodssite_no");
        if(!empty($goodssite_no)){
            $condition['goodssite_no'] = $goodssite_no;
        }

        //启用状态
        $status = $this->input->get_post("status");
		 //PC::debug($status);
        if(in_array($status,array('Y','N',true))){
            $condition['status'] = $status; 
        }
        
        $total = $this->location_model->export_data($condition);      
	    foreach($total as $k=>$v){
            $total[$k]['STATUS'] = ($v['STATUS'] == 'Y' )?"启用":"停用";          
        }
      $this->load->library("phpexcel");//ci框架中引入excel类
	  $PHPExcel = new PHPExcel();	  
	  //$PHPExcel->getProperties()->setTitle("库位信息导出")->setDescription("备份数据");	 
      $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','检索号')
            ->setCellValue('B1','库位号')
            ->setCellValue('C1','库位说明')
            ->setCellValue('D1','操作人员')
			->setCellValue('E1','操作时间')
            ->setCellValue('F1','状态');			 
		   foreach($total as $k => $v){
             $num=$k+2;
             $PHPExcel->setActiveSheetIndex(0)
                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
                          ->setCellValue('A'.$num, $v['INDEX_NO'])    
                          ->setCellValue('B'.$num, $v['GOODSSITE_NO'])
                          ->setCellValue('C'.$num, $v['GOODSSITE_NOTE'])
						  ->setCellValue('D'.$num, $v['OPERUSER_ID'])    
                          ->setCellValue('E'.$num, $v['OPERDATE'])
                          ->setCellValue('F'.$num, $v['STATUS']);
            }			
			 $PHPExcel->getActiveSheet()->setTitle('库位信息导出-'.date('Y-m-d',time()));
			 //设置宽度
			 $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			//设置水平居中
			$PHPExcel->getActiveSheet()->getStyle('A1:F1000')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		   
           // $PHPExcel->setActiveSheetIndex(0);
			header('Pragma:public');
             header("Content-Type: application/vnd.ms-excel;charset=uft8");  
			  header("Content-Disposition:attachment; filename=FILE".date("YmdHis").".xlsx");  
			$objWriter = new PHPExcel_Writer_Excel2007($PHPExcel);	
            //$objWriter = new PHPExcel_Writer_Excel5($PHPExcel);
            $objWriter->save('php://output');	
    }

	
	/*下载模板 */
	 public function ajax_data_templet(){	  			
      $this->load->library("phpexcel");//ci框架中引入excel类
	  $PHPExcel = new PHPExcel();	  
	  //$PHPExcel->getProperties()->setTitle("库位信息导出")->setDescription("备份数据");	
      //设置当前的sheet	  
      $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','检索号')
            ->setCellValue('B1','库位号')
            ->setCellValue('C1','库位说明')
            ->setCellValue('D1','操作人员')
			->setCellValue('E1','操作时间')
            ->setCellValue('F1','状态')			 
		  	 ->setCellValue('A2',1)
            ->setCellValue('B2','c1')
            ->setCellValue('C2',65)
            ->setCellValue('D2',23)
			->setCellValue('E2','2015-09-15 15:33:58')
            ->setCellValue('F2','启用');
			//设置单元格的字体颜色
            $PHPExcel->getActiveSheet()->getStyle( 'A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
			$PHPExcel->getActiveSheet()->getStyle( 'B1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
            $PHPExcel->getActiveSheet()->getStyle( 'F1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
			//$objActSheet->getColumnDimension( 'E')->setWidth(30);
			 $PHPExcel->getActiveSheet()->setTitle('库位信息导出模板-'.date('Y-m-d',time()));         
			 //创建第二个工作表
            $msgWorkSheet = new PHPExcel_Worksheet($PHPExcel, 'take_care'); //创建一个工作表
            $PHPExcel->addSheet($msgWorkSheet); //插入工作表
            $PHPExcel->setActiveSheetIndex(1); //切换到新创建的工作表
			$PHPExcel->getActiveSheet()->mergeCells('A2:C3');
			$PHPExcel->getActiveSheet()->mergeCells('A4:C5');
			$PHPExcel->getActiveSheet()->mergeCells('A6:C7');
			$PHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A2','红色标示的字段不可以为空')
            ->setCellValue('A4','重量和价值必须为正数')
            ->setCellValue('A6','件数必须为正整数');
			$PHPExcel->getActiveSheet()->setTitle('库位信息导出注意事项');
			 header('Pragma:public');
             header("Content-Type: application/vnd.ms-excel;charset=uft8");  
			 header("Content-Disposition:attachment; filename=库位信息下载模板.xlsx");  
			$objWriter = new PHPExcel_Writer_Excel2007($PHPExcel);	
            //$objWriter = new PHPExcel_Writer_Excel5($PHPExcel);
            $objWriter->save('php://output');
			// $objPHPExcel->disconnectWorksheets();
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
        
		
		 
        $product_id = $this->input->get_post("product_id");
        if(!empty($product_id)){
            $condition['product_ItemNo'] = $product_id;
        }
		
        
        $product_name = $this->input->get_post("product_name");
        if(!empty($product_name)){
            $condition['product_ItemName'] = $product_name;
        }

       
        $total = $this->product_model->count_num($condition);      
        $page_string = $this->common_page->page_string($total, $limit, $page);
        $list = $this->product_model->get_list($condition,$limit,$offset);
        $list1 = $this->product_model->product_origininfo();
		$list2 = $this->product_model->product_portinfo();
		$list3 = $this->product_model->product_shopinfo();
		foreach($list1 as $k1=>$v1){
			   foreach($list as $k=>$v){
               if($list[$k]['product_CountryOfOrigin'] == $list1[$k1]['product_OriginID'])   
			    {
				$list[$k]['product_CountryOfOrigin'] = $list1[$k1]['product_OriginName'];}  
                }
              }
		foreach($list2 as $k2=>$v2){
			   foreach($list as $k=>$v){
               if($list[$k]['product_PortOfShipment'] == $list2[$k2]['product_PortID'])   
			    {
				$list[$k]['product_PortOfShipment'] = $list2[$k2]['product_PortName'];}  
                }
              }	
        foreach($list3 as $k3=>$v3){
			   foreach($list as $k=>$v){
               if($list[$k]['product_ShopID'] == $list3[$k3]['product_ShopID'])   
			    {
				$list[$k]['product_ShopID'] = $list3[$k3]['product_SellerName'];}  
                }
              }	  			  
		//PC::debug($list);
        echo result_to_towf_new($list, 1, '成功', $page_string) ;
    }

	
	
	 /**
    *新增页面
    *
    *
    * */
     public function add()
    {      
         $this->load->view('1goods1code/product_add');
    }

	    /**
    *添加处理
    *
    *
    * */
    public function doadd(){
		$condition = array();
        $product_id       = $this->input->get_post("product_id");
		 if(!empty($product_id)) {
            $condition['product_ItemNo'] = $product_id;
        }else {
            echo result_to_towf_new('1', 0, '商品编号不能为空', NULL);
            exit();
        }
        $product_name   = $this->input->get_post("product_name");
		 if(!empty($product_name)) {
            $condition['product_ItemName'] = $product_name;
        }else {
            echo result_to_towf_new('1', 0, '商品名称不能为空', NULL);
            exit();
        }
		$country    = $this->input->get_post("country");
		if(!empty($country)) {
            $condition['product_CountryOfOrigin'] = $country;
        }else {
            echo result_to_towf_new('1', 0, '原产地不能为空', NULL);
            exit();
        }
        $port = $this->input->get_post("port");
		if(!empty($port)) {
            $condition['product_PortOfShipment'] = $port;
        }else {
            echo result_to_towf_new('1', 0, '启运港不能为空', NULL);
            exit();
        }
        $bj_date         = $this->input->get_post("bj_date");
		if(!empty($bj_date)) {
            $condition['product_InspectionDate'] = $bj_date;
        }else {
            echo result_to_towf_new('1', 0, '报检日期不能为空', NULL);
            exit();
        }
		$bj_id    = $this->input->get_post("bj_id");
		if(!empty($bj_id)) {
            $condition['product_InspectionNo'] = $bj_id;
        }else {
            echo result_to_towf_new('1', 0, '报检单号不能为空', NULL);
            exit();
        }
        $bg_date = $this->input->get_post("bg_date");
		if(!empty($bg_date)) {
            $condition['product_DeclarationDate'] = $bg_date;
        }else {
            echo result_to_towf_new('1', 0, '报关日期不能为空', NULL);
            exit();
        }
        $bg_id         = $this->input->get_post("bg_id");
		if(!empty($bg_id)) {
            $condition['product_DeclarationNo'] = $bg_id;
        }else {
            echo result_to_towf_new('1', 0, '报关单号不能为空', NULL);
            exit();
        }
		$product_shop         = $this->input->get_post("product_shop");
		 if(!empty($product_shop)) {
            $condition['product_ShopID'] = $product_shop;
        }else {
            echo result_to_towf_new('1', 0, '进口商不能为空', NULL);
            exit();
        }


        //插入数据
        $data = array(
            'product_ItemNo'      =>$product_id,
            'product_ItemName'  =>$product_name,
			'product_CountryOfOrigin'   =>$country,			
            'product_PortOfShipment'=>$port,
            'product_InspectionDate'        =>$bj_date,
			'product_InspectionNo'      =>$bj_id,
            'product_DeclarationDate'  =>$bg_date,
			'product_DeclarationNo'   =>$bg_id,			
            'product_ShopID'=>$product_shop,
        );

        //echo $status;
        //break;
        $this->product_model->insert($data);
        //showmessage("添加库位成功","sample2/index",3,1);
        echo result_to_towf_new('1', 1, 'success', null);
    }
	
	
    /**
    *打开编辑
    *
    *
    * */
     public function edit()
    {
        $product_ItemID = $this->input->get_post("product_ItemID");		
		$condition = array();
        $condition['product_ItemID'] = $product_ItemID;
		//PC::debug($GUID);
		$list['info'] = $this->product_model->get_list_row($condition);  
     // PC::debug($list);	
	    $this->load->view('1goods1code/product_edit', $list);

    }
	
/**
    *处理编辑
    *
    *
    * */
     public function do_edit()
    {
		 $page = $this->input->get_post("page"); 
        if($page <=0 ){
            $page = 1 ;
        }
        //数据分页
        $limit = 5;//每一页显示的数量
        $offset = ($page-1)*$limit;//偏移量
        $product_ItemID = $this->input->get_post("product_ItemID");
		
        $product_id = $this->input->get_post("product_id");
		 if(!empty($product_id)) {
            $condition['product_ItemNo'] = $product_id;
        }else {
            echo result_to_towf_new('1', 0, '商品编号不能为空', NULL);
            exit();
        }
        $product_name = $this->input->get_post("product_name");
		 if(!empty($product_name)) {
            $condition['product_ItemName'] = $product_name;
        }else {
            echo result_to_towf_new('1', 0, '商品名称不能为空', NULL);
            exit();
        }
		$country = $this->input->get_post("country");
		if(!empty($country)) {
            $condition['product_CountryOfOrigin'] = $country;
        }else {
            echo result_to_towf_new('1', 0, '原产地不能为空', NULL);
            exit();
        }
        $port = $this->input->get_post("port");
		if(!empty($port)) {
            $condition['product_PortOfShipment'] = $port;
        }else {
            echo result_to_towf_new('1', 0, '启运港不能为空', NULL);
            exit();
        }
        $bj_date = $this->input->get_post("bj_date");
		if(!empty($bj_date)) {
            $condition['product_InspectionDate'] = $bj_date;
        }else {
            echo result_to_towf_new('1', 0, '报检日期不能为空', NULL);
            exit();
        }
		$bj_id = $this->input->get_post("bj_id");
		if(!empty($bj_id)) {
            $condition['product_InspectionNo'] = $bj_id;
        }else {
            echo result_to_towf_new('1', 0, '报检单号不能为空', NULL);
            exit();
        }
        $bg_date = $this->input->get_post("bg_date");
		if(!empty($bg_date)) {
            $condition['product_DeclarationDate'] = $bg_date;
        }else {
            echo result_to_towf_new('1', 0, '报关日期不能为空', NULL);
            exit();
        }
        $bg_id = $this->input->get_post("bg_id");
		if(!empty($bg_id)) {
            $condition['product_DeclarationNo'] = $bg_id;
        }else {
            echo result_to_towf_new('1', 0, '报关单号不能为空', NULL);
            exit();
        }
		$product_shop = $this->input->get_post("product_shop");
		 if(!empty($product_shop)) {
            $condition['product_ShopID'] = $product_shop;
        }else {
            echo result_to_towf_new('1', 0, '进口商不能为空', NULL);
            exit();
        }
         //编辑数据
        $data = array(
		    'product_ItemID'      =>$product_ItemID,
            'product_ItemNo'      =>$product_id,
            'product_ItemName'  =>$product_name,
			'product_CountryOfOrigin'   =>$country,			
            'product_PortOfShipment'=>$port,
            'product_InspectionDate'        =>$bj_date,
			'product_InspectionNo'      =>$bj_id,
            'product_DeclarationDate'  =>$bg_date,
			'product_DeclarationNo'   =>$bg_id,			
            'product_ShopID'=>$product_shop,
        );		
       $this->product_model->update($data,$product_ItemID);
	    echo result_to_towf_new('1', 1, 'success', null);
    }

	
	 /**
    *删除信息
    *
    *
    * */
     public function delete()
    { 
         $product_ItemID = $this->input->get_post("product_ItemID");
		 //PC::debug($GUID);
      if ($product_ItemID) {
            $this->product_model->delete($product_ItemID);
           
        }
		echo result_to_towf_new('1', 1, 'success', null);
    }

   
}
