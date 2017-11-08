<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Banner extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 $this->load->model('banner_model');
	}
	public function index(){
		
		$data['banner_list'] = $this->banner_model->banner_list();
		$this->load->view("admin/banner_view",$data);
	}
	public function detail($id = 0)
	{	
		$data['banner'] = $this->banner_model->get_one($id);
		$data['banner_id'] = $id;
		$this->load->view("admin/banner_detail_view",$data);
	}
	public function del()
	{
		$ids =  $this->input->post('ids');
		$result = $this->banner_model->del($ids);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function save()
	{
		$data = array(
			'banner_id' => $this->input->post('banner_id'),
			'banner_name' => $this->input->post('banner_name'),
			'banner_image' => $this->input->post('banner_image'),
			'big_image' => $this->input->post('big_image'),
			'banner_url' => $this->input->post('banner_url'),
			'banner_style' => $this->input->post('banner_style'),
			'sort' => $this->input->post('sort')
		);
		$result = $this->banner_model->save($data);
		if($result){
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"操作成功"}');
		}else{
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"操作失败"}');
		}
	}
	
}
?>