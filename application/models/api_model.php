<?php
/**
 *样例
 *
 *
 **/

class Api_model extends CI_Model {

		public function __construct(){
			$this->load->database();

		}

		/**
		 *插入数据
		 *
		 *
		 * */
		public function insert($data = ''){
        	$this->db->insert('user_info', $data);
    		
    		//$list = $query->result_array();
    		//return $list;
    		return 'ok';
    	}
	/**
	 *获取数据列表
	 *
	 *
	 * */
	public function get_list($where = ''){
		$query = $this->db->select('*')->from('user_info')->where($where)->get();
		$list = $query->result_array();
		return $list;
	}
	/**
	 *更新数据
	 *
	 *
	 * */
	public function update($data = '',$openid){
		$this->db->where('openid', $openid);
		$this->db->update('user_info', $data);
		//$this->db->update('con_freightlot', $data,"GUID=$GUID");
		//$list = $query->result_array();
		//return $list;
		return 'ok';
	}
}

