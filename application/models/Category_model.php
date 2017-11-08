<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_model{
	public $_table_category = '`category`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
	public function category_list($parent_id = 0)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_category where parent_id = '".$parent_id."'order by sort asc ");
        $result  = $query->result_array();
        return $this->sort_category($result);
	}
	public function get_one($id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_category where category_id = '".$id."' ");
        $result  = $query->row_array();
        return $result;
	}
	public function save($data)
	{
		
		if ($data['category_id'] == 0)
		{
			$this->db->insert('category', $data);
			return true;
		}
		else
		{
			$this->db->where('category_id', $data['category_id']);
			$this->db->update('category', $data);
			return true;
		}
	}
	public function del($ids = array())
	{	
		foreach ($ids as $id) {
			if($id > 2){
				$this->db->where("category_id = '".$id."' OR parent_id = '".$id."'");
				$this->db->delete('category');
			} 
		}
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

}
?>