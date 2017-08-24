<?php


class Gethbinfo extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library('redpack');
		$this->load->database();
		$this->load->model('hb_model');
    }
	
	public function hbinfo()
    {
		$master_list = $this->hb_model->get_master_list();
		foreach($master_list as $master){
			$mch_billno = $master['SH_mch_billno'];
			//print($mch_billno);
			if(!empty($mch_billno)){
				//调用红包库函数
				$hb_info = $this->redpack->gethbinfo($mch_billno);
				$hblist = serialize($hb_info['hblist']);
				$hb_status = $hb_info['status'];
				switch ($hb_status)
				{
					case 'SENDING':
 						$QR_receive = '1';
  					break;
					case 'SENT':
  						$QR_receive = '2';
  					break;
					case 'FAILED':
  						$QR_receive = '3';
  					break;
					case 'RECEIVED':
  						$QR_receive = '4';
  					break;
					case 'RFUND_ING':
  						$QR_receive = '5';
  					break;
					case 'REFUND':
  						$QR_receive = '6';
  					break;
				}
				$hb_arr = array(
					'mch_billno'	=> $hb_info['mch_billno'],
					//'mch_id'		=> $hb_info['mch_id'],
					'detail_id'		=> $hb_info['detail_id'],
					'status'		=> $hb_status,
					'send_type'		=> $hb_info['send_type'],
					'hb_type'		=> $hb_info['hb_type'],
					//'total_num'		=> $hb_info['total_num'],
					'total_amount'	=> $hb_info['total_amount'],
					//'reson'			=> $hb_info['reson'],
					'send_time'		=> $hb_info['send_time'],
					'refund_time'	=> $hb_info['refund_time'],
					'refund_amount'	=> $hb_info['refund_amount'],
					'act_name'		=> $hb_info['act_name'],
					'hblist'		=> $hblist
				);
					$list=$this->hb_model->get_list($mch_billno);
                    		if(!empty($list)){ //更新信息
                        		$this->hb_model->update_hbinfo($hb_arr,$mch_billno);
                    		}else{   //新增信息
                        		$this->hb_model->insert($hb_arr);
                    		}
		
				$data = array(
                        		'QR_Receive'          => $QR_receive
                    		);
				$this->hb_model->update_master($data,$mch_billno);
			}
		}
    }	
}
?>