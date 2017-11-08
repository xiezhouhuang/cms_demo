<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Notice extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 $this->load->model('notice_model');
	}
	private function get_url_args($default = array())
	{
		$args = $this->input->get();
		
		foreach ($default as $key => $value) {
			if(!isset($args[$key])){
				$args[$key] = $value;
			
			}
		}
		foreach ($args as $key => $value) {
			if($value === ""){
				unset($args[$key]);
			}
		}		
		unset($args['per_page']);
		return  $args;
	}
	public function index($notice_style = 0 ){
		$this->load->library('pagination');
		$per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
		$where = $this->get_url_args(array('notice_style' => $notice_style));
		$notice_count = $this->notice_model->notice_count($where);

		$config['base_url'] = '/admin/notice/index/'.$notice_style;
		$config['total_rows'] = $notice_count;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>';
		$config['cur_tag_close'] = '</em></span>';
		$this->pagination->initialize($config);
		if($notice_count <= $config['per_page'] ){
			$per_page = 1;
		}
		$data['page'] =  $this->pagination->create_links();
		$data['notice_list'] = $this->notice_model->notice_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
		$data['count'] = $notice_count;
		$data['where'] =  $where;
		$data['notice_style']  = $notice_style;
		$this->load->view("admin/notice_view",$data);
	}
	public function detail($notice_style,$id = 0)
	{	
		$data['notice'] = $this->notice_model->get_one($id);
		$data['notice_id'] = $id;
		$data['notice_style'] = $notice_style;
		$this->load->view("admin/notice_detail_view",$data);
	}
	public function del()
	{
		$ids =  $this->input->post('ids');
		$result = $this->notice_model->del($ids);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function save()
	{
		$data = array(
			'notice_id' => $this->input->post('notice_id'),
			'notice_name' => $this->input->post('notice_name'),
			'status' => $this->input->post('status'),
			'notice_content' => $this->input->post('notice_content'),
			'notice_style' => $this->input->post('notice_style')
		);
		$result = $this->notice_model->save($data);
		if($result){
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"操作成功"}');
		}else{
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":1,"data":"操作失败"}');
		}
	}
	
}
?>