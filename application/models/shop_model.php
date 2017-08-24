<?php
/**
 *库位模型
 *
 *
 **/

class Shop_model extends CI_Model {

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
       		$query = $this->db->select('count(*)')->from('product_shopinfo')->where($where)->get();
       		$total = $query->row_array();
       		return $total['count(*)'];

		}

		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function get_list($where = '', $limit = '', $offset = ''){
        	$query = $this->db->select('*')->from('product_shopinfo')->where($where)->order_by('product_ShopAddTime','desc')->limit($limit,$offset)->get();
            $list = $query->result_array();
            return $list;
    	}

		
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function get_list_row($where = ''){
        	$query = $this->db->select('*')->from('product_shopinfo')->where($where)->get();
            $list = $query->row_array();
            return $list;
    	}
		
		
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function search_shopinfo($where = ''){
        	$query = $this->db->select('*')->from('product_shopinfo')->where_in('product_ShopID',$where)->get();
            $list = $query->row_array();
            return $list;
    	}
		
				
		
		public function get_index_no($where = '', $limit = '', $offset = ''){
        	//SELECT username FROM `{$this->table_}common_user` where username = '{$username}' limit 1 
        	$query = $this->db->select('index_no')->from('con_freightlot')->where($where)->limit('1')->get();
    		$list = $query->result_array();
    		return $list;
    	}

		/**
		 *插入数据
		 *
		 *
		 * */
		public function insert($data = ''){
        	$this->db->insert('product_shopinfo', $data);	
    		
    		//$list = $query->result_array();
    		//return $list;
    		return 'ok';
    	}

		
		
		
		/**
		 *更新数据
		 *
		 *
		 * */
           public function update($data = '',$product_ShopID){
			$this->db->where('product_ShopID', $product_ShopID); 
        	$this->db->update('product_shopinfo', $data);	 
    		return 'ok';
    	}
		/**
		 *删除数据
		 *
		 *
		 * */
		public function delete($product_ShopID){
            $this->db->where_in('product_ShopID',$product_ShopID)->delete('product_shopinfo');    		
    		return 'ok';
		}

}

