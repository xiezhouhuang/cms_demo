<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class News extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 $this->load->model('news_model');
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
	public function index(){
		$this->load->library('pagination');
		$per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
		$where = $this->get_url_args();
		$news_count = $this->news_model->news_count($where);

		$config['base_url'] = '/admin/news/index';
		$config['total_rows'] = $news_count;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>';
		$config['cur_tag_close'] = '</em></span>';
		$this->pagination->initialize($config);
		if($news_count <= $config['per_page'] ){
			$per_page = 1;
		}
		$data['page'] =  $this->pagination->create_links();
		$data['news_list'] = $this->news_model->news_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
		$data['count'] = $news_count;
		$data['where'] =  $where;
		$this->load->view("admin/news_view",$data);
	}
	public function detail($id = 0)
	{	
		$data['news'] = $this->news_model->get_one($id);
		$data['news_id'] = $id;
		$this->load->view("admin/news_detail_view",$data);
	}
	public function del()
	{
		$ids =  $this->input->post('ids');
		$result = $this->news_model->del($ids);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function save()
	{
		$data = array(
			'news_id' => $this->input->post('news_id'),
			'news_title' => $this->input->post('news_title'),
			'news_desc' => $this->input->post('news_desc'),
			'news_img' => $this->input->post('news_img'),
			'style' => $this->input->post('style'),
			'news_sub' => $this->input->post('news_sub'),
			'news_content' => $this->input->post('news_content')
			
		);
		$result = $this->news_model->save($data);
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