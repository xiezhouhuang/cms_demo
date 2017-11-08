<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Link extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 $this->load->model('link_model');
	}
	public function index(){
		
		$data['link_list'] = $this->link_model->link_list();
		$this->load->view("admin/link_view",$data);
	}
	public function detail($id = 0)
	{	
		$data['link'] = $this->link_model->get_one($id);
		$data['link_id'] = $id;
		$this->load->view("admin/link_detail_view",$data);
	}
	public function del()
	{
		$ids =  $this->input->post('ids');
		$result = $this->link_model->del($ids);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function save()
	{
		$data = array(
			'link_id' => $this->input->post('link_id'),
			'link_name' => $this->input->post('link_name'),
			'link_image' => $this->input->post('link_image'),
			'link_url' => $this->input->post('link_url'),
			'sort' => $this->input->post('sort')
		);
		$result = $this->link_model->save($data);
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