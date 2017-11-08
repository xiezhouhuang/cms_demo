<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link_model extends CI_model{
	public $_table_link = '`link`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
	public function link_list()
	{
		$query = $this->db->query("SELECT * FROM $this->_table_link order by sort asc ");
        $result  = $query->result_array();
        return $result;
	}
	public function get_one($id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_link where link_id = '".$id."' ");
        $result  = $query->row_array();
        return $result;
	}
	public function save($data)
	{
		
		if ($data['link_id'] == 0)
		{
			$this->db->insert($this->_table_link, $data);
		}
		else
		{
			$this->db->where('link_id', $data['link_id']);
			$this->db->update($this->_table_link, $data);	
		}
		return true;
	}
	public function del($ids = array())
	{	
		foreach ($ids as $id) {
			$this->db->where('link_id', $id);
			$this->db->delete($this->_table_link);	
		}
	}

}
?>