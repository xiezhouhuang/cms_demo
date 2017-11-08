<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_model{
	public $_table_config = '`config`';

	public function __construct(){
		//连接数据库
		$this->load->database();
    }

}
?>