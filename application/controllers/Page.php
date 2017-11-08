<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('config_model');
    $this->load->model('question_model');
  }
  public function index()
  {
    $this->load->view("page_index_view");
  }
  public function static_page($key = "questions")
  {
      if($key == "questions"){
          $data['questions'] = $this->question_model->question_list();
      }else{
          $data =  $this->config_model->get_config($key);
      }
     $data['key'] =  $key;
     $this->load->view("static_page_view",$data);
  }
  public function team_index()
  {
    $data =  $this->config_model->get_config("PAGETEAMINDEX");
    $this->load->view("team_index_view",$data);
  }
  public function team($key = "RANGFEN")
  {
    $data =  $this->config_model->get_config($key);
    $this->load->view("team_detail_view",$data);
  }
}
