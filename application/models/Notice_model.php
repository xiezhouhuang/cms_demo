<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class notice_model extends CI_model{
	public $_table_notice = '`notice`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }
	public function notice_list($limit,$per_page,$where =array(),$order_by =array('by' => 'notice_date', "order" => 'desc' )){
        $this->db->select('*')->from($this->_table_notice);
    	foreach ($where as $key => $value) {
    		if($key == 'search'){
    			$this->db->like('notice_name',$value);
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
	public function notice_count($where =array())
    {
    	foreach ($where as $key => $value) {
            if($key == 'search'){
    			$this->db->like('notice_name',$value);
    		}else{
    			$this->db->where($key,$value);
    		}
        }
        $this->db->from($this->_table_notice);
        $result  = $this->db->count_all_results(); // Produces an integer, like 17
        return $result;
    }
	public function get_one($id)
	{
		$query = $this->db->query("SELECT * FROM $this->_table_notice where notice_id = '".$id."' ");
        $result  = $query->row_array();
        return $result;
	}
	public function save($data)
	{
		
		if ($data['notice_id'] == 0)
		{
			$this->db->insert($this->_table_notice, $data);
		}
		else
		{
			$this->db->where('notice_id', $data['notice_id']);
			$this->db->update($this->_table_notice, $data);	
		}
		return true;
	}
	public function del($ids = array())
	{	
		foreach ($ids as $id) {
			$this->db->where('notice_id', $id);
			$this->db->delete($this->_table_notice);	
		}
	}

}
?>