<?php
/**
 *库位模型
 *
 *
 **/

class Product_model extends CI_Model {

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
       		$query = $this->db->select('count(*)')->from('product_info')->where($where)->get();
       		$total = $query->row_array();
       		return $total['count(*)'];

		}

		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function get_list($where = '', $limit = '', $offset = ''){
        	$query = $this->db->select('*')->from('product_info')->where($where)->order_by('product_AddTime','desc')->limit($limit,$offset)->get();
            $list = $query->result_array();
            return $list;
    	}

		
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function get_list_row($where = ''){
        	$query = $this->db->select('*')->from('product_info')->where($where)->get();
            $list = $query->row_array();
            return $list;
    	}
		
		
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function get_list_row_row($where = ''){
        	$query = $this->db->select('*')->from('product_info')->where_in('product_ItemID',$where)->get();
            $list = $query->row_array();
            return $list;
    	}
		

         public function product_productinfo($where = ''){
			 //PC::debug($where);
        //SELECT username FROM `{$this->table_}common_user` where username = '{$username}' limit 1
        $query = $this->db->select('*')->from('product_info')->where_in('product_ItemID',$where)->get();
        $list = $query->result_array();
		
        return $list;
        }
		
		 public function product_origininfo(){
        //SELECT username FROM `{$this->table_}common_user` where username = '{$username}' limit 1
        $query = $this->db->select('*')->from('product_origininfo')->get();
        $list = $query->result_array();
        return $list;
        }
		
		
		 public function product_portinfo(){
        //SELECT username FROM `{$this->table_}common_user` where username = '{$username}' limit 1
        $query = $this->db->select('*')->from('product_portinfo')->get();
        $list = $query->result_array();
        return $list;
        }
		
		public function product_shopinfo(){
        //SELECT username FROM `{$this->table_}common_user` where username = '{$username}' limit 1
        $query = $this->db->select('*')->from('product_shopinfo')->get();
        $list = $query->result_array();
        return $list;
        }
		
		
		
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function search_ItemID_Ref($where = ''){
        	$query = $this->db->select('*')->from('product_info')->where_in('product_ItemID',$where)->get();
            $list = $query->row_array();
            return $list;
    	}
		

		/**
		 *插入数据
		 *
		 *
		 * */
		public function insert($data = ''){
        	$this->db->insert('product_info', $data);	
    		
    		//$list = $query->result_array();
    		//return $list;
    		return 'ok';
    	}

		
		
		
		/**
		 *更新数据
		 *
		 *
		 * */
           public function update($data = '',$product_ItemID){
			$this->db->where('product_ItemID', $product_ItemID); 
        	$this->db->update('product_info', $data);	 
    		return 'ok';
    	}
		/**
		 *删除数据
		 *
		 *
		 * */
		public function delete($product_ItemID){
			//$this->db->where('GUID', $GUID);
            //$this->db->delete('con_freightlot');
            $this->db->where_in('product_ItemID',$product_ItemID)->delete('product_info');    		
    		return 'ok';
		}

}

