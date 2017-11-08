<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("Common.php");
class Home extends Common {
	private $_data = array();
	public function __construct()
	{
		parent::__construct();
		$this->_data['get_yesterday_data'] = $this->get_yesterday_data();
		$this->_data['get_left_table1'] = $this->get_left_table1();
		$this->_data['get_left_table2'] = $this->get_left_table2();
	}
	public function index()
	{
		$this->load->model("notice_model");
		$this->_data['zaopan'] = $this->get_product_from_where(1,5);
		$this->_data['zhongchan'] = $this->get_product_from_where(2,6);
		$this->_data['zhongxin'] = $this->get_product_from_where(3,1);
		$this->_data['get_banner_list'] = $this->get_banner_list();
		$this->_data['notice_list'] = $this->notice_model->notice_list(0,10,array("notice_style" => 0,"status" => 1));
		$this->load->view('home_view',$this->_data);
	}

	public function baoying()
	{
		$this->load->model("notice_model");
		$where = array('del'=> 0,"category_id" => 4);
		$result = $this->get_product_data($where);
		$count  = $result['count'];
		$beizhu =  $count%5;
		if($beizhu == 0){
			$beizhu = 5;
		}
		$this->_data['beizhu'] =  $beizhu;

		$this->_data['count'] = $count;
		$this->_data['product_list'] =  $result['product_list'];


		/*$baoying =  $this->product_model->product_list(0,5,array('del'=> 0,'status' => 0,"category_id" => 4));
		$data  = "";
		$vars = $this->load->get_vars();
		$_baoying_price =   0;
		$baoying_product = array();
		for ($i=0; $i < 5; $i++){
          if (isset( $baoying[$i])){
          	$value =  $baoying[$i];
            $data .='<tr><td>'.($i+1) .'</td>
		              <td>'.date('m-d H:i',strtotime($value['start_date'])) .'</td>
		              <td><span class="layui-btn layui-bg-blue layui-btn-mini">
		                '.$vars['_globals_bisai_style'][$value['bisai_style']] .'</span></td>
		              <td>'.$value['zhudui'] .'</td>
		              <td>'.$vars['_globals_product_hot'][$value['hot']].$value['product_tags'] .'</td>
		              <td>'.$value['kedui'] .'</td>
		              <td><a href="/home/product_detail/'.$value['product_id'] .'">查看详情</a></td>
		            </tr>';
		      $_baoying_price +=  $value['product_price'] ;
		      $baoying_product[]  = array('product_id' => $value['product_id'],'product_price' => $value['product_price']); 
	     }else{
	        $data .='<tr><td>'.($i+1) .'</td><td colspan="6" style="text-align: left;">空缺</td></tr>';
	     }
          
        }*/
        $this->_data['is_buy_baoying'] = $this->public_model->is_buy_baoying();
        /*$this->_data['baoying_product_list']  =  $data;
        $this->_data['baoying_product']  =  $baoying_product;
        $this->_data['baoying_price']  =  $_baoying_price;*/
        $this->_data['notice_list'] = $this->notice_model->notice_list(0,1,array("notice_style" => 2,"status" => 1));
		$this->load->view("baoying_view",$this->_data);
	}
	public function get_more_baoying()
	{
		$where = array('del'=> 0,'show_index' => 1,'ltstatus' => 0,"category_id" => 4);
		$result = $this->get_product_data($where);
		$product_list =  $result['product_list'];	
		$data  = '';
		$vars = $this->load->get_vars();
		foreach ($product_list as $k => $v) {
			if($v['status'] == 1){
		   		$status = '<span class="layui-color-red">中</span>';
		   }else if($v['status'] == 2){
				$status = '<span class="layui-color-gray">错</span>';
		   }else{
		   		$status = '<span class="layui-color-block">未开奖</span>';
		   }	
				$data .= '<tr>
				            <td>'.($k+1).'</td>
				            <td>'.date('m-d H:i',strtotime($v['start_date'])).'</td>
				            <td><span class="layui-btn layui-bg-gray layui-btn-mini">'.$vars['_globals_bisai_style'][$v['bisai_style']].'</span></td>
				            <td>'.$v['zhudui'].'</td>
				            <td>'.$v['daan'].$v['pankou'].'</td>
				            <td>'.$v['kedui'].'</td>
				            <td>'.$status.'</td>
				             <td><a href="/home/product_detail/'.$v['product_id'].'">查看详情</a></td>
				          </tr>';
		}
		$result  = array('code' => 1,'data' => $data);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($result));
	}
	public function history()
	{
		$where = array('del'=> 0,'show_history' => 1,'ltstatus' => 0,'in_category_id' => array("1","2","3"));
		$result = $this->get_product_data($where);
		$this->_data['count'] =  $result['count'];
		$this->_data['product_list'] =  $result['product_list'];
		$this->load->view("history_view",$this->_data);
	}
	public function news()
	{
		$where = array('style' => 0);
		$result = $this->get_news_data($where);
		$this->_data['count'] =  $result['count'];
		$this->_data['news_list'] =  $result['news_list'];
		$where2 = array('style' => 1);
		$result2 = $this->get_news_data($where2);
		$this->_data['count2'] =  $result2['count'];
		$this->_data['news_list2'] =  $result2['news_list'];
		$this->load->view("news_view",$this->_data);

	}
	public function news_detail($news_id = 0)
	{
		$result = $this->get_news_detail($news_id);
		$this->_data['news'] = $result;
		if($result){
			$this->load->view("news_detail_view",$this->_data);
		}else{
			show_404("页面找不到");
		}
		
	}
	public function product_detail($product_id='')
	{
		$result = $this->get_product_detail($product_id);
		$this->_data['product'] = $result;
		if($result){
			if($result['status'] == 0){
				$this->_data['is_buy'] = $this->public_model->is_buy($product_id,$result['category_id']);
				$this->load->view("product_detail_view",$this->_data);
			}else{
				$this->load->view("history_detail_view",$this->_data);
			}
		}else{
			show_404("页面找不到");
		}
	}
	public function do_buy_baoying()
	{
		$baoying_product = urldecode($this->input->get("baoying_product"));
		$baoying_price = $this->input->get("baoying_price");
		$data['baoying_price'] = $baoying_price;
		$data['baoying_product'] = $baoying_product;
		$this->load->view("do_buy_baoying_view",$data);
	}
	public function do_buy($product_id)
	{
		$result = $this->get_product_detail($product_id);
		$data['product'] = $result;
		$this->load->view("do_buy_view",$data);
	}
	public function do_buy_handle()
	{
		$product['product_price'] = $this->input->post("product_price");
		$product['product_id'] = $this->input->post("product_id");
		$result  = $this->public_model->buy_product($product);
		$return['code'] = 0;
		$return['msg']  = "购买失败";
		if($result){
			$return['code'] = 1;
			$return['msg']  = "购买成功";
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($return));
	}
	public function do_buy_baoying_handle()
	{
		$baoying['baoying_price'] = $this->input->post("baoying_price");
		$baoying['baoying_product'] = $this->input->post("baoying_product");

		$result  = $this->public_model->buy_baoying($baoying);
		$return['code'] = 0;
		$return['msg']  = "购买失败";
		if($result){
			$return['code'] = 1;
			$return['msg']  = "购买成功";
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($return));
		
	}
	public function get_more_news($style = 0)
	{
		$where = array('style' => $style);
		$result = $this->get_news_data($where);
		$news_list =  $result['news_list'];	
		$data  = '';
		$per_page = $this->input->get('per_page')?$this->input->get('per_page'):1;
		foreach ($news_list as $k => $v) {
			if($per_page == 1 && $k < 2){

			}else{
				$data .= '<tr class="bottom-border">
                    <td width="15%">【'.$v['news_sub'].'】</td>
                    <td width="70%">'.$v['news_title'].'</td>
                    <td width="15%"><a href="/home/news_detail/'.$v['news_id'].'">点击阅读>></a></td>
                  </tr>';
			}
			
		}
		$result  = array('code' => 1,'data' => $data);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($result));
	}

	public function get_more_history()
	{
		$where = array('del'=> 0,'show_history' => 1,'ltstatus' => 0,'in_category_id' => array("1","2","3"));
		$result = $this->get_product_data($where);
		$product_list =  $result['product_list'];	
		$data  = '';
		$vars = $this->load->get_vars();
		foreach ($product_list as $key => $value){
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
                      <td width="140" class="like-table">
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
	private function get_banner_list()
	{
		$this->load->model("banner_model");
		$result = $this->banner_model->banner_list();
		return  $result;
	}
	public function upload_touxiang()
	{
		$this->load->view("public/upload_touxiang_view");
	}
}