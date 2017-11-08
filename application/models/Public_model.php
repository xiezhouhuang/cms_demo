<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_model extends CI_model{
	private $_table_config = '`config`';
	private $_table_category = '`category`';

	public function __construct(){
		//连接数据库
		$this->load->database();
		$this->load->library('nativesession');
    }
	public function get_config($page)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_config  where `key`  = '".$page."' ");
        $result  = $query->row_array();
        return $result;
	}
	public function setting_list()
	{
		$query = $this->db->query("SELECT * FROM `config` ");
        $result  = $query->result_array();
        $rows = array();
        foreach ($result as $key => $value) {
        	$rows[$value['key']] = $value['value'];
        }
        return $rows;
	}
	public function banner_list()
	{
		$query = $this->db->query("SELECT * FROM `banner` ");
        $result  = $query->result_array();
        $rows = array();
        $rows['banner_0'] = array();
        $rows['banner_big_0'] = array();
        foreach ($result as $key => $value) {
        	if($value['banner_style'] == 0){
        		array_push($rows['banner_0'],$value['banner_image']);
        		array_push($rows['banner_big_0'],$value['big_image']);
        	}else{
        		$rows['banner_'.$value['banner_style']] = $value['banner_image'];
        	}
        	
        }
        return $rows;
	}
	public function category_list($parent_id = 0)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_category where parent_id = '".$parent_id."'order by sort asc ");
        $result  = $query->result_array();
        return $this->sort_category($result);
	}
	private function sort_category($list)
	{
		$rows = array();
		foreach ($list as $category) {
			$category['sub_child'] = $this->category_list($category['category_id']);
			$rows[] = $category;
		}
		return $rows;
	}
	public function buy_baoying($baoying)
	{
		
		$member_id =  $this->nativesession->get("session_member_id");
		$baoying_no   =  "baoying".$member_id.time();
		$data = array(
				'member_id' => $member_id,
				'baoying_total' => $baoying["baoying_price"],
				'baoying_no' => $baoying_no 
			);
		$baoying_product =  json_decode($baoying['baoying_product'],TRUE);
		$buy_num =  sizeof($baoying_product);
		$this->db->trans_start();

		$this->db->query("INSERT INTO `baoying_order` SET buy_num =  '".$buy_num."', member_id ='".$data['member_id']."',baoying_total = '".$data['baoying_total']."', baoying_no = '".$data['baoying_no']."'");

		foreach ($baoying_product as $product) {
			$this->db->query("INSERT INTO `baoying_order_product` SET baoying_no ='".$data['baoying_no']."',product_id = '".$product['product_id']."', product_price = '".$product['product_price']."'");
		}
		//添加消费记录
        $this->db->query("INSERT INTO `member_balance` SET member_id ='".$data['member_id']."',trade_no = '".$data['baoying_no']."' ,total = '".$data['baoying_total']."' ,status_type = 4");
        //修改会员余额
        $this->db->query("UPDATE `member` SET balance = balance-".$data['baoying_total']."  where  member_id ='".$data['member_id']."'");
		$result = $this->db->trans_complete();
		return $result;

	}

	public function buy_product($product)
	{
		$order_no   =  time();
		$member_id =  $this->nativesession->get("session_member_id");
		$data = array(
				'member_id' => $member_id,
				'price' => $product["product_price"],
				'product_id' => $product["product_id"],
				'order_no' => $order_no 
			);
		$this->db->trans_start();

		$this->db->query("INSERT INTO `order` SET member_id ='".$data['member_id']."',product_id = '".$data['product_id']."' ,price = '".$data['price']."', order_no = '".$data['order_no']."'");
		//添加消费记录
        $this->db->query("INSERT INTO `member_balance` SET member_id ='".$data['member_id']."',trade_no = '".$data['order_no']."' ,total = '".$data['price']."'");
        //修改会员余额
        $this->db->query("UPDATE `member` SET balance = balance-".$data['price']."  where  member_id ='".$data['member_id']."'");

		$result = $this->db->trans_complete();
		return $result;
	}
	public function is_buy($product_id,$category_id = 0)
	{
		$member_id  = $this->nativesession->get("session_member_id");
		if($member_id){
			if($category_id == 4){
				$this->db->from('baoying_order_product');
				$this->db->join('baoying_order', 'baoying_order.baoying_no = baoying_order_product.baoying_no');
				$this->db->where('baoying_order.member_id',$member_id);
				$this->db->where('baoying_order_product.product_id',$product_id);
			}else{
				$this->db->where('member_id',$member_id);
				$this->db->where('product_id',$product_id);
				$this->db->from('order');
			}
	        $result  = $this->db->count_all_results(); 
	        if($result > 0){
	        	return 1;  //已购买
	        }else{
	        	return 0; // 未购买
	        }
		}else{
			return -1; //未登录
		}
		
	}
	public function is_buy_baoying()
	{
		$member_id  = $this->nativesession->get("session_member_id");
		if($member_id){
			$this->db->where('member_id',$member_id);
			$this->db->where('result_num <',5);
			$this->db->from('baoying_order');
	        $result  = $this->db->count_all_results(); 
	        if($result > 0){
	        	return 1;  //已购买
	        }else{
	        	return 0; // 未购买
	        }
		}else{
			return -1; //未登录
		}
		
	}

}
?>