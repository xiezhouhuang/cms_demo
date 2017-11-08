<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('product_model');
    $this->load->model('public_model');
    $this->load->model('news_model');
  }
  protected function get_yesterday_data()
  {
    $now  =  date("Y-m-d");
    $where = array('del' => 0,'show_left' => 1);
    $result = $this->product_model->product_list(0,10,$where);
    return $result;
  }
  protected function get_product_from_where($category,$limit)
  {
    $where = array('del'=>0,'category_id' => $category ,'show_index' => 1 );
    $result = $this->product_model->product_list(0,$limit,$where);
    return  $result;
  }
  protected function get_left_table1()
  {
    $config = $this->public_model->get_config('ZHONGXINZHANJI'); 
    return $config['value'];
  }
  protected function get_left_table2()
  {
    $config = $this->public_model->get_config('ZHITUIZHANJI'); 
    return $config['value'];
  }

  private function get_url_args($default = array())
  {
    $args = $this->input->get();
    
    foreach ($default as $key => $value) {
      if(!isset($args[$key])){
        $args[$key] = $value;
      
      }
    }
    foreach ($args as $key => $value) {
      if($value === ""){
        unset($args[$key]);
      }
    }
    unset($args['per_page']);
    return  $args;
  }
  protected function get_product_data($default = ""){
    
    $per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
    $where = $this->get_url_args($default);
    $product_count = $this->product_model->product_count($where);
    $config['per_page'] = 10;
    if($product_count <= $config['per_page'] ){
      $per_page = 1;
    }
    $data['count'] =  $product_count;
    $product_list = $this->product_model->product_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
    $data['product_list']  = $product_list;
    return  $data;
  }
  protected function get_news_data($default = ""){
    
    $per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
    $where = $this->get_url_args($default);
    $news_count = $this->news_model->news_count($where);
    $config['per_page'] = 7;
    $data['count'] =  $news_count;
    if($news_count <= $config['per_page'] ){
      $per_page = 1;
    }
    $news_list = $this->news_model->news_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
    $data['news_list']  = $news_list;
    return  $data;
  }
  protected function get_news_detail($news_id)
  {
    $result = $this->news_model->get_one($news_id);
    return $result;
  }
  protected function get_product_detail($product_id)
  {
    $result = $this->product_model->get_one($product_id);
    return $result;
  }
}
