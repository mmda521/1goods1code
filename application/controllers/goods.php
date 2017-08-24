<?php
class Goods extends CI_Controller {

    // public function index()
    // {
    //     echo 'Hello World!';
    // }

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('TDC_Model');
        $this->load->library('session');
    }



public function view($page = 'view_login')
{
    if ( ! file_exists(APPPATH.'/views/1goods1code/'.$page.'.php'))
    {
        // Whoops, we don't have a page for that!
        show_404();
    }

    $data['title'] = ucfirst($page); // Capitalize the first letter
    $this->load->helper('url');
    //$this->load->view('templates/header', $data);
    if(isset($_SESSION['LOGIN_NO']) && $_SESSION['LOGIN_NO'] ){
        $this->load->view('1goods1code/' . $page, $data);
    }else {
        $this->load->view('1goods1code/view_login','');
        //$this->load->view('templates/footer', $data);
    }
}

public function error($page = 'view_login')
{
    show_404();
}

}
