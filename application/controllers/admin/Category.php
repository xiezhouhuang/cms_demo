<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Category extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 $this->load->model('category_model');
	}
	public function index(){
		
		$data['category_list'] = $this->category_model->category_list();
		$this->load->view("admin/category_view",$data);
	}
	public function detail($id = 0)
	{	
		$data['category_list'] = $this->category_model->category_list();
		$data['cate_info'] = $this->category_model->get_one($id);
		$data['category_id'] = $id;
		$this->load->view("admin/category_detail_view",$data);
	}
	public function del()
	{
		$ids =  $this->input->post('ids');
		$result = $this->category_model->del($ids);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function save()
	{
		$data = array(
			'category_id' => $this->input->post('category_id'),
			'parent_id' => $this->input->post('parent_id'),
			'category_name' => $this->input->post('category_name'),
			'sort' => $this->input->post('sort')
		);
		$result = $this->category_model->save($data);
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