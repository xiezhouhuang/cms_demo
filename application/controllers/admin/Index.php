<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Index extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 //session初始化
         $this->load->library('nativesession');
	}
	public function index(){
        $admin_name = $this->nativesession->get("admin_name");
        $data['admin_name']  = $admin_name;
        
		$this->load->view("admin/index_view",$data);
	}
	public function welcome()
	{
		$this->load->model('member_model');
		$this->load->model('product_model');
		$this->load->model('order_model');
		$data['product_status_count']=$this->product_model->product_count(array('status' => 0,'del' => 0));
		$data['order_count']=$this->order_model->order_count();
		$data['member_count']=$this->member_model->member_count(array('del' => 0));
		$data['product_count']=$this->product_model->product_count(array('del' => 0));
		$this->load->view("admin/welcome_view",$data);
	}
	public function clear_cache()
	{
		$this->config_clean();
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":1,"data":"清楚成功"}');
	}
}
?>