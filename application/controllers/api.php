<?php
include "CI_Wechat.php";
class Api extends CI_Controller {

  //  private $i=1;
    // public function index()
    // {
    //     echo 'Hello World!';
    // }

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('TDC_Model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('common_function');
        $this->load->helper('guid');
        $this->load->library("common_page");
        //$this->load->model('M_common','',false , array('type'=>'real_data'));
        $this->load->model('api_model');
        $this->load->model('crontab_model');
       // $i=1;
    }

    public function index()
    {
       // $this->load->view('1goods1code/input','');
        $appid='wxd3e30b0c1f79a434';
        $appsecret='c56cc2c53f793b0c5bd5476876988c25';
      /*  $options = array(
        'token'=>'wqofpad23gcvsdm3zcs3vgy30cujzjva', //填写你设定的key
        'encodingaeskey'=>'encodingaeskey' //填写加密用的EncodingAESKey，如接口为明文模式可忽略
    );
        $weObj = new Wechat($options);
        $weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
        $type = $weObj->getRev()->getRevType();
        $userid = $weObj->getRev()->getRevFrom();
        $ip = $weObj->generateNonceStr($length=16);
        switch($type) {
            case Wechat::MSGTYPE_TEXT:
                    //$weObj->text("hello, 测试连接上了")->reply();
                    $weObj->text($ip)->reply();
                    exit;
                    break;
            case Wechat::MSGTYPE_EVENT:
                    break;
            case Wechat::MSGTYPE_IMAGE:
                    break;
            default:
                    $weObj->text("help info")->reply();
        }*/
       

            $_SESSION['code']=$_GET['code'];
            //获取网页授权access_token
            $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$_SESSION['code']}&grant_type=authorization_code";

                $result=$this->cRUL($url);
                $jsoninfo = json_decode($result,true);
                if((!array_key_exists("access_token",$jsoninfo))||(!array_key_exists("openid",$jsoninfo))){
                $this->load->view('1goods1code/input_code','');
                }else{
                    $access_token = $jsoninfo["access_token"];
                    $openid=$jsoninfo["openid"];
                    $urll="https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
                    $result1=$this->cRUL($urll);
                    $jsoninfo1 = json_decode($result1,true);
                    $condition=array();
                    $condition = array(
                        'openid'          =>$jsoninfo1["openid"]
                    );
                    $data=array();
                    $openid=$jsoninfo1['openid'];//获取用户openid
                    $nickname=$jsoninfo1['nickname'];//获取用户昵称
                    $headimgurl=$jsoninfo1['headimgurl'];//获取用户头像
                    $time=time();
                    $data = array(
                        'openid'          =>$openid,
                        'nickname'      =>$nickname,
                        'headimgurl'   =>$headimgurl,
                        'datetime'     =>$time
                    );
                    $list=$this->api_model->get_list($condition);
                    if(!empty($list)){ //如果不为空，更新用户信息
                        $this->api_model->update($data,$openid);
                    }else{   //为空新增用户信息
                        $this->api_model->insert($data);
                    }
                    $this->subscribe($openid);
               }


            /*  echo $_GET['code'];
            var_dump($url);
            echo "<pre>";
            var_dump($result);
            echo "</pre>";
            */


            //获取用户信息

        


    }
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
    public function subscribe($openid){
        $condition=array();
        $condition=array(
            'access_id'   =>1
        );
        $list=$this->crontab_model->get_list($condition);
        foreach ($list as $key => $list1){
            $access_token1=$list1['access_token'];
        }
       $url2="https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token1}&openid={$openid}&lang=zh_CN";
        $result1=$this->cRUL($url2);
        $jsoninfo = json_decode($result1,true);
		
        $subscribe=$jsoninfo['subscribe'];
        if($subscribe==0){
           
            $this->load->view('1goods1code/qrcode_verify','');//用户没有关注跳转到二维码认证页面
        }
        if($subscribe==1){
			 $_SESSION['openid']=$openid;
            $this->load->view('1goods1code/input_code',$_SESSION['openid']);//用户关注公众号跳转到输入口令页面
        }
    }

}
