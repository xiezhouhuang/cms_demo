<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Product extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('category_model');
		
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
	public function get_member_name($member_id)
	{
		$this->load->model('member_model');
		$result = $this->member_model->get_member($member_id);
		return isset($result['username'])?$result['username']:"管理员";
	}
	public function get_category_one($category_id)
	{
		$result = $this->category_model->get_one($category_id);
		return isset($result['category_name'])?$result['category_name']:"顶级";
	}
	public function index(){
		$this->load->library('pagination');
		$per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
		$where = $this->get_url_args(array('del' => 0));
		$product_count = $this->product_model->product_count($where);

		$config['base_url'] = '/admin/product/index';
		$config['total_rows'] = $product_count;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>';
		$config['cur_tag_close'] = '</em></span>';
		$this->pagination->initialize($config);
		if($product_count <= $config['per_page'] ){
			$per_page = 1;
		}
		$data['page'] =  $this->pagination->create_links();
		$product_list = $this->product_model->product_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
		$rows = array();
		foreach ($product_list as $product) {
			$product['product_author'] = $this->get_member_name($product['member_id']);
			$product['category_name'] = $this->get_category_one($product['category_id']);
			$rows[] = $product;
		}
		$data['category'] = $this->category_model->category_list();
		$data['where'] = $where;
		$data['count'] = $product_count;
		$data['product_list']  = $rows;
		$this->load->view("admin/product_view",$data);
	}
	public function detail($id= 0)
	{
		$data['category_list'] = $this->category_model->category_list();
		$data['product'] = $this->product_model->get_one($id);
		$data['product_images'] = $this->product_model->get_product_images($id);
		$data['product_id'] = $id;
		$this->load->view("admin/product_detail_view",$data);
	}
	public function save()
	{
		
		$result = $this->product_model->save();
		if($result){
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"操作成功"}');
		}else{
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":1,"data":"操作失败"}');
		}
	}
	public function change_status()
	{
		$key = $this->input->post("key");
		$value  = $this->input->post("value");
		$ids = $this->input->post("ids");
		$result = $this->product_model->change_status($ids,$key,$value);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function del_img($id)
	{
		$this->product_model->del_img($id);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}


}
?>