<?php
/**
 *例子
 *
 *
 **/
class Crontab extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common_function');
        $this->load->helper('guid');
        $this->load->library("common_page");  
        //$this->load->model('M_common','',false , array('type'=>'real_data'));
        $this->load->model('crontab_model');

        
    }

    /**
    *获取access_token
    *
    *
    * */
     public function get_access_token()
    {
       $appid='wxbdd20b2aff204324';
        $appsecret='453ac34c9a66e45ed6926e0f8f8f923b';
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret=$appsecret";
        $result=$this->cRUL($url);
        $jsoninfo = json_decode($result,true);
        $access_token = $jsoninfo["access_token"];
        $expires_in = $jsoninfo["expires_in"];
        $data=array();
        $data = array(
            'access_token'          =>$access_token,
            'expires_in'      =>$expires_in
        );
        $condition=array();
        $condition=array(
          'access_id'   =>1
        );
        $list=$this->crontab_model->get_list($condition);
        if(!empty($list)){  //如果不为空，则修改
            $this->crontab_model->update($data,$condition['access_id']);
        }
        /*echo "<pre>";
        var_dump($list);
        echo "</pre>";
        die;*/
      /* // $this->crontab_model->insert($data);
        echo "<pre>";
        var_dump($access_token);
        var_dump($expires_in);
        var_dump($list);
        //$list = $this->crontab_model->get_list();
        //var_dump($list);
        echo "</pre>";
        die;*/
        //$this->load->view('1goods1code/sample2', '');
    }

    /**
     *crul方法
     *
     *
     * */
    public function cRUL($url,$data=null){
        $ch = curl_init();  //初始化一个cURL对象；
        curl_setopt($ch,CURLOPT_URL,$url);  //设置需要抓取的URL
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
        if(!empty($data)){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。0是返回，1是不返回
        $output = curl_exec($ch);  //执行并获得结果
        curl_close($ch);  //  释放cURL句柄
        return $output;
    }

}
