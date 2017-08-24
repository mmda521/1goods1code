<?php
/**
 *样例
 *
 *
 **/

class Hb_model extends CI_Model {

		public function __construct(){
			$this->load->database();

		}

		/**
		 *插入数据
		 *
		 *
		 * */
		public function insert($data = ''){
        	$this->db->insert('rp_info', $data);
    		
    		//$list = $query->result_array();
    		//return $list;
    		//return 'ok';
    	}
	/**
	 *获取数据列表
	 *
	 *
	 * */
	public function get_list($where = ''){
		$query = $this->db->select('*')->from('rp_info')->where($where)->get();
		$list = $query->result_array();
		return $list;
	}
	/**
	 *获取数据列表
	 *
	 *
	 * */
	 public function get_master_list(){
		$query = $this->db->select('*')->from('master')->get();
		$list = $query->result_array();
		return $list;
	}
	/**
	 *更新数据
	 *
	 *
	 * */
	public function update_rp_info($data = '',$mch_billno){
		$this->db->where('mch_billno', $mch_billno);
		$this->db->update('rp_info', $data);
		//$this->db->update('con_freightlot', $data,"GUID=$GUID");
		//$list = $query->result_array();
		//return $list;
		//return 'ok';
	}
	
	//更新master表红包发放状态
	public function update_master($data = '',$mch_billno){
			 $this->db->where('SH_mch_billno', $mch_billno); 
        	$this->db->update('master', $data);
    		return 'ok';
    	}
}