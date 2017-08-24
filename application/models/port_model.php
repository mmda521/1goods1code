<?php
/**
 *库位模型
 *
 *
 **/

class Port_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}
		
		
		/**
		 *导出的数据
		 *
		 *
		 * */
		public function export_data($where = ''){
       		$query = $this->db->select('*')->from('con_freightlot')->where($where)->get();
       		$total = $query->result_array();
       		return $total;

		}
		
		/**
		 *总行数
		 *
		 *
		 * */
		public function count_num($where = ''){
       		$query = $this->db->select('count(*)')->from('product_portinfo')->where($where)->get();
       		$total = $query->row_array();
       		return $total['count(*)'];

		}

		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function get_list($where = '', $limit = '', $offset = ''){
        	$query = $this->db->select('*')->from('product_portinfo')->where($where)->limit($limit,$offset)->get();
            $list = $query->result_array();
            return $list;
    	}

		
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function get_list_row($where = ''){
        	$query = $this->db->select('*')->from('product_portinfo')->where($where)->get();
            $list = $query->row_array();
            return $list;
    	}
		
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function search_portinfo($where = ''){
        	$query = $this->db->select('*')->from('product_portinfo')->where_in('product_PortID',$where)->get();
            $list = $query->row_array();
            return $list;
    	}
		
		/**
		 *获取检索号
		 *
		 *
		 * */
		public function get_index_no($where = '', $limit = '', $offset = ''){
        	//SELECT username FROM `{$this->table_}common_user` where username = '{$username}' limit 1 
        	$query = $this->db->select('index_no')->from('product_portinfo')->where($where)->limit('1')->get();
    		$list = $query->result_array();
    		return $list;
    	}

		/**
		 *插入数据
		 *
		 *
		 * */
		public function insert($data = ''){
        	$this->db->insert('product_portinfo', $data);	
    		
    		//$list = $query->result_array();
    		//return $list;
    		return 'ok';
    	}

		
		
		
		/**
		 *更新数据
		 *
		 *
		 * */
           public function update($data = '',$product_PortID){
			$this->db->where('product_PortID', $product_PortID); 
        	$this->db->update('product_portinfo', $data);	 
    		return 'ok';
    	}
		/**
		 *删除数据
		 *
		 *
		 * */
		public function delete($product_PortID){
            $this->db->where_in('product_PortID',$product_PortID)->delete('product_portinfo');    		
    		return 'ok';
		}

}

