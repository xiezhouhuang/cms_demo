<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_model{
	public $_table_admin = '`admin`';
	public $_table_member = '`member`';

	public function __construct(){
		//连接数据库
		$this->load->database();
	    $this->load->library('nativesession');
    }
	public function login($username,$password)
	{
		$query = $this->db->query("SELECT admin_id FROM $this->_table_admin WHERE  username = '$username' AND password = '$password'");
        
        $count  = $query->num_rows();
        if($count){
            $this->nativesession->set("admin_id",1);
            return TRUE;
        }else{
            return FALSE;
        }

	}
	public function member_logout()
	{
		$this->nativesession->delete("session_member_id");
		$this->nativesession->delete("session_member_name");
	}
	public function member_login($username,$password)
	{
		$password =  md5($password);
		$query = $this->db->query("SELECT member_id,username FROM $this->_table_member WHERE del = 0 AND  username = '$username' AND password = '$password'");
		$result = $query->row_array();
		if($result){
			$this->nativesession->set("session_member_id",$result['member_id']);
			$this->nativesession->set("session_member_name",$result['username']);
			return true;
		}else{
			return false;
		}
	}

	public function member_register($data = array())
	{
		$data['password'] = md5($data['password']);
		$result  = $this->db->insert($this->_table_member,$data);
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function send_forget_pwd($email)
	{
		$this->db->select("username,password");
        $this->db->where('email',$email);
        $this->db->where('del',0);
		$this->db->from($this->_table_member);
		$query  = $this->db->get(); // Produces an integer, like 17
        $result = $query->row_array();
		return $result;
	}
	public function check_account($username,$email)
	{
		$this->db->select("username,email");
		$this->db->where('username',$username);
        $this->db->or_where('email',$email);
		$this->db->from($this->_table_member);

        $query  = $this->db->get(); // Produces an integer, like 17
        $result = $query->row_array();
        if (isset($result) && is_array($result)){
        	if($result['username'] ==  $username){
        		return "用户名已经存在!";
        	}else{
        		return '邮箱已经存在!';
        	}
        }else{
        	return false;
        }
        
	}
	public function forget_change_pwd($email,$old_pwd,$new_pwd)
	{
		$this->db->select("username,email");
		$this->db->where('password',$old_pwd);
        $this->db->where('email',$email);
		$this->db->from($this->_table_member);

        $query  = $this->db->get(); // Produces an integer, like 17
        $result = $query->row_array();
        if (isset($result) && is_array($result)){
        	$new_password = md5($new_pwd);
			$this->db->set('password', $new_password);
			$this->db->where('email', $email );
			$update = $this->db->update($this->_table_member);
        	if($update){
        		return array('code'=> 1,'msg' => "修改密码成功");
        	}else{
        		return array('code'=> 0,'msg' => "修改密码失败");
        	}
        }else{
        	return array('code'=> 0,'msg' => "该忘记密码账号链接已经失效");
        }
	}
}
?>