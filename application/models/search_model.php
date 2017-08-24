<?php
/**
 *库位模型
 *
 *
 **/

class Search_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}
		
		
		/**
		 *查询数据
		 *
		 *
		 * */
		public function get_list($fwid = ''){
       		$query = $this->db->select('*')->from('master')->where('QR_FWID',$fwid)->get();
       		$total = $query->row_array();
       		return $total;
		}
		
		public function get_type($fwid = ''){
       		$query = $this->db->select('*')->from('master')->where('QR_Receive','0')->where('HB_TYPE','1')->where('QR_FWID',$fwid)->get();
       		$total = $query->row_array();
       		return $total;
		}
		
		public function get_search($fwid = ''){
       		$query = $this->db->select('*')->from('master')->where('QR_FWID',$fwid)->where('QR_Receive','0')->get();
       		$total = $query->row_array();
       		return $total;
		}
		
		public function search_num($time = ''){
       		$sql="select TIMESTAMPDIFF(HOUR,'$time',(select now())) as a;";
			$query=$this->db->query($sql);
			$list = $query->row_array();
            return $list;
		}
		
		public function search_openid($openid = ''){
       		$query = $this->db->select('*')->from('user_info')->where('openid',$openid)->get();
       		$total = $query->row_array();
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
           public function update($data = '',$fwid){
			 $this->db->where('QR_FWID', $fwid); 
        	$this->db->update('master', $data);	 
    		return 'ok';
    	}
		
		
		/**
		 *更新数据
		 *
		 *
		 * */
           public function update_openid($data = '',$openid){
			 $this->db->where('openid', $openid); 
        	$this->db->update('user_info', $data);	 
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

