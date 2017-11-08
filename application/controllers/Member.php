<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member extends MY_Controller {
  private $_data  = array();
  private $_member_id = 0;
  public function __construct()
  {
    parent::__construct();
    $this->load->library('nativesession');
    $this->_member_id  = $this->nativesession->get("session_member_id");
    if($this->_member_id <= 0){
      header('location:/login');
      exit;
    }
    $this->load->model("member_model");
    $this->load->model("order_model");
    $this->load->model("product_model");
    $this->_data['member_info'] =  $this->member_model->get_member($this->_member_id);

  }
  public function index()
  {
    $result = $this->member_model->get_member_account($this->_member_id);
    $this->_data['is_account'] = false;
    if(isset($result['account_id'])){
      $this->_data['is_account'] = true;
    }
    $this->load->view("member_view",$this->_data);
  }
  public function change_pwd()
  {
    $this->load->view("member_change_pwd_view",$this->_data);
  }
  public function do_change_pwd()
  {
    $old_password = $this->input->post("old_password");
    $password = $this->input->post("password");
    if($this->_data['member_info']['password'] == md5($old_password)){
      $result = $this->member_model->update_member_pwd($this->_member_id,$password);
      if($result){
        $return['code'] = 1;
        $return['msg']  = "修改密码成功";
      }else{
        $return['code'] = 0;
      $return['msg']  = "修改密码失败";
      }
    }else{
      $return['code'] = 0;
      $return['msg']  = "旧密码错误,请重新输入";
    }
    
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($return));
  }
  public function upload_touxiang()
  {
    $touxinag_img =  $this->input->get("touxinag_img");
    $result = $this->member_model->save_touxiang($this->_member_id,$touxinag_img);
    $return['code'] = 0;
    if($result){
      $return['code'] = 1;
    }
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($return));

  }
  public function bing_account()
  {
    $this->_data['account'] = $this->member_model->get_member_account($this->_member_id);
    $this->load->view("member_bing_account_view",$this->_data);
  }
  public function do_bing_account()
  {
    $account_id = $this->input->post("account_id");
    $account_name = $this->input->post("account_name");
    $account_no = $this->input->post("account_no");

    $result = $this->member_model->update_member_account($this->_member_id,$account_id,$account_name,$account_no);
    $return['code'] = 0;
    if($result){
      $return['code'] = 1;
    }
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($return));
  }
  public  function chongzhi()
  {
    $this->load->view("member_chongzhi_view",$this->_data);
  }
  public  function money()
  {
    //$where = $this->get_url_args(array("member_id" => $this->_member_id));
    //$balance_count = $this->member_model->member_balance_count($where);
    //$this->_data['count'] =  $balance_count;
    $this->_data['xiaofei_list'] = $this->member_model->get_xiaofei_list($this->_member_id);
    $this->load->view("member_money_view",$this->_data);
  }

  public function get_balance_more($count)
  {
    $per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
    $config['per_page'] = 10;
    if($count <= $config['per_page'] ){
      $per_page = 1;
    }
    $where = $this->get_url_args(array("member_id" => $this->_member_id));
    $balance_list = $this->member_model->member_balance_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
    $data  = '';
    $vars = $this->load->get_vars();
    foreach ($balance_list as $k => $v) {
        $category = "";
        $link  = "";
        $shouru = "";

        $zhichu = "";
        if($v['status_type'] == 1 || $v['status_type'] == 3 || $v['status_type'] == 5 ){
          $shouru = $v['total'];
        }else{
          $zhichu = $v['total'];
        }


        if($v['status_type'] == 0 || $v['status_type']== 3){
          $order  = $this->order_model->get_one($v['trade_no']);
          $category   =  $vars['_globals_bisai_category2'][$order['category_id']];
          $link  =  '<a href="/home/product_detail/'.$order['product_id'].'">查看此推介</a>';
        }
        if($v['status_type'] == 1){
            $detail = "充值";
        }else if($v['status_type'] == 2){
            $detail = "提现";
        }else if($v['status_type'] == 3){
            $detail = "购买".$category."直推退款";
        }else if($v['status_type'] == 4){
            $detail = "购买包赢直推";
        }else if($v['status_type'] == 5){
            $detail = "购买包赢直推退款";
        }else{
            $detail = "购买".$category."直推";
        } 

        $data .= '<tr>
                        <td>'.$v['add_date'].'</td>
                        <td>'.$detail.'</td>
                        <td>'.$shouru.'</td>
                        <td class="layui-color-red">'.$zhichu.'</td>
                        <td>'.$category.'</td>
                        <td>'.$link.'</td>
                      </tr>';
    }
    $result  = array('code' => 1,'data' => $data);
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($result));
    
  }
  public  function notice()
  {
    $this->load->model("notice_model");
    $this->_data['count'] = $this->notice_model->notice_count(array("notice_style" => 1,"status"=>1));
    $this->load->view("member_notice_view",$this->_data);
  }
  public function get_notice_more($notice_count)
  {
    $this->load->model("notice_model");
    $per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
    $config['per_page'] = 10;
    if($notice_count <= $config['per_page'] ){
      $per_page = 1;
    }
    $where = $this->get_url_args(array("notice_style" => 1 ,"status"=>1));
    $notice_list = $this->notice_model->notice_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
    $data  = '';
    foreach ($notice_list as $k => $v) {
           $data .= 
<<<EOF
<tr >
                      <td width="10%" rowspan="3"><img src="/public/img/notci2.png"></td>
                      <td><span class="layui-color-red">官方通知</span></td>
                    </tr>
                    <tr>
                      <td>{$v['notice_content']}</td>
                    </tr>
                    <tr>
                      <td>{$v['notice_date']}</td>
                    </tr>
                    <tr><td colspan="2"><hr></td></tr>
EOF;
    }
    $result  = array('code' => 1,'data' => $data);
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($result));
    
  }
  public  function order()
  {

    $where = array("member_id" => $this->_member_id);
    $order_count = $this->order_model->order_count($where);
    $this->_data['count'] =  $order_count;


    $baoying_where = array("baoying_order.member_id" => $this->_member_id);

    $baoying_order_count = $this->order_model->baoying_order_count($baoying_where);

    $this->_data['baoying_order_count'] =  $baoying_order_count;
   
    $this->load->view("member_order_view",$this->_data);
  }
  public function get_order_more($order_count = 0)
  {
    $per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
    $config['per_page'] = 10;
    if($order_count <= $config['per_page'] ){
      $per_page = 1;
    }
    $where = $this->get_url_args(array("member_id" => $this->_member_id));
    $order_list = $this->order_model->order_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
    $data  = '';
    $vars = $this->load->get_vars();
    foreach ($order_list as $k => $v) {
        $value = $this->product_model->get_one($v['product_id']);
        $color_class = $value['category_id'] == 3?"layui-bg-red":"layui-bg-black";
        if($value['status'] == 1){
          $status = '<span class="layui-color-red">中</span>';
         }else if($value['status'] == 2){
          $status = '<span class="layui-color-gray">错</span>';
         }else{
            $status = '<span class="layui-color-block">未开奖</span>';
         }
        $date_time  = date('m-d H:i',strtotime($value['start_date']));
        $ball = '<img src="/public/img/ball_black.png"  width="25">';
        if ($value['category_id'] == 1){
               $ball = '<img src="/public/img/ball_black.png"  width="25">';
            }elseif ($value['category_id'] == 2){
               $ball = '<img src="/public/img/ball_yell.png"  width="25">';
            }elseif ($value['category_id'] == 3){
               $ball = '<img src="/public/img/ball_red.png"  width="25">';
            }
          
           $data .= 
<<<EOF
<tr>
                      <td>
                        <div class="leixing {$color_class}"><span>nba直推网</span><br/><b>{$vars['_globals_bisai_category2'][$value['category_id']]}<b></div>
                      </td>
                      <td>{$vars['_globals_bisai_style'][$value['bisai_style']]}<br/>{$date_time}</td>
                      <td class="like-table">
                        <table class="layui-table layui-table-center layui-table-no-padding"  style="background-color:transparent" lay-skin="nob">
                          <tbody>
                          <tr><td>{$value['zhudui']}</td><td rowspan="2">VS</td><td>{$value['kedui']}</td></tr>
                          <tr><td>(主)</td><td>(客)</td></tr>
                          </tbody>
                        </table></td>
                      <td><div class="layui-row">
                        <div class="layui-col-sm3">
                        {$ball}
                        </div>
                        <div class="layui-col-sm8"> {$value['daan']}{$value['pankou']}<br>({$vars['_globals_product_hot'][$value['hot']]})</td>
                      <td>{$value['product_name']}</td>
                      <td>
                        {$status}
                        
                      </td>
                      <td>{$value['product_price']}</td>
                       <td><a href="/home/product_detail/{$value['product_id']}">查看详情</a></td>
                    </tr>
EOF;
    }
    $result  = array('code' => 1,'data' => $data);
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($result));
  }
  public function get_baoying_order_more($order_count = 0)
  {
    $per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
    $config['per_page'] = 5;
    if($order_count <= $config['per_page'] ){
      $per_page = 1;
    }
    $where = $this->get_url_args(array("baoying_order.member_id" => $this->_member_id));
    $order_list = $this->order_model->baoying_order_list(($per_page-1)*$config['per_page'],$config['per_page'],$where);
    $data  = '';
    $result_num = 0;
    $baoying_success = 0;
    $vars = $this->load->get_vars();
    foreach ($order_list as $k => $v) {
         if ($v['status'] == 1){
              $status =  '<span class="layui-color-red">中</span>';
          }elseif($v['status'] == 2){
              $status =  '<span class="layui-color-gray">错</span>';
          }else{
              $status = '<span class="layui-color-black">未开奖</span>';
          }
          $data .= '<tr>
                        <td>'.date('m-d H:i',strtotime($v['order_date'])).'</td>
                        <td>'.$v['zhudui'].'</td>
                        <td>'.$v['daan'].$v['pankou'].'</td>
                        <td>'.$v['kedui'].'</td>
                        <td>'.$status.'</td>
                    <td><a href="/home/product_detail/'.$v['product_id'].'">查看详情</a></td>
                  </tr>';
         $result_num = $v['result_num'];
         $baoying_success  =  $v['baoying_success'];
    }
    if($result_num == 5){
       $mingzhonglv  = (($baoying_success/5)*100)."%";
    }else{
       $mingzhonglv  = "未开奖";
    }
    $result  = array('code' => 1,'data' => $data,'mingzhonglv' => $mingzhonglv);
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($result));
  }
  public  function tikuan()
  {
    $this->_data['account'] = $this->member_model->get_member_account($this->_member_id);
    $this->load->view("member_tikuan_view",$this->_data);
  }
  public function get_member()
  {
    $this->output->set_content_type('application/json');
    $this->output->set_output(json_encode($this->_data));
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
}
