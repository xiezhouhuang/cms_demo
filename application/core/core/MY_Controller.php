<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
  protected $_globals_cate = array();
	public function __construct(){
      parent::__construct();
      //session初始化
      $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
      $this->load->model('public_model');
      if ($this->uri->segment(1) == 'admin'){
        $this->_check_admin();  
      }else{
        //$this->_get_cate();
        $this->_get_banner();
        $this->_get_setting();
      }
      $this->_get_config();
      //$data['_globals_product_style'] = array('0' => '大小分','1'=>'主让','2'=>'客让');
      $data['_globals_banner_style'] = array('0' => '首页滚动图','1'=>'右上','2'=>'右下','3'=>'首页banner','4'=>'包赢banner','5'=>'推荐banner','6'=>'资讯banner','7'=>'团队banner','8'=>'案例banner','9'=>'微信图片带客服','10'=>'微信图片不带客服');
      $data['_globals_product_hot'] = array('0' => '全场','1'=>'第一节','2'=>'第二节','3'=>'第三节','4'=>'上半场','5'=>'下半场');
      $data['_globals_product_good'] = array('0' => '大分','1'=>'小分','2'=>'主让','3'=>'客让');
      $data['_globals_bisai_style'] = array('0' => 'NBA常规赛','1'=>'NBA季后赛','2'=>'NAB夏季联赛');
      $data['_globals_news_style'] = array('0' => '内部资料','1'=>'直推启示');
      $data['_globals_bisai_status'] = array('0' => '待开奖','1'=>'已中奖','2'=>'未开奖');
      $data['_globals_bisai_category'] = array('1' => '早盘<br/>推荐','2'=>'中场<br/>推荐','3'=>'重点<br/>推荐','4'=>'包赢<br/>推荐');
      $data['_globals_bisai_category3'] = array('1' => '早盘推荐','2'=>'中场推荐','3'=>'重点推荐','4'=>'包赢推荐');
      $data['_globals_bisai_category2'] = array('1' => '早盘','2'=>'中场','3'=>'重点','4'=>'包赢');
      $data['_globals_baozhang'] = array('1' => '不中退100%答案金','2'=>'不中退100%答案金','3'=>'不中退120%答案金','4'=>'达不到60%以上退还全部答案金');
      $this->load->vars($data);
      
  }
  private function _get_cate()
  { 
    if ( ! $data = $this->cache->get('globals_cate')){
        $data = $this->public_model->category_list(); 
        // Save into the cache for 5 minutes
        $this->cache->save('globals_cate', $data, 300);
      }
      if(is_array($data)){
        $result['_globals_cate'] = $data; 
        $this->load->vars($result);  
        $this->_globals_cate = $data;
      }
  }
  private function _get_banner()
  { 
    if ( ! $data = $this->cache->get('globals_banner')){
        $data = $this->public_model->banner_list(); 
        // Save into the cache for 5 minutes
        $this->cache->save('globals_banner', $data, 300);
      }
      if(is_array($data)){
        $result['_globals_banner'] = $data; 
        $this->load->vars($result);  
      }
  }
  private function _get_setting()
  { 
    if ( ! $data = $this->cache->get('globals_setting')){
        $data = $this->public_model->setting_list(); 
        // Save into the cache for 5 minutes
        $this->cache->save('globals_setting', $data, 300);
      }
      if(is_array($data)){
        $result['_globals_setting'] = $data; 
        $this->load->vars($result);  
      }
  }
  private function _get_config()
  {
     if ( ! $data = $this->cache->get('globals_config')){
        $config = $this->public_model->get_config('BASE_CONFIG'); 
        $data = $config['value'];
        // Save into the cache for 5 minutes
          $this->cache->save('globals_config', $data, 300);
      }
      $config_arr = json_decode($data,true);
      if(is_array($config_arr)){
        $result['_web_name'] = $this->is_emtpy($config_arr['CONFIG_WEB_NAME']) ; 
        $result['_web_footer_copyright'] = $this->is_emtpy($config_arr['CONFIG_FOOTER_COPYRIGHT']) ; 
        $result['_web_footer_beian'] = $this->is_emtpy($config_arr['CONFIG_FOOTER_BEIAN']) ;
        $result['_web_header_keywords'] = $this->is_emtpy($config_arr['CONFIG_KEYWORDS']) ;
        $result['_web_header_content'] = $this->is_emtpy($config_arr['CONFIG_CONTENT']) ; 
        $this->load->vars($result);  
      } 
  }
  protected function config_clean()
  {
    $this->cache->delete('globals_config');
    $this->cache->delete('globals_cate');
    $this->cache->delete('globals_setting');
    $this->cache->delete('globals_banner');
  }
  private function is_emtpy($value)
  {
    if(isset($value)){
      return $value;
    }
    return "";
  }
  protected function _check_admin(){
    if (!$this->nativesession->get("admin_id")) {
        header('location:/admin/login');
        exit;
    }

  }



}