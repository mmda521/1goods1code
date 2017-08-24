<?php
/**
 *库位操作
 *
 *
 **/
class Fflookfor extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common_function');
        $this->load->library("common_page");  
        $this->load->model('fflookfor_model');         
    }


	
    /**
    *index页面
    *
    *
    * */
     public function index()
    {
         $this->load->view('1goods1code/fflookfor');
		
    }
	
	 public function export()
    {
         $this->load->view('1goods1code/QR_Export','');
		
    }
		
	/*导出功能 */
	 public function data_export(){	  			
	 $condition = array();
		
		 
        $hb_tupe = $this->input->get_post("hb_tupe");
        if(!empty($hb_tupe)){
            $condition['hb_tupe'] = $hb_tupe;
        }
		
        
        $status = $this->input->get_post("status");
        if(!empty($status)){
            $condition['status'] = $status;
        }
        $list = $this->fflookfor_model->export_data($condition);      
	     foreach($list as $k=>$v)
		 {
            $list[$k]['hb_type'] = ($v['hb_type'] == 'GROUP' )?"裂变红包":"普通红包"; 
            if($list[$k]['status'] = ($v['status'] == 'SENDING' )  )   
			{$list[$k]['status']='发放中';}
		    else if($list[$k]['status'] = ($v['status'] == 'SENT' ) )
            {$list[$k]['status']='已发放待领取';}
		    else if($list[$k]['status'] = ($v['status'] == 'FALLED' ) )
            {$list[$k]['status']='发放失败';}
		    else if($list[$k]['status'] = ($v['status'] == 'RECEIVED' ) )
            {$list[$k]['status']='已领取';}
		    else if($list[$k]['status'] = ($v['status'] == 'RFUND_ING' ) )
            {$list[$k]['status']='退款中';}
		    else if($list[$k]['status'] = ($v['status'] == 'REFUND' ) )
            {$list[$k]['status']='已退款';}	
        }
      $this->load->library("phpexcel");//ci框架中引入excel类
	  $PHPExcel = new PHPExcel();	  
	  //$PHPExcel->getProperties()->setTitle("库位信息导出")->setDescription("备份数据");	 
      $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','商户订单号')
            ->setCellValue('B1','红包单号')
            ->setCellValue('C1','红包状态')
			->setCellValue('D1','发放类型')
            ->setCellValue('E1','红包类型')
            ->setCellValue('F1','红包金额')
			->setCellValue('G1','红包发送时间')
            ->setCellValue('H1','红包退款时间')
            ->setCellValue('I1','红包退款金额')
			->setCellValue('J1','活动名称');
           // ->setCellValue('K1','裂变红包领取列表');			 
		   foreach($list as $k => $v){
             $num=$k+2;
             $PHPExcel->setActiveSheetIndex(0)
                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
                          ->setCellValue('A'.$num, " ".$v['mch_billno'])    
                          ->setCellValue('B'.$num, " ".$v['detail_id'])
                          ->setCellValue('C'.$num, $v['status'])
						  ->setCellValue('D'.$num, $v['send_type'])    
                          ->setCellValue('E'.$num, $v['hb_type'])
                          ->setCellValue('F'.$num, $v['total_amount'])
						  ->setCellValue('G'.$num, $v['send_time'])    
                          ->setCellValue('H'.$num, $v['refund_time'])
                          ->setCellValue('I'.$num, $v['refund_amount'])
						  ->setCellValue('J'.$num, $v['act_name']);    
                         // ->setCellValue('K'.$num, " ".$v['hblist']);
            }			
			 $PHPExcel->getActiveSheet()->setTitle('红包发放情况导出-'.date('Y-m-d',time()));
			 //设置宽度
			 $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
			 $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
			 $PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			 $PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			 $PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			//设置水平居中
			$PHPExcel->getActiveSheet()->getStyle('A1:K1000')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		   
           // $PHPExcel->setActiveSheetIndex(0);
			header('Pragma:public');
             header("Content-Type: application/vnd.ms-excel;charset=uft8");  
			  header("Content-Disposition:attachment; filename=FILE".date("YmdHis").".xlsx");  
			$objWriter = new PHPExcel_Writer_Excel2007($PHPExcel);	
            //$objWriter = new PHPExcel_Writer_Excel5($PHPExcel);
            $objWriter->save('php://output');	
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
        
		
		 
        $hb_tupe = $this->input->get_post("hb_tupe");
        if(!empty($hb_tupe)){
            $condition['hb_tupe'] = $hb_tupe;
        }
		
        
        $status = $this->input->get_post("status");
        if(!empty($status)){
            $condition['status'] = $status;
        }

        
        $total = $this->fflookfor_model->count_num($condition);      
        $page_string = $this->common_page->page_string($total, $limit, $page);

        $list = $this->fflookfor_model->get_list($condition,$limit,$offset);
		
        foreach($list as $k=>$v){
            $list[$k]['hb_type'] = ($v['hb_type'] == 'GROUP' )?"裂变红包":"普通红包"; 
            if($list[$k]['status'] = ($v['status'] == 'SENDING' )  )   
			{$list[$k]['status']='发放中';}
		    else if($list[$k]['status'] = ($v['status'] == 'SENT' ) )
            {$list[$k]['status']='已发放待领取';}
		    else if($list[$k]['status'] = ($v['status'] == 'FALLED' ) )
            {$list[$k]['status']='发放失败';}
		    else if($list[$k]['status'] = ($v['status'] == 'RECEIVED' ) )
            {$list[$k]['status']='已领取';}
		    else if($list[$k]['status'] = ($v['status'] == 'RFUND_ING' ) )
            {$list[$k]['status']='退款中';}
		    else if($list[$k]['status'] = ($v['status'] == 'REFUND' ) )
            {$list[$k]['status']='已退款';}			
           $hblist=unserialize($list[$k]['hblist']);
		//PC::debug($hblist);
		  $list[$k]['list_list']="";
		  foreach($hblist as $k1=>$v1)
		  {
			//$list_amount[$k1]=$hblist[$k1]['amount'];
			//$list_openid[$k1]=$hblist[$k1]['openid'];
			//$list_rcv_time[$k1]=$hblist[$k1]['rcv_time'];
		    $list1[$k1]['list_list']="amount:".$hblist[$k1]['amount'].",openid:".$hblist[$k1]['openid'].",rcv_time:".$hblist[$k1]['rcv_time'].";</br>";
		    $list[$k]['list_list']=$list[$k]['list_list'].$list1[$k1]['list_list'];
		  }
		}
        echo result_to_towf_new($list, 1, '成功', $page_string) ;
    }
}
