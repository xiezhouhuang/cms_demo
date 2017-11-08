<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_model{
	public $_table_order = '`order`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
    public function baoying_order_list($limit,$per_page,$where =array(),$order_by =array('by' => 'order_date', "order" => 'desc' ))
    {
        $this->db->select('*')->from('baoying_order_product');
        $this->db->join('baoying_order', 'baoying_order.baoying_no = baoying_order_product.baoying_no');
        $this->db->join('member', 'member.member_id = baoying_order.member_id');
        $this->db->join('product', 'product.product_id = baoying_order_product.product_id');
        foreach ($where as $key => $value) {
            if($key == "search"){
                $this->db->group_start(); //左括号
                $this->db->like("member.username",$value);  
                $this->db->or_like("product.zhudui",$value); 
                $this->db->or_like("product.kedui",$value);
                $this->db->or_like("member.email",$value);  
                $this->db->group_end(); //左括号
            }else{
                $this->db->where($key,$value);  
            }
        }
        $this->db->order_by($order_by['by'], $order_by['order']);
        $this->db->limit($per_page,$limit);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result; 
    }
    public function baoying_order_count($where =array())
    {
        $this->db->select('baoying_product_id')->from('baoying_order_product');
        $this->db->join('baoying_order', 'baoying_order.baoying_no = baoying_order_product.baoying_no');
        $this->db->join('member', 'member.member_id = baoying_order.member_id');
        $this->db->join('product', 'product.product_id = baoying_order_product.product_id');
        foreach ($where as $key => $value) {
            if($key == "search"){
                $this->db->group_start(); //左括号
                $this->db->like("member.username",$value);  
                $this->db->or_like("product.zhudui",$value); 
                $this->db->or_like("product.kedui",$value);
                $this->db->or_like("member.email",$value);  
                $this->db->group_end(); //左括号
            }else{
                $this->db->where($key,$value);  
            }
        }
        $result  = $this->db->count_all_results(); // Produces an integer, like 17
        return $result;
    }
	public function order_list($limit,$per_page,$where =array(),$order_by =array('by' => 'order_date', "order" => 'desc' ))
    {
        $this->db->select('*,product.status as result_status')->from($this->_table_order);
        $this->db->join('member', 'member.member_id = order.member_id');
        $this->db->join('product', 'order.product_id = product.product_id');
    	foreach ($where as $key => $value) {
    		if($key == "search"){
                $this->db->group_start(); //左括号
                $this->db->like("member.username",$value); 
                $this->db->or_like("product.zhudui",$value); 
                $this->db->or_like("product.kedui",$value);  
                $this->db->or_like("member.email",$value);  
                $this->db->group_end(); //左括号
            }else{
                $this->db->where("order.".$key,$value);  
            }
    	}
    	$this->db->order_by($order_by['by'], $order_by['order']);
    	$this->db->limit($per_page,$limit);
    	$query = $this->db->get();
    	$result = $query->result_array();
		return $result; 
    }
    public function order_count($where =array())
    {
        $this->db->select('order_id')->from($this->_table_order);
        $this->db->join('member', 'member.member_id = order.member_id');
        $this->db->join('product', 'order.product_id = product.product_id');
        foreach ($where as $key => $value) {
            if($key == "search"){
                $this->db->group_start(); //左括号
                $this->db->like("member.username",$value);  
                $this->db->or_like("product.zhudui",$value); 
                $this->db->or_like("product.kedui",$value);
                $this->db->or_like("member.email",$value);  
                $this->db->group_end(); //左括号
            }else{
                $this->db->where("order.".$key,$value);  
            }
        }
        $result  = $this->db->count_all_results(); // Produces an integer, like 17
        return $result;
    }

    public function get_one($order_no)
    {
        $this->db->select('product.*')->from('order');
        $this->db->join('product', 'order.product_id = product.product_id');
        $this->db->where('order.order_no',$order_no);  
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

}
?>