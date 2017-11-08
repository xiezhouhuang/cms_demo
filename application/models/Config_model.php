<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_model{
	public $_table_config = '`config`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
	public function get_config($page)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_config  where `key`  = '".$page."' ");
        $result  = $query->row_array();
        return $result;
	}
	public function save($key,$value)
	{
		$data['value'] = $value;
		$this->db->where('key', $key);
		$this->db->update($this->_table_config, $data);	
        $result  = $this->db->affected_rows();
        return $result;
	}
	public function icon_save($data)
	{

		$this->db->insert('product',$data);
	}

}
?>