<?php
/**
 *库位模型
 *
 *
 **/

class Qradd_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}
		
		
		/**
		 *导出的数据
		 *
		 *
		 * */
		public function export_data($where = ''){
       		$query = $this->db->select('*')->from('master')->where($where)->get();
       		$total = $query->result_array();
       		return $total;

		}
		
		
		public function selectCount(){
       		$query = $this->db->select('max(QR_No)')->from('master')->get();
       		$total = $query->row_array();
       		return $total['max(QR_No)'];

		}

		/**
		 *插入数据
		 *
		 *
		 * */
		public function insert($data = ''){
        	$this->db->insert('master', $data);	
    		return 'ok';
    	}
		
		
		/**
		 *更新数据
		 *
		 *
		 * */
           public function update($data = '',$i){
			 $this->db->where('QR_No', $i); 
        	$this->db->update('master', $data);	 
    		return 'ok';
    	}
		/**
		 *删除数据
		 *
		 *
		 * */
		public function delete($GUID){
			//$this->db->where('GUID', $GUID);
            //$this->db->delete('con_freightlot');
			//$this->db->delete('con_freightlot', $data,"index_no=$index_no");	
            $this->db->where_in('GUID',$GUID)->delete('con_freightlot');    		
    		return 'ok';
		}

}

