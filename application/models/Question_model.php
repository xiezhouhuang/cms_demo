<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question_model extends CI_model{
	public $_table_question = '`question`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
	public function question_list()
	{
		$query = $this->db->query("SELECT * FROM $this->_table_question order by sort asc");
        $result  = $query->result_array();
        return $result;
	}
	public function get_one($id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_question where id = '".$id."' ");
        $result  = $query->row_array();
        return $result;
	}
	public function save($data)
	{
		
		if ($data['id'] == 0)
		{
			$this->db->insert($this->_table_question, $data);
		}
		else
		{
			$this->db->where('id', $data['id']);
			$this->db->update($this->_table_question, $data);	
		}
		return true;
	}
	public function del($id)
	{	
		$this->db->where('id', $id);
		$this->db->delete($this->_table_question);	
	}

}
?>