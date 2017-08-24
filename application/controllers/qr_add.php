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
	

	/*10进制转换为62进制 */		
function from10_to62($num) {
    $to = 62;
    $dict = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $ret = '';
	
    do {
        $ret = $dict[bcmod($num, $to)].$ret;
        $num = bcdiv($num, $to);
    } while ($num > 0);
    return $ret;
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
		$char=array( 
			"0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", 
			"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", 
			"w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", 
			"H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", 
			"S", "T", "U", "V", "W", "X", "Y", "Z", 
		  );   
	  $charLen = count($char) - 1;
     $MAXid =$this->qradd_model->selectCount();
      for ($j=$MAXid+1;$j<=($MAXid+$qr_num);$j++)
	{  
	   if($j<62)
	  {
		  $var= $this->from10_to62($j);	
          //PC::debug($var);		  
		  //$var= base_convert($j,10,36);
		  $transform="000".$var;
	  }
	  else if($j>=62&&$j<3844)
	  {
		  $var= $this->from10_to62($j);
		  //PC::debug($var);
		  $transform="00".$var;
	  }
	  else if($j>=3844&&$j<238328)
	  {
		  $var= $this->from10_to62($j);
		  //PC::debug($var);
		  $transform="0".$var;
	  }
	  else if($j>=238328)
	  {
		  $var= $this->from10_to62($j);
		  $transform=$var;
	  } 
	  	$numToChar = array(
				'1'=>'arr_1',
				'2'=>'arr_2',
				'3'=>'arr_3',
				'4'=>'arr_4',
				'5'=>'arr_5',
				'6'=>'arr_6',
				'7'=>'arr_7',
				'8'=>'arr_8',
				'9'=>'arr_9',
				'0'=>'arr_0',
				'a'=>'arr_a',
				'b'=>'arr_b',
				'c'=>'arr_c',
				'd'=>'arr_d',
				'e'=>'arr_e',
				'f'=>'arr_f',
				'g'=>'arr_g',
				'h'=>'arr_h',
				'i'=>'arr_i',
				'j'=>'arr_j',
				'k'=>'arr_k',
				'l'=>'arr_l',
				'm'=>'arr_m',
				'n'=>'arr_n',
				'o'=>'arr_o',
				'p'=>'arr_p',
				'q'=>'arr_q',
				'r'=>'arr_r',
				's'=>'arr_s',
				't'=>'arr_t',
				'u'=>'arr_u',
				'v'=>'arr_v',
				'w'=>'arr_w',
				'x'=>'arr_x',
				'y'=>'arr_y',
				'z'=>'arr_z',
                'A'=>'brr_A',
				'B'=>'brr_B',
				'C'=>'brr_C',
				'D'=>'brr_D',
				'E'=>'brr_E',
				'F'=>'brr_F',
				'G'=>'brr_G',
				'H'=>'brr_H',
				'I'=>'brr_I',
				'J'=>'brr_J',
				'K'=>'brr_K',
				'L'=>'brr_L',
				'M'=>'brr_M',
				'N'=>'brr_N',
				'O'=>'brr_O',
				'P'=>'brr_P',
				'Q'=>'brr_Q',
				'R'=>'brr_R',
				'S'=>'brr_S',
				'T'=>'brr_T',
				'U'=>'brr_U',
				'V'=>'brr_V',
				'W'=>'brr_W',
				'X'=>'brr_X',
				'Y'=>'brr_Y',
				'Z'=>'brr_Z'				
			);
		$charToNum = array(
				'arr_1'=>'4',
				'arr_2'=>'7',
				'arr_3'=>'2',
				'arr_4'=>'9',
				'arr_5'=>'3',
				'arr_6'=>'1',
				'arr_7'=>'6',
				'arr_8'=>'0',
				'arr_9'=>'8',
				'arr_0'=>'5',				
				'arr_a'=>'H',
				'arr_b'=>'Z',
				'arr_c'=>'O',
				'arr_d'=>'V',
				'arr_e'=>'A',
				'arr_f'=>'X',
				'arr_g'=>'U',
				'arr_h'=>'P',
				'arr_i'=>'R',
				'arr_j'=>'B',
				'arr_k'=>'D',
				'arr_l'=>'Y',
				'arr_m'=>'Q',
				'arr_n'=>'T',
				'arr_o'=>'C',
				'arr_p'=>'W',
				'arr_q'=>'E',
				'arr_r'=>'L',
				'arr_s'=>'G',
				'arr_t'=>'J',
				'arr_u'=>'M',
				'arr_v'=>'F',
				'arr_w'=>'N',
				'arr_x'=>'S',
				'arr_y'=>'I',
				'arr_z'=>'K',
				'brr_A'=>'h',
				'brr_B'=>'z',
				'brr_C'=>'o',
				'brr_D'=>'v',
				'brr_E'=>'a',
				'brr_F'=>'x',
				'brr_G'=>'u',
				'brr_H'=>'p',
				'brr_I'=>'r',
				'brr_J'=>'b',
				'brr_K'=>'d',
				'brr_L'=>'y',
				'brr_M'=>'q',
				'brr_N'=>'t',
				'brr_O'=>'c',
				'brr_P'=>'w',
				'brr_Q'=>'e',
				'brr_R'=>'l',
				'brr_S'=>'g',
				'brr_T'=>'j',
				'brr_U'=>'m',
				'brr_V'=>'f',
				'brr_W'=>'n',
				'brr_X'=>'s',
				'brr_Y'=>'i',
				'brr_Z'=>'k'
			);
			
      $char_13 = strtr($transform,$numToChar);
      $rand = strtr($char_13,$charToNum);
	  $str=str_split($rand,1);
	  $randchar=mt_rand(0,$charLen);
	  //$randbigchar=mt_rand(0,$bigcharLen);
	  $charid = strtoupper(md5($transform.$randchar));
	  $randbigchar=substr($charid, 5, 1);
	  //$wait=$bigchar[$randbigchar].$rand.$char[$randchar];
	  //$fwid=$str[3].$str[0].$bigchar[$randbigchar].$str[1].$char[$randchar].$str[2];
	  $fwid=$randbigchar.$str[3].$str[1].$char[$randchar].$str[2].$str[0];
      $encrypt=$sc->encrypt($j);	
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
		//PC::debug($data);
		 $this->qradd_model->insert($data);
		$_SESSION["qrNum"][$j] =$j;
		 //PC::debug($_SESSION["qrNum"][$j]);
	}	 

     $size = count($_SESSION["qrNum"]);
	 $num="成功生成".$size."个二维码";
	 $section="生成的号段为：".$_SESSION["qrNum"][$MAXid+1]."--".$_SESSION["qrNum"][$j-1];
     $this->db->trans_complete();
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
