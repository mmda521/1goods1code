<?php
/**
 *样例
 *
 *
 **/

class Crontab_model extends CI_Model {

		public function __construct(){
			$this->load->database();

		}

		

		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function get_list($where = ''){
        	$query = $this->db->select('*')->from('access_token')->where($where)->get();
            $list = $query->result_array();
            return $list;
    	}

		/**
		 *插入数据
		 *
		 *
		 * */
		public function insert($data = ''){
        	$this->db->insert('access_token', $data);
    		
    		//$list = $query->result_array();
    		//return $list;
    		return 'ok';
    	}
		/**
	 	*更新数据
		 *
		 *
	 	* */
		public function update($data = '',$GUID){
			$this->db->where('access_id', $GUID);
			$this->db->update('access_token', $data);
			//$this->db->update('con_freightlot', $data,"GUID=$GUID");
			//$list = $query->result_array();
			//return $list;
			return 'ok';
		}

	

}

