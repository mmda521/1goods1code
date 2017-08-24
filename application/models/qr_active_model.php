<?php
/**
 *库位模型
 *
 *
 **/

class Qr_active_model extends CI_Model {

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
       		$query = $this->db->select('count(*)')->from('master')->where($where)->where('QR_Active','Y')->order_by('QR_FWTime','desc')->get();
       		$total = $query->row_array();
       		return $total['count(*)'];

		}

		
	
		public function count_num_time($time1 = '',$time2 = ''){
           /*$sql="select count(*) from master where QR_Active='Y' and (date_format(QR_FWTime,'%Y-%m-%d')>='$time1' and date_format(QR_FWTime,'%Y-%m-%d')<='$time2') order by QR_FWTime desc";
			$query=$this->db->query($sql);
			$list = $query->row_array();
            return $list;*/
			$time1 =DATE($time1);
			$time2 =DATE($time2);
		    $query = $this->db->select('count(*)')->from('master')->where('QR_FWTime>=',$time1)->where('QR_FWTime<=',$time2)->where('QR_Active','Y')->order_by('QR_FWTime','desc')->get();
       		$total = $query->row_array();
       		return $total['count(*)'];
		}
		
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function search($where = '', $limit = '', $offset = ''){
        	$query = $this->db->select('*')->from('master')->where($where)->where('QR_Active','Y')->order_by('QR_FWTime','desc')->limit($limit,$offset)->get();
            $list = $query->result_array();
            return $list;
    	}

		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function search_data($where = '', $limit = '', $offset = ''){
			//PC::debug($where);
        	$query = $this->db->select('*')->from('master')->where($where)->where('QR_Active','Y')->limit($limit,$offset)->get();
            $list = $query->result_array();
            return $list;
    	}
		
		
		
		public function search_time($time2= '',$time3= '',$limit = '', $offset = ''){
        	$sql="select * from master where QR_Active='Y' and (date_format(QR_FWTime,'%Y-%m-%d')>='$time2' and date_format(QR_FWTime,'%Y-%m-%d')<='$time3')and  order by QR_FWTime desc limit $limit,$offset";
			$query=$this->db->query($sql);
			$list = $query->result_array();
            return $list;
    	}
		/**
		 *获取数据列表
		 *
		 *
		 * */
		public function search_all($where = '', $limit = '', $offset = ''){
			//PC::debug($where);
        	$query = $this->db->select('*')->from('master')->where($where)->limit($limit,$offset)->get();
            $list = $query->result_array();
            return $list;
    	}
		/**
		 *导出的数据
		 *
		 *
		 * */
		public function master_data($where = ''){
       		$query = $this->db->select('*')->from('master')->where_in('QR_No',$where)->get();
       		$total = $query->row_array();
       		return $total;

		}		

}

