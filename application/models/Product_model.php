<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_model{
	public $_table_category = '`category`';
	public $_table_member = '`member`';
	public $_table_product = '`product`';
	public $_table_product_images = '`product_images`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
    public function product_count($where =array())
    {
    	foreach ($where as $key => $value) {
            if($key == 'search'){
            	$this->db->group_start();
    			$this->db->like('product_name',$value);
    			$this->db->or_like('kedui',$value);
    			$this->db->or_like('zhudui',$value);
    			$this->db->group_end();
    		}else if($key == 'yesterday'){
    			$this->db->like('create_date',$value);
    		}else if($key == 'ltstatus'){
    			$this->db->where('status > ',$value);
    		}else if($key == "in_category_id"){
    			$this->db->where_in("category_id",$value);
    		}else{
    			$this->db->where($key,$value);
    		}
        }
        $this->db->from($this->_table_product);
        $result  = $this->db->count_all_results(); // Produces an integer, like 17
        return $result;
    }
    public function product_list($limit,$per_page,$where =array(),$order_by =array('by' => 'create_date', "order" => 'desc' )){
        $this->db->select('*')->from($this->_table_product);
    	foreach ($where as $key => $value) {
    		if($key == 'search'){
    			$this->db->group_start();
    			$this->db->like('product_name',$value);
    			$this->db->or_like('kedui',$value);
    			$this->db->or_like('zhudui',$value);
    			$this->db->group_end();
    		}else if($key == 'yesterday'){
    			$this->db->where('create_date <',$value);
    		}else if($key == 'ltstatus'){
    			$this->db->where('status > ',$value);
    		}else if($key == "in_category_id"){
    			$this->db->where_in("category_id",$value);
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
	public function get_one($id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_product where product_id = '".$id."' ");
        $result  = $query->row_array();
        return $result;
	}
	public function get_product_images($id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_product_images where del = 0 AND product_id = '".$id."' ");
        $result  = $query->result_array();
        return $result;
	}
	public function change_status($ids,$key,$value)
	{
		foreach ($ids as $id) {
			$data = array($key => $value);
			$this->db->where('product_id',$id);
			$this->db->update($this->_table_product,$data); 
		}
	}
	public function save()
	{
		$data = array(
			'product_id' => $this->input->post('product_id'),
			'category_id' => $this->input->post('category_id'),
			'pankou' => $this->input->post('pankou'),
			'zhudui' => $this->input->post('zhudui'),
			'kedui' => $this->input->post('kedui'),
			'start_date' => $this->input->post('start_date'),
			'bisai_style' => $this->input->post('bisai_style'),
			'product_price' => $this->input->post('product_price'),
			'product_tags' => $this->input->post('product_tags'),
			'status' =>$this->input->post('status'),
			'hot' =>$this->input->post('hot'),
			'daan' =>$this->input->post('daan'),
			'product_img' => $this->input->post('product_img'),
			'product_name' =>$this->input->post('product_name')
		);

		if ($data['product_id'] == 0)
		{
			$this->db->trans_start();
			$sql = $this->db->insert_string($this->_table_product, $data);
			$this->db->query($sql);
			$id = $this->db->insert_id();
			if($data['category_id'] == 4){
				$this->db->select("*");
				$this->db->where("buy_num  <","5");
				$this->db->from("baoying_order");
				$query = $this->db->get();
				$list  = $query->result_array();
				foreach ($list as $order) {
					$this->db->query("INSERT INTO `baoying_order_product` SET baoying_no ='".$order['baoying_no']."',product_id = '".$id."', product_price = '".$data['product_price']."'");
					$this->db->query("UPDATE  `baoying_order` SET buy_num = buy_num+1 WHERE baoying_id  = '".$order['baoying_id']."'");
				}
			}
			$result = $this->db->trans_complete();
		}
		else
		{	
			if($data['category_id'] == 4 && $data['status'] > 0){
				//包赢
				$this->db->select("baoying_order_product.*,baoying_order.*")->from("baoying_order_product");
				$this->db->join('baoying_order', 'baoying_order.baoying_no = baoying_order_product.baoying_no');
				$this->db->where("baoying_order_product.product_id",$data['product_id']);
				$query = $this->db->get();
				$result  = $query->result_array();
				$this->db->trans_start();
				$this->db->query("UPDATE  `product` SET status ='".$data['status']."',product_name = '".$data['product_name']."' WHERE product_id  = '".$data['product_id']."'");
				foreach ($result as $v) {
					$error  = $v['baoying_error'];
					if($data['status'] == 2){
						$error += 1;
						$this->db->query("UPDATE  `baoying_order` SET baoying_error = baoying_error+1,result_num = result_num+1,refund_price = refund_price+'".$v['product_price']."' WHERE baoying_id  = '".$v['baoying_id']."'");
					}else if($data['status'] == 1){
						$this->db->query("UPDATE  `baoying_order` SET baoying_success = baoying_success+1,result_num = result_num+1 WHERE baoying_id  = '".$v['baoying_id']."'");

					}

					if($v['result_num'] == 4 && $error > 0){
						if($error > 2 ){
							$refund_price = $v['baoying_total'];
						}else{
						  	$refund_price = $v['refund_price'];
						}
						//添加退款记录
					    //$this->db->query("INSERT INTO `member_balance` SET member_id ='".$v['member_id']."',trade_no = '".$v['baoying_no']."' ,total = '".$refund_price."' , status_type = 5");
					        //修改会员余额
					   // $this->db->query("UPDATE `member` SET balance = balance+".$refund_price."  where  member_id ='".$v['member_id']."'");
						
					}
				}
				$result = $this->db->trans_complete();

			}else if($data['status'] == 2 ){
				//其他直推
				$query = $this->db->query("SELECT member_id,price,order_no FROM `order` where product_id = '".$data['product_id']."' ");
		        $list  = $query->result_array();
		        if($data['category_id'] == 3){
		        	$num = 1.2;
		        }else{
		        	$num  = 1;
		        }
				$this->db->trans_start();

				$this->db->query("UPDATE  `product` SET status ='".$data['status']."',product_name = '".$data['product_name']."' WHERE product_id  = '".$data['product_id']."'");
				foreach ($list as $k => $v) {

					//添加退款记录
			        $this->db->query("INSERT INTO `member_balance` SET member_id ='".$v['member_id']."',trade_no = '".$v['order_no']."' ,total = '".$v['price']*$num."' , status_type = 3");
			        //修改会员余额
			        $this->db->query("UPDATE `member` SET balance = balance+".$v['price']*$num."  where  member_id ='".$v['member_id']."'");
				}
				$result = $this->db->trans_complete();
			}else{
				$this->db->where('product_id', $data['product_id']);
				$result = $this->db->update($this->_table_product, $data);
			}
			
		}
		return $result;
		
	}
	public function del($id)
	{	
		$data = array('del' => 1);
		$this->db->where('product_id', $id);
		$this->db->update($this->_table_product,$data); 
	}
	public function del_img($id)
	{
		$data = array('del' => 1);
		$this->db->where('id', $id);
		$this->db->update($this->_table_product_images,$data); 
	}
}
?>