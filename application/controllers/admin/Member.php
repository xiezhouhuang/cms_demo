<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Member extends MY_Controller
{

	public function __construct()
	{
		 parent::__construct();
		 $this->load->model('member_model');
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
		$where = $this->get_url_args(array('del' => 0));
		$member_count = $this->member_model->member_count($where);

		$config['base_url'] = '/admin/member/index';
		$config['total_rows'] = $member_count;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>';
		$config['cur_tag_close'] = '</em></span>';
		$this->pagination->initialize($config);
		if($member_count <= $config['per_page'] ){
			$per_page = 1;
		}
		$data['where'] = $where;
		$data['page'] =  $this->pagination->create_links();
		$data['member_list'] = $this->member_model->member_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
		$data['group_list'] = $this->member_model->member_group_list();
		$data['count'] = $member_count;
		$this->load->view("admin/member_view",$data);
	}
	public function idcard_list()
	{
		$this->load->library('pagination');
		$per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
		$where = $this->get_url_args(array('status'=>0));
		$member_count = $this->member_model->member_card_count($where);

		$config['base_url'] = '/admin/member/idcard_list';
		$config['total_rows'] = $member_count;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>';
		$config['cur_tag_close'] = '</em></span>';
		$this->pagination->initialize($config);
		if($member_count <= $config['per_page'] ){
			$per_page = 1;
		}
		$data['where'] =  $where;
		$data['page'] =  $this->pagination->create_links();
		$data['member_list'] = $this->member_model->member_card_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);;
		$data['count'] = $member_count;
		$this->load->view("admin/member_card_view",$data);
	}
	public function balance_list($status_type =0)
	{
		//$stauts_type = 0 充值  = 1 提现 
		//$stauts = 0 审核  = 1 成功 
		$this->load->library('pagination');
		$per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
		$where = $this->get_url_args(array('status_type'=>$status_type));
		$member_count = $this->member_model->member_balance_count($where);

		$config['base_url'] = '/admin/member/balance_list/'.$status_type.'/';
		$config['total_rows'] = $member_count;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>';
		$config['cur_tag_close'] = '</em></span>';
		$this->pagination->initialize($config);
		if($member_count <= $config['per_page'] ){
			$per_page = 1;
		}
		$data['where'] =  $where;
		$data['status_type'] = $status_type;
		$data['page'] =  $this->pagination->create_links();
		$data['member_list'] = $this->member_model->member_balance_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);;
		$data['count'] = $member_count;
		$data['status_msg'] = "消费记录";
		if($status_type == 1){
			$data['status_msg'] = "充值记录";
		}else if($status_type == 2){
			$data['status_msg'] = "提现记录";
		}else if($status_type == 3){
			$data['status_msg'] = "退款记录";
		}else if($status_type == 4){
			$data['status_msg'] = "包赢购买记录";
		}else if($status_type == 5){
			$data['status_msg'] = "包赢退款记录";
		}

		$this->load->view("admin/member_balance_view",$data);
	}
	public function xiaofei($id = 0)
	{	
		$data['member_id'] = $id;
		$data['xiaofei_list'] = $this->member_model->get_xiaofei_list($id);
		$this->load->view("admin/member_xiaofei_view",$data);
	}
	public function xiaofei_del()
	{
		$id =  $this->input->post('id');
		$result = $this->member_model->xiaofei_del($id);
		$return['code'] = 1;
		if($result){
			$return['code'] = 0;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($return));
		 
	}
	public function xiaofei_detail($member_id)
	{
		$data['member_id'] =  $member_id;
		$this->load->view("admin/member_xiaofei_detail_view",$data);
	}
	public function xiaofei_save()
	{
		$data = array(
			'member_id' => $this->input->post('member_id'),
			'item_1' => $this->input->post('item_1'),
			'item_2' => $this->input->post('item_2'),
			'item_3' => $this->input->post('item_3'),
			'item_4' => $this->input->post('item_4'),
			'item_5' => $this->input->post('item_5'),
			'item_6' => $this->input->post('item_6'),
			'item_7' => $this->input->post('item_7'),
			'item_8' => $this->input->post('item_8'),
		);
		$result = $this->member_model->xiaofei_save($data);
		$return['code'] = 1;
		if($result){
			$return['code'] = 0;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($return));
	}
	public function remark_save()
	{
		$data = array(
			'member_id' => $this->input->post('member_id'),
			'remark' => $this->input->post('remark')
		);
		$result = $this->member_model->save_remark($data);
		$return['code'] = 1;
		if($result){
			$return['code'] = 0;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($return));
	}
	public function detail($id = 0)
	{	
		$data['member'] = $this->member_model->get_member($id);
		$data['idcard'] = $this->member_model->get_member_idcard($id);
		$data['account'] = $this->member_model->get_account_list($id);
		$data['group'] = $this->member_model->get_member_group($data['member']['group_id']);
		$data['member_info'] = $this->member_model->get_member_info($id);
		$this->load->view("admin/member_detail_view",$data);
	}
	public function balance_detail($action,$id)
	{
		$data['member'] = $this->member_model->get_member($id);
		$data['action'] = $action;
		if($action == "chongzhi"){
			$data['action_msg'] = "充值";
		}else{
			$data['action_msg'] = "提款";
		}
		$this->load->view("admin/member_balance_detail_view",$data);
	}
	public function do_balance_change()
	{
		$data = array(
			'member_id' => $this->input->post('member_id'),
			'balance' => $this->input->post('balance'),
			'action'  => $this->input->post('action')
		);
		$result = $this->member_model->balance_change($data);
		$return['code'] = 1;
		if($result){
			$return['code'] = 0;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($return));

	}
	public function del()
	{
		$ids =  $this->input->post('ids');
		$result = $this->member_model->del($ids);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	
	public function save()
	{
		$data = array(
			'member_id' => $this->input->post('member_id'),
			'member_title' => $this->input->post('member_title'),
			'member_desc' => $this->input->post('member_desc'),
			'member_content' => $this->input->post('member_content')
			
		);
		$result = $this->member_model->save($data);
		if($result){
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"操作成功"}');
		}else{
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"操作失败"}');
		}
	}
	// 会员等级
	public function member_group()
	{
		$group_list = $this->member_model->member_group_list();
		$rows = array();
		foreach ($group_list as $group) {
			$where = array('group_id' => $group['group_id']);
			$group['member_num'] =  $this->member_model->member_count($where);
			$rows[] = $group;
		}
		$data['group_list'] = $rows;
		$this->load->view("admin/member_group_view",$data);
	}
	public function member_group_detail($id = 0)
	{	
		$data['group'] = $this->member_model->get_member_group($id);
		$data['group_id'] = $id;
		$this->load->view("admin/member_group_detail_view",$data);
	}
	public function member_group_save()
	{
		$data = array(
			'group_id' => $this->input->post('group_id'),
			'group_name' => $this->input->post('group_name')
		);
		$result = $this->member_model->member_gorup_save($data);
		if($result){
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"操作成功"}');
		}else{
			$this->output->set_content_type('application/json');
			$this->output->set_output('{"code":0,"data":"操作失败"}');
		}
	}
	public function member_group_del()
	{
		$id =  $this->input->post('id');
		$result = $this->member_model->member_group_del($id);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function set_card_status()
	{
		$ids =  $this->input->post('ids');
		$status =  $this->input->post('status');
		$result = $this->member_model->set_card_status($ids,$status);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
	public function set_balance_status()
	{
		$id =  $this->input->post('id');
		$status =  $this->input->post('status');
		$result = $this->member_model->set_balance_status($id,$status);
		$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"操作成功"}');
	}
}
?>