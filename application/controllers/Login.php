<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("login_model");
  }
  public function index()
  {
    $this->load->view("login_view");
  }
  public function logout()
  {
    $this->login_model->member_logout();
    header('location:/');
    exit;
  }
  public function do_login()
  {
  	$username = $this->input->post("username");
  	$password = $this->input->post("password");	
  	$restult = $this->login_model->member_login($username,$password);
  	if(!$restult){
    	$this->output->set_content_type('application/json');
		$this->output->set_output('{"code":0,"data":"账号密码错误,请重试"}');
    }else{
        $this->output->set_content_type('application/json');
		$this->output->set_output('{"code":1,"data":"登录成功"}');
    }
  }
  public function forget_pwd()
  {
   	 $this->load->view("forget_pwd_view");
  }
  public function register()
  {
  	 $this->load->view("register_view");
  }
  public function do_register()
  {
  	$data['username'] = $this->input->post("username");
  	$data['password'] = $this->input->post("password");	
  	$data['phone'] = $this->input->post("phone");	
  	$data['qq'] = $this->input->post("qq");	
  	$data['email'] = $this->input->post("email");	
    if($return = $this->_check_account($data['username'],$data['email'])){
      $this->output->set_content_type('application/json');
      $this->output->set_output('{"code":0,"data":"'.$return.'"}');
    }else{
      $restult = $this->login_model->member_register($data);
      if(!$restult){
        $this->output->set_content_type('application/json');
        $this->output->set_output('{"code":0,"data":"注册失败,请重试"}');
      }else{
        $this->output->set_content_type('application/json');
        $this->output->set_output('{"code":1,"data":"注册成功"}');
      }
    }
  	
  }
  private function _check_account($username,$email)
  {
  	$restult = $this->login_model->check_account($username,$email);
  	return  $restult;
  }
  public function forget_pwd_password()
  {
    $password = $this->input->get("token");
    $email = $this->input->get("token_name");
    
    $data['token'] = $password;
    $data['token_name'] = $email;
    $this->load->view("forget_change_pwd_view",$data);

  }
  public function do_forget_change_pwd()
  {
    $old_password = base64_decode($this->input->post("token"));
    $new_password = $this->input->post("new_password"); 
    $email = base64_decode($this->input->post("token_name"));

    $restult = $this->login_model->forget_change_pwd($email,$old_password,$new_password);
   
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($restult));

  }
  public function send_forget_pwd()
  {
    $email = $this->input->post("email"); 
    
    $restult = $this->login_model->send_forget_pwd($email);
    
    if($restult){
      $this->load->library('email');
      $config['protocol'] = 'smtp';  
      $config['smtp_host'] = 'smtp.163.com';  
      $config['smtp_user'] = '15920122104@163.com';  
      $config['smtp_pass'] = '86928801..';  
      $config['smtp_port'] = '25';  
      $config['charset'] = 'utf-8';  
      $config['wordwrap'] = TRUE;  
      $config['mailtype'] = 'html';  
      $url  = "http://".$_SERVER['HTTP_HOST'] ."/login/forget_pwd_password?token=".base64_encode($restult['password'])."&token_name=".base64_encode($email);
      $this->email->initialize($config);
      $this->email->from('15920122104@163.com', '直推网');
      $this->email->to($email, $restult['username']);
      $this->email->subject('直推网找回密码');
      $this->email->message('请点击以下链接修改密码<br /> '.$url);
      if($this->email->send()){
        $return['code'] = 1;
        $return['msg'] = "发送成功,请查收邮件";
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($return));
      }else{
        $return['code'] = 0;
        $return['msg'] = "发送邮件失败,请重新发送";
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($return));
      }
    }else{
      $return['code'] = 0;
      $return['msg'] = "该邮箱未注册为会员";
      $this->output->set_content_type('application/json');
      $this->output->set_output(json_encode($return));
    }
  }
}
