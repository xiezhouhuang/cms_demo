<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Config extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');  
	}
	public function index($key = 'BASE_CONFIG'){
		$data = $this->config_model->get_config($key);
		if($key == 'BASE_CONFIG'){
			$this->load->view("admin/config_view",json_decode($data['value'],true));
		}else{
			$this->load->view("admin/page_view",$data);
		}
		
	}	
	public function save()
	{
		$key  = $this->input->post('key');
		$value  = $this->input->post();
		if($key == 'BASE_CONFIG'){
			$value = json_encode($value);
		}else{
			$value = $value['value'];
		}
		$result = $this->config_model->save($key,$value);
		$data['code']= 0;
		if(!$result){
			$data['code'] = 1;
		}
		$this->config_clean();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}
	public function icon_upload()
	{
		$this->load->view("admin/icon_upload_view");
	}
	public function icon_upload_save()
	{
		$name = $this->input->post("name");
		$img  = $this->input->post("img");
		foreach ($img as $key => $value) {
			$data['category_id'] = 2;
			$data['product_img'] = $value;
			$data['product_name'] = $name[$key];
			$this->config_model->icon_save($data); 
		}
		$data['code']= 0;
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}
}
?>