<?php
/**
 *库位操作
 *
 *
 **/
class Search1 extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common_function');
        $this->load->helper('guid');
        $this->load->library("common_page");  
        $this->load->model('qradd_model');  
        $this->load->model('search1_model');		
        $this->load->library('session');
        $this->load->library('redpack');    
    }


	
    /**
    *index页面
    *
    *
    * */
     public function search()
    {
         $this->load->view('1goods1code/input_code1');
		
    }
	
	 public function search1()
    {
         $this->load->view('1goods1code/play');
		
    }
	
	 public function search2()
    {
         $this->load->view('1goods1code/accept_money');
		
    }
	
	 public function dosearch()
    {
       $openid = $this->input->get_post("openid"); 
       //$openid ="oyTynwxmY6Tqd3NDyaj70NX4JAXY";	   
	   $fwid = $this->input->get_post("fwid");
	   $list = $this->search1_model->get_list($fwid);
	   $total = $this->search1_model->search_openid($openid);
	    //PC::debug($list);
	   if(empty($total['Error_time']))
	  {
	   if(empty($list))
	   {	
        if($total['Error_count']<5)
		   {
			 $total['Error_count']++; 
             $data = array(
                        'Error_count'      =>$total['Error_count'],
                    );
		   $this->search1_model->update_openid($data,$openid); 
          echo result_to_towf_new('1', -1, '您输入的防伪码无效1', NULL); 
		  exit();		   
		   }	   
		else
		{
		 $data = array(
                        'Error_time'          =>date('Y-m-d H:i:s',time()),
                        'Error_count'      =>5,
                    );
		   $this->search1_model->update_openid($data,$openid); 
         echo result_to_towf_new('1', -1, '连续失败多次，请您1小时后再来输入防伪码1', NULL); 
		 exit(); 		   
		}
	   }
	   else 
	   {
		    $data = array(
                        'Error_time'          =>null,
                        'Error_count'      =>0,
                    );
		   $this->search1_model->update_openid($data,$openid); 
		   $result = $this->search1_model->get_search($fwid);
		   $value = substr($result['QR_No'],-1);   //返回字符串的一部分
		    //PC::debug($value);
		 if(!empty($list)&&!empty($result))
		 {	
           if($value == 9)
		   {
			  if($result['HB_TYPE']==0)
		     {
			  $var=$this->redpack->sendredpack($openid,$result['QR_Money']); //普通红包 
		     }
		     else	
		     {
			  $var=$this->redpack->sendgroupredpack($openid,$result['QR_Money'],$result['QR_Number']);//裂变红包
		     }   
		 	
			  if(!empty($var['mch_billno'])&&!empty($var['send_listid']))
			  {				
				 $data = array(
				 'QR_Receive'      =>'1',
                'SH_mch_billno'      =>$var['mch_billno'],	
				 'WX_send_listid'      =>$var['send_listid']				
				  );
				  $this->search1_model->update($data,$fwid);
				  //$this->load->view('1goods1code/play');//用户关注公众号跳转到领取成功页面
		      }
			 $num=$result['QR_Number']-1;
			 echo result_to_towf_new3('1', 1, 'success',null,$result['QR_Money'],$num); 
		   }
          else 	
		  {
			 echo result_to_towf_new('1', -1, '很抱歉，该商品没有红包！', NULL); 
		     exit();
		  }   			  
		   
		 } 
        else	
	    {
		   echo result_to_towf_new('1', 0, 'error', null);
	    }	 
	   }
	  }
	   else
	   {
		$subtract = $this->search1_model->search_num($total['Error_time']);
		if($subtract['a']>=1)
		{
		 $data = array(
            'Error_time'          =>null,
            'Error_count'      =>0,
            );
		  $this->search1_model->update_openid($data,$openid); 
		   $total1 = $this->search1_model->search_openid($openid);
		  if(empty($list))
	      {           
			 $total1['Error_count']++; 
             $data = array(
                        'Error_count'      =>$total1['Error_count'],
                    );
		   $this->search1_model->update_openid($data,$openid); 
          echo result_to_towf_new('1', -1, '您输入的防伪码无效2', NULL); 
		  exit();		   
	      }
	   else 
	   {
		   $result1 = $this->search1_model->get_search($fwid);
		   $value1 = substr($result1['QR_No'],-1);   //返回字符串的一部分
		 if(!empty($list)&&!empty($result1))
		 {
          if($value1 == 9)
		  {
			 if($result1['HB_TYPE']==0)
		   {
			  $var1=$this->redpack->sendredpack($openid,$result1['QR_Money']); //普通红包 
		   }
		  else	
		   {
			  $var1=$this->redpack->sendgroupredpack($openid,$result1['QR_Money'],$result1['QR_Number']);//裂变红包
		   }   
		 	
			  if(!empty($var1['mch_billno'])&&!empty($var1['send_listid']))
			  {				
				 $data = array(
				 'QR_Receive'      =>'1',
                'SH_mch_billno'      =>$var1['mch_billno'],	
				 'WX_send_listid'      =>$var1['send_listid']				
				  );
				  $this->search1_model->update($data,$fwid);
				  //$this->load->view('1goods1code/play');//用户关注公众号跳转到领取成功页面
		      }
			$num=$result1['QR_Number']-1;
			 echo result_to_towf_new3('1', 1, 'success',null,$result1['QR_Money'],$num);  
		  }
		 else 
		 {
			 echo result_to_towf_new('1', -1, '很抱歉，该商品没有红包！', NULL); 
		     exit();
		 }		  
		  
		} 
       else	
	   {
		   echo result_to_towf_new('1', 0, 'error', null);		 
	   }	 
	   }
	 }
	 else
		{
		 echo result_to_towf_new('1', -1, '连续失败多次，请您1小时后再来输入防伪码3', NULL); 
		 exit(); 
		}
	}
   }


    /*
	function sendgroupredpack()
	{
		$mch_billno = '1417986702'.date("YmdHis",time()).rand(1000,9999);//商户订单号
		$mch_id = '1417986702';//微信支付分配的商户号
		$wxappid = 'wxd3e30b0c1f79a434';//公众账号appid
		$send_name = "中浩信息科技";//商户名称
		$re_openid = "oyTynw89Gf5ZLL8EbTfXnZH-Ij6c"; //用户openid
		$total_amount = "300";                              //付款金额，单位分
		$total_num = 3;                                          //红包发放总人数
		$amt_type = "ALL_RAND";                      //红包金额设置方式 ALL_RAND—全部随机,商户指定总金额和红包发放总人数，由微信支付随机计算出各红包金额
		$wishing = "恭喜发财";                             //红包祝福语
		$act_name = "关注有礼";                         //活动名称
		$remark = "测试";                                      //备注
		$apikey = "WdrxUZ5e4VDd4YQSKcCZoxHWXxdd24Uo";   // key 商户后台设置的  微信商户平台(pay.weixin.qq.com)-->账户设置-->API安全-->密钥设置
		$nonce_str =  md5(rand());                                  //随机字符串，不长于32位
		$m_arr = array (
			'mch_billno' => $mch_billno,
			'mch_id' => $mch_id,
			'wxappid' => $wxappid,
			'send_name' => $send_name,
			're_openid' => $re_openid,
			'total_amount' => $total_amount,
			'total_num' => $total_num,
			'amt_type' => $amt_type,
			'wishing' => $wishing,
			'act_name' => $act_name,
			'remark' => $remark,
			'nonce_str'=> $nonce_str
		);
		array_filter ( $m_arr ); // 清空参数为空的数组元素
		ksort ( $m_arr ); // 按照参数名ASCII码从小到大排序
		$stringA = "";
		foreach ( $m_arr as $key => $row ) {
			$stringA .= "&" . $key . '=' . $row;
		}
		$stringA = substr ( $stringA, 1 );
		// 拼接API密钥：
		$stringSignTemp = $stringA."&key=" . $apikey;
		$sign = strtoupper ( md5 ( $stringSignTemp ) );         //签名
		$textTpl = '<xml>
							<sign><![CDATA[%s]]></sign>
							<mch_billno><![CDATA[%s]]></mch_billno>
							<mch_id><![CDATA[%s]]></mch_id>
							<wxappid><![CDATA[%s]]></wxappid>
							<send_name><![CDATA[%s]]></send_name>
							<re_openid><![CDATA[%s]]></re_openid>
							<total_amount><![CDATA[%s]]></total_amount>
							<amt_type><![CDATA[%s]]></amt_type>
							<total_num><![CDATA[%s]]></total_num>
							<wishing><![CDATA[%s]]></wishing>
							<act_name><![CDATA[%s]]></act_name>
							<remark><![CDATA[%s]]></remark>
							<nonce_str><![CDATA[%s]]></nonce_str>
							</xml>';
		$resultStr = sprintf($textTpl, $sign, $mch_billno, $mch_id, $wxappid, $send_name,$re_openid,$total_amount,$amt_type,$total_num,$wishing,$act_name,$remark,$nonce_str);
		$url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendgroupredpack";
		return $this->curl_post_ssl($url, $resultStr);
	}
	function curl_post_ssl($url, $vars, $second=30,$aHeader=array())
	{
		$ch = curl_init();
		//超时时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		//这里设置代理，如果有的话
		//curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
		//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		//以下两种方式需选择一种
		//第一种方法，cert 与 key 分别属于两个.pem文件
		//默认格式为PEM，可以注释
		curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/apiclient_cert.pem');
		// 默认格式为PEM，可以注释
		curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'/apiclient_key.pem');
		//第二种方式，两个文件合成一个.pem文件
		//curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');
		if( count($aHeader) >= 1 ){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
		}
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
		$data = curl_exec($ch);
		//echo($data);

		$xml = simplexml_load_string($data);
		$send_listid = ((string)$xml->send_listid);
		$result_code = ((string)$xml->result_code);
		$return_code = ((string)$xml->return_code);
		//商户订单号
		$mch_billno = ((string)$xml->mch_billno);

		//if($return_code === 'SUCCESS'){return('发放成功');}

		if($result_code === 'SUCCESS' && $return_code === 'SUCCESS'){
			//微信单号
			//echo $send_listid;
			return($send_listid);
		}
		//else{//echo '发放失败';}

		//echo($data);
//
//			if($data){
//				curl_close($ch);
//				return $data;
//			}
//			else{
//				$error = curl_errno($ch);
//				echo "call faild, errorCode:$error\n";
//				curl_close($ch);
//				return false;
//			}
	}
	*/
	
}
