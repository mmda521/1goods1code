<?php
/**
 *库位操作
 *
 *
 **/
class QR_add extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common_function');
        $this->load->helper('guid');
        $this->load->library("common_page");  
        $this->load->model('qradd_model');      
        $this->load->library('session');    
    }


	
    /**
    *index页面
    *
    *
    * */
     public function index()
    {
         $this->load->view('1goods1code/QR_Add','');
		
    }
	
	 public function export()
    {
         $this->load->view('1goods1code/QR_Export','');
		
    }
		
	/*导出功能 */
	 public function data_export(){	  			
	 $condition = array();
		
		 
        $startNo = $this->input->get_post("startNo");
        if(!empty($startNo)){
            $condition['QR_No>='] = $startNo;
        }
		
        
        $endNo = $this->input->get_post("endNo");
        if(!empty($endNo)){
            $condition['QR_No<='] = $endNo;
        }
        $total = $this->qradd_model->export_data($condition);      
	    foreach($total as $k=>$v){
            $total[$k]['QR_TYPE'] = ($v['QR_TYPE'] == '0' )?"方形码":"圆形码";          
        }
      $this->load->library("phpexcel");//ci框架中引入excel类
	  $PHPExcel = new PHPExcel();	  
	  //$PHPExcel->getProperties()->setTitle("库位信息导出")->setDescription("备份数据");	 
      $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','序列号')
            ->setCellValue('B1','防伪码')
            ->setCellValue('C1','防伪形状');			 
		   foreach($total as $k => $v){
             $num=$k+2;
             $PHPExcel->setActiveSheetIndex(0)
                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
                          ->setCellValue('A'.$num, $v['QR_No'])    
                          ->setCellValue('B'.$num, " ".$v['QR_FWID'])
                          ->setCellValue('C'.$num, $v['QR_TYPE']);
            }			
			 $PHPExcel->getActiveSheet()->setTitle('二维码信息导出-'.date('Y-m-d',time()));
			 //设置宽度
			 $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
			 $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			//设置水平居中
			$PHPExcel->getActiveSheet()->getStyle('A1:C1000')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		   
           // $PHPExcel->setActiveSheetIndex(0);
			header('Pragma:public');
             header("Content-Type: application/vnd.ms-excel;charset=uft8");  
			  header("Content-Disposition:attachment; filename=FILE".date("YmdHis").".xlsx");  
			$objWriter = new PHPExcel_Writer_Excel2007($PHPExcel);	
            //$objWriter = new PHPExcel_Writer_Excel5($PHPExcel);
            $objWriter->save('php://output');	
    } 
	

	
	 
    public function create(){

		$qr_num = $this->input->get_post("qr_num");
		 if(empty($qr_num)) {
           echo result_to_towf_new('1', 0, '二维码生成数量不能为空', NULL);
            exit();
        }
        $qrtype = $this->input->get_post("qrtype");
		//PC::debug($qrtype);
		 if(empty($qrtype)) {
           echo result_to_towf_new('1', 0, '二维码类型不能为空', NULL);
            exit();
        }
		$money = $this->input->get_post("money");	
     if(empty($money)) {
           echo result_to_towf_new('1', 0, '红包金额不能为空', NULL);
            exit();
        }	
	
		$hb_type = $this->input->get_post("hb_type");
		 if(empty($hb_type)) {
           echo result_to_towf_new('1', 0, '红包类型不能为空', NULL);
            exit();
        }
        $num = $this->input->get_post("num");
		if($hb_type==2&&empty($num)) {
           echo result_to_towf_new('1', 0, '领取红包人数不能为空', NULL);
            exit();
        }	
		$scene_id = $this->input->get_post("scene_id");
		
		 if($hb_type==1&&($money>20000||$money<100)) {
           echo result_to_towf_new('1', 0, '普通红包金额必须大于1元，小于200元', NULL);
            exit();
        }	
		
		 if($hb_type==2&&($money>100000||$money<100)) {
           echo result_to_towf_new('1', 0, '裂变红包金额必须大于1元，小于1000元', NULL);
            exit();
        }
		 if($hb_type==2&&($money/$num)<100) {
           echo result_to_towf_new('1', 0, '平均每个红包不能小于1元', NULL);
            exit();
        }	
		 if($hb_type==1&&$money>200&&empty($scene_id)) {
           echo result_to_towf_new('1', 0, '金额大于2元时，请添加场景id', NULL);
            exit();
        }
		$sc=new SysCrypt('zhonghaoxinxidanpinpici');
        $this->db->trans_start();
		$_SESSION["qrNum"] = array();
		 $MAXid =$this->qradd_model->selectCount();
		 //$MAXid=$this->db->insert_id();
		 
        for ($i=0;$i<$qr_num;$i++){ 
		$num_13 =  mt_rand(10,99)
				  . substr(sprintf('%010d',time() - 946656000),5)
				  .mt_rand(0,9)
				  . sprintf('%03d', (float) microtime() * 1000)
				  //. sprintf('%01d', (int) $i % 10)
				  .mt_rand(10,99);
		$numToChar = array(
				'1'=>'a',
				'2'=>'b',
				'3'=>'c',
				'4'=>'d',
				'5'=>'e',
				'6'=>'f',
				'7'=>'g',
				'8'=>'h',
				'9'=>'i',
				'0'=>'j'
			);
		$charToNum = array(
				'a'=>'4',
				'b'=>'3',
				'c'=>'2',
				'd'=>'9',
				'e'=>'7',
				'f'=>'1',
				'g'=>'6',
				'h'=>'0',
				'i'=>'5',
				'j'=>'8',
			);
    $char_13 = strtr($num_13,$numToChar);
    $fwid = strtr($char_13,$charToNum);
	 $qr_no = (string)($MAXid + $i + 1);
	 $encrypt=$sc->encrypt($qr_no);	
	 $qr_url = "http://bn15897782.imwork.net/1goods1code/index.php?qr_no=".$encrypt;
	 $data = array(
            'QR_FWID'      =>$fwid,
            'QR_TYPE'      =>$qrtype,
			'QR_URL'      =>$qr_url,
			'QR_Money'      =>$money,
            'QR_Number'      =>$num,
			'QR_Scene_id'      =>$scene_id,
			'HB_TYPE'      =>$hb_type,
        );
    $this->qradd_model->insert($data);
    $_SESSION["qrNum"][$i] = $this->db->insert_id();
  }
   $size = count($_SESSION["qrNum"]);
   $num="成功生成".$size."个二维码";
    $section="生成的号段为：".$_SESSION["qrNum"][0]."--".$_SESSION["qrNum"][$size-1];
	// PC::debug($num);
    $this->db->trans_complete();
   
		//PC::debug($list);
	echo result_to_towf_new2('1', 1, 'success', null,$num,$section);
    }
	 
}
class SysCrypt{
 private $crypt_key='zhonghaoxinxidanpinpici';//密钥
 public function __construct($crypt_key){
  $this->crypt_key=$crypt_key;
 }
 public function encrypt($txt){
  srand((double)microtime()*1000000);
  $encrypt_key=md5(rand(0,32000));
  $ctr=0;
  $tmp='';
  for($i=0;$i<strlen($txt);$i++){
   $ctr=$ctr==strlen($encrypt_key)?0:$ctr;
   $tmp.=$encrypt_key[$ctr].($txt[$i]^$encrypt_key[$ctr++]);
  }
  return base64_encode(self::__key($tmp,$this->crypt_key));
 }
 public function decrypt($txt){
  $txt=self::__key(base64_decode($txt),$this->crypt_key);
  $tmp='';
  for($i=0;$i<strlen($txt);$i++){
   $md5=$txt[$i];
   $tmp.=$txt[++$i]^$md5;
  }
  return $tmp;
 }
 private function __key($txt,$encrypt_key){
  $encrypt_key=md5($encrypt_key);
  $ctr=0;
  $tmp='';
  for($i=0;$i<strlen($txt);$i++){
   $ctr=$ctr==strlen($encrypt_key)?0:$ctr;
   $tmp.=$txt[$i]^$encrypt_key[$ctr++];
  }
  return $tmp;
 }
 public function __destruct(){
  $this->crypt_key=NULL;
 }
}
