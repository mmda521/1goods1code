<?php
class Control extends CI_Controller {

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
        $this->load->model('crontab_model');
    }



public function index()
{
    $this->load->view('1goods1code/click','');
}



}
