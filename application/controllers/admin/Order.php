<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Order extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 $this->load->model('order_model');
		 $this->load->model('member_model');
		  $this->load->model('product_model');
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
		$order_count = $this->order_model->order_count($where);

		$config['base_url'] = '/admin/order/index';
		$config['total_rows'] = $order_count;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>';
		$config['cur_tag_close'] = '</em></span>';
		$this->pagination->initialize($config);
		if($order_count <= $config['per_page'] ){
			$per_page = 1;
		}
		$data['page'] =  $this->pagination->create_links();
		$order_list = $this->order_model->order_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
		$data['order_list'] = $order_list;
		$data['where'] = $where;
		$data['count'] = $order_count;
		$this->load->view("admin/order_view",$data);
	}
	public function baoying(){
		$this->load->library('pagination');
		$per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
		$where = $this->get_url_args();
		$order_count = $this->order_model->baoying_order_count($where);

		$config['base_url'] = '/admin/order/baoying';
		$config['total_rows'] = $order_count;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>';
		$config['cur_tag_close'] = '</em></span>';
		$this->pagination->initialize($config);
		if($order_count <= $config['per_page'] ){
			$per_page = 1;
		}
		$data['page'] =  $this->pagination->create_links();
		$order_list = $this->order_model->baoying_order_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
		$data['order_list'] = $order_list;
		$data['where'] = $where;
		$data['count'] = $order_count;
		$this->load->view("admin/baoying_order_view",$data);
	}
	public function detail($id = 0)
	{	
		$data['order'] = $this->order_model->get_one($id);
		$data['order_id'] = $id;
		$this->load->view("admin/order_detail_view",$data);
	}
}
?>