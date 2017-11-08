<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 //session初始化
         $this->load->library('nativesession');
         $this->load->model('login_model');
	}
	public function index(){
		$this->load->view("admin/login_view");
	}
	/**
    * 登录页面
    */
    public function do_login()
    {
    	$username = $this->input->post("username",TRUE);
		$password = md5($this->input->post("password",TRUE));
    	$login_check = $this->login_model->login($username,$password);
    	if(!$login_check){
    		$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"账号密码错误,请重试"}');
    	}else{
    		$this->nativesession->set('admin_id',TRUE);
            $this->nativesession->set('admin_name',$username);
            $this->output->set_content_type('application/json');
			$this->output->set_output('{"code":1,"data":"登录成功"}');
    	}
    }


    public function logout()
    {
    	if($this->nativesession->get('admin_id')){
            $this->nativesession->delete('admin_id');
            $this->nativesession->delete('admin_name');
            redirect("/admin/login");
        }
    }

}


 ?>