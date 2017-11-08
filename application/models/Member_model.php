<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_model{
	private $_table_member = '`member`';
	private $_table_member_balance = '`member_balance`';
	private $_table_member_group = '`member_group`';
	private $_table_member_idcard = '`member_idcard`';
	private $_table_member_info = '`member_info`';
	private $_table_member_account = '`member_account`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
    public function member_list($limit,$per_page,$where =array(),$order_by =array('by' => 'create_date', "order" => 'desc' ))
    {
    	$this->db->select('*')->from($this->_table_member);
    	foreach ($where as $key => $value) {
    		if($key == 'search'){
                $this->db->group_start();
                $this->db->like('username',$value);
                $this->db->or_like('email',$value);
                $this->db->group_end();
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
    public function member_count($where =array())
    {
        foreach ($where as $key => $value) {
           if($key == 'search'){
                $this->db->group_start();
               $this->db->like('username',$value);
               $this->db->or_like('email',$value);
               $this->db->group_end();
            }else{
                $this->db->where($key,$value);
            }
        }
        $this->db->from($this->_table_member);
        $result  = $this->db->count_all_results(); // Produces an integer, like 17
        return $result;
    }
     public function member_card_list($limit,$per_page,$where =array(),$order_by =array('by' => 'add_date', "order" => 'desc' ))
    {
        $this->db->select('*')->from('member_idcard');
        $this->db->join('member', 'member_idcard.member_id = member.member_id');
        foreach ($where as $key => $value) {
            $this->db->where($key,$value);
        }
        $this->db->order_by($order_by['by'], $order_by['order']);
        $this->db->limit($per_page,$limit);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result; 
    }
    public function member_card_count($where =array())
    {
        foreach ($where as $key => $value) {
            $this->db->where($key,$value);
        }
        $this->db->from($this->_table_member_idcard);
        $result  = $this->db->count_all_results(); // Produces an integer, like 17
        return $result;
    }

    public function member_balance_list($limit,$per_page,$where =array(),$order_by =array('by' => 'add_date', "order" => 'desc' ))
    {
        $this->db->select('*')->from('member_balance');
        $this->db->join('member', 'member_balance.member_id = member.member_id');
        foreach ($where as $key => $value) {
            if($key == "search"){
                $this->db->group_start(); //左括号
                $this->db->like("member.username",$value);  
                $this->db->or_like("member.email",$value); 
                $this->db->group_end(); //左括号
            }else {
                $this->db->where("member_balance.".$key,$value);  
            }
            
        }
        $this->db->order_by($order_by['by'], $order_by['order']);
        $this->db->limit($per_page,$limit);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result; 
    }
    public function member_balance_count($where =array())
    {
        $this->db->select('*')->from('member_balance');
        $this->db->join('member', 'member_balance.member_id = member.member_id');
        foreach ($where as $key => $value) {
            if($key == "search"){
                $this->db->group_start();
                $this->db->like("member.username",$value);  
                $this->db->or_like("member.email",$value); 
                $this->db->group_end(); 
            }else{
                $this->db->where("member_balance.".$key,$value);  
            }
        }
        $result  = $this->db->count_all_results(); // Produces an integer, like 17
        return $result;
    }

    public function get_member_idcard($member_id)
    {
        $query = $this->db->query("SELECT * FROM $this->_table_member_idcard where member_id = '".$member_id."'");
        $result  = $query->row_array();
        return $result;
    }
     public function member_group_list()
    {
        $query = $this->db->query("SELECT * FROM $this->_table_member_group");
        $result  = $query->result_array();
        return $result;
    }
    public function get_account_list($member_id)
    {
        $query = $this->db->query("SELECT * FROM $this->_table_member_account where member_id = '".$member_id."'");
        $result  = $query->result_array();
        return $result;
    }
    public function get_member_group($group_id)
    {
        $query = $this->db->query("SELECT * FROM $this->_table_member_group where group_id = '".$group_id."'");
        $result  = $query->row_array();
        return $result;
    }
    public function xiaofei_save($data)
    {
        $result = $this->db->insert("member_xiaofei",$data);
        return $result;
    }
    public function save_remark($data)
    {
        $this->db->set('remark', $data['remark']);
        $this->db->where('member_id', $data['member_id']);
        $result = $this->db->update($this->_table_member, $data);
        return $result;
    }
    public function get_xiaofei_list($member_id)
    {
        $this->db->select("*")->from("member_xiaofei");
        $this->db->where("member_id",$member_id);
        $query = $this->db->get();
        $result  = $query->result_array();
        return $result;
    }

    public function member_gorup_save($data)
    {
        if ($data['group_id'] == 0)
        {
            $this->db->insert($this->_table_member_group, $data);
            return true;
        }
        else
        {
            $this->db->where('group_id', $data['group_id']);
            $this->db->update($this->_table_member_group, $data);
            return true;
        }
    }
    public function balance_change($data = array())
    {
        if($data['action'] == "chongzhi"){
            //充值
            $sql_str  =  "balance = balance +".$data['balance']."";
            $status_type  =  1;
        }else{
            //提款
            $sql_str  =  "balance = balance -".$data['balance']."";
            $status_type  =  2;
        }
        $this->db->trans_start();
        //添加充值记录
        $this->db->query("INSERT INTO $this->_table_member_balance SET member_id ='".$data['member_id']."',trade_no = '".time()."' ,total = '".$data['balance']."' , status_type = '".$status_type."'");
        //修改会员余额
        $this->db->query("UPDATE $this->_table_member SET ".$sql_str."  WHERE  member_id ='".$data['member_id']."'");
        
        $result = $this->db->trans_complete();
        return $result;
    }
	public function get_member($member_id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_member where member_id = '".$member_id."'");
        $result  = $query->row_array();
        return $result;
	}
	public function get_member_info($member_id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_member_info where member_id = '".$member_id."'");
        $result  = $query->row_array();
        return $result;
	}
    public function member_group_del($id)
    {
            $this->db->where('group_id',$id);
            $this->db->delete($this->_table_member_group); 
    }
    public function xiaofei_del($id)
    {
       $this->db->where('id',$id);
       
       $result = $this->db->delete("member_xiaofei");
       return $result; 
    }
    public function del($ids)
    {
        foreach ($ids as $id) {
            $data['del'] = 1;
            $this->db->where('member_id',$id);
            $this->db->update($this->_table_member,$data); 
        }
    }
    public function set_card_status($ids,$status)
    {
        foreach ($ids as $id) {

            $data['status'] = $status;
            $this->db->where('member_id',$id);
            $this->db->update($this->_table_member_idcard,$data);
            if($status == 1){
                $pass['group_id'] = 2; 
                $this->db->where('member_id',$id);
                $this->db->update($this->_table_member,$pass); 
            }else if($status == 2){
                $pass['group_id'] = 1; 
                $this->db->where('member_id',$id);
                $this->db->update($this->_table_member,$pass); 
            }
        }
    }
    public function get_balance_info($balance_id)
    {
        $query = $this->db->query("SELECT * FROM $this->_table_member_balance where balance_id = '".$balance_id."'");
        $result  = $query->row_array();
        return $result;
    }
    public function set_balance_status($id,$status)
    {
        $data['status'] = $status;
        $this->db->where('balance_id',$id);
        $this->db->update($this->_table_member_balance,$data);
        if($status == 2){ 
            $balance_info = $this->get_balance_info($id);
            $this->db->where('member_id',$balance_info['member_id']);
            $this->db->set('balance','balance + '.$balance_info['total'].'',FALSE);
            $this->db->update($this->_table_member); 
        }
    }

    public function get_member_account($member_id)
    {
        $this->db->select("*");
        $this->db->where("member_id",$member_id);
        $this->db->from("member_account");
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function update_member_account($member_id,$account_id,$account_name,$account_no)
    {
        if($account_id > 0 ){
            $this->db->where('account_id',$account_id);
            $this->db->set('account_name',$account_name);
            $this->db->set('account_no',$account_no);
            $result =  $this->db->update($this->_table_member_account); 
        }else{
            $data = array(
                'member_id' => $member_id,
                'account_name' =>$account_name,
                'account_no' => $account_no
                );
            $result = $this->db->insert($this->_table_member_account,$data); 
        }
        return $result;
        
    }
    public function update_member_pwd($member_id,$password)
    {
        $this->db->where('member_id',$member_id);
        $this->db->set('password',md5($password));
        $result =  $this->db->update($this->_table_member);
        return $result; 
    }
    public function save_touxiang($member_id,$touxiang)
    {
        $this->db->where('member_id',$member_id);
        $this->db->set('touxiang',$touxiang);
        $result =  $this->db->update($this->_table_member);
        return $result; 
    }
}
?>