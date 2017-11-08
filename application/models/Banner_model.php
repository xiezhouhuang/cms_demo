<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_model{
	public $_table_banner = '`banner`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
	public function banner_list()
	{
		$query = $this->db->query("SELECT * FROM $this->_table_banner order by sort asc ");
        $result  = $query->result_array();
        return $result;
	}
	public function get_one($id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_banner where banner_id = '".$id."' ");
        $result  = $query->row_array();
        return $result;
	}
	public function save($data)
	{
		
		if ($data['banner_id'] == 0)
		{
			$this->db->insert($this->_table_banner, $data);
		}
		else
		{
			$this->db->where('banner_id', $data['banner_id']);
			$this->db->update($this->_table_banner, $data);	
		}
		return true;
	}
	public function del($ids = array())
	{	
		foreach ($ids as $id) {
			$this->db->where('banner_id', $id);
			$this->db->delete($this->_table_banner);	
		}
	}

}
?>