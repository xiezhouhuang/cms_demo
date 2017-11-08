<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Question extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 $this->load->model('question_model');
	}
	public function index(){
		$data['question_list'] = $this->question_model->question_list();
		$this->load->view("admin/question_view",$data);
	}
	public function detail($id = 0)
	{	
		$data['question'] = $this->question_model->get_one($id);
		$data['id'] = $id;
		$this->load->view("admin/question_detail_view",$data);
	}
	public function del()
	{
		$id =  $this->input->post('id');
		$result = $this->question_model->del($id);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function save()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'title' => $this->input->post('title'),
			'sort' => $this->input->post('sort'),
			'content' => $this->input->post('content')
			
		);
		$result = $this->question_model->save($data);
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