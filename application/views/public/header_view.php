<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="/public/img/favicon.ico" mce_href="/public/img/favicon.ico" type="image/x-icon">
<title><?php echo $_web_name ?></title>
<link rel="stylesheet" href="/public/css/layui.css?v=23">
<link rel="stylesheet" href="/public/css/index.css?v=23">
<link rel="stylesheet" href="/public/css/font/iconfont.css">
</head>
<body>

<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<header> 
  <div class="layui-container" style="margin:10px auto;vertical-align: middle;">
      
      <div class="layui-container layui-row " style="height: 28px">
          <?php if($this->nativesession->get("session_member_id") <= 0): ?>
            <form class="layui-form">
          <div class="layui-col-sm2" style="padding-right: 10px">
            <input type="text" placeholder="用户名" name="username" class="layui-input">
          </div>
          <div class="layui-col-sm2" style="padding-right: 10px" >
            <input type="password" placeholder="密码" name="password" class="layui-input">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
          </div>
          <div class="layui-col-sm4">
            <div class="breadcrumb-box" style="padding: 0px;">
              <span class="layui-breadcrumb " lay-separator="|" >
                <a href="javascript:void(0)" lay-filter="login" lay-submit="">登录</a>
                <a href="/register/">注册</a>
              </span>
            </div>
          </div>
          </form>
          <?php else: ?>
            <div class="layui-col-sm8 breadcrumb-box" style="padding: 0px;height: 28px;line-height: 28px">
               <a href="/member/" class="layui-color-red" >
                  <?php echo $this->nativesession->get("session_member_name") ?> 
                 </a>
                 <span>&nbsp;&nbsp;&nbsp; 答案金 : </span>
                 <span class="layui-color-red" id="top_member_balance">加载中</span>
                 元 &nbsp;| &nbsp;
               <a href="/login/logout">退出</a>
            </div>
          <?php endif; ?>
          <div class="layui-col-sm3" >
            <img src="/public/img/lanqiu_name.png" height="20"  >
          </div>
      </div>
      
  </div>
  <div class="logo_box">
    <div class="layui-container">
        <div class="layui-col-sm3" style="line-height: 73px;"><a href="/"><img src="/public/img/logo.png" width="170"></a></div>
        <div class="layui-col-sm1 layui-col-md-offset6">
          <a href="/member/chongzhi" >
            <div  class="chongzhi-btn"></div>
            充值入款
          </a>   
        </div>
        <div class="layui-col-sm1" style="width: 10px"><img src="/public/img/fg2.jpg" height="60"></div>
        <div class="layui-col-sm1">
          <a href="/member">
            <div class="gerenzhongxin-btn"></div>
            个人中心
          </a>       
        </div>
        
    </div>
  </div>


<?php 
    $index1 = "";
    $index2 = "";
    $index3 = "";
    $index4 = "";
    $index5 = "";
    if ($this->uri->segment(2) == 'news'){
      $index4   = "layui-this";
    }else if ($this->uri->segment(1) == 'page'){
      $index5   = "layui-this";
    }else if($this->uri->segment(2) == 'baoying' ){
      $index2  = "layui-this";
    }else if($this->uri->segment(2) == 'history' ){
      $index3  = "layui-this";
    }else{
      $index1  = "layui-this";
    }
   ?>
  <div class="layui-clear">
    <nav class="layui-nav">
      <ul class="layui-container">
        <li class="layui-nav-item <?php echo $index1 ?> nav1"><a href="/"> 首页直推</a></li>
        <li class="layui-nav-item nav-fg"><img src="/public/img/fg.jpg"></li>
        <li class="layui-nav-item  nav2 <?php echo $index2 ?>"><a href="/home/baoying/">包赢直推 &nbsp;&nbsp;<img src="/public/img/sub2.png" style="vertical-align: sub;"></a>
        </li>
          <li class="layui-nav-item nav-fg"><img src="/public/img/fg.jpg"></li>
        <li class="layui-nav-item nav3 <?php echo $index3 ?>"><a href="/home/history/"> 推荐战绩</a></li>
         <li class="layui-nav-item nav-fg"><img src="/public/img/fg.jpg"></li>
        <li class="layui-nav-item nav4 <?php echo $index4 ?>"><a href="/home/news/"> 内部资讯</a></li>
         <li class="layui-nav-item nav-fg"><img src="/public/img/fg.jpg"></li>
        <li class="layui-nav-item nav5 <?php echo $index5 ?>"><a href="/page/"> 团队智汇</a></li>
      </ul>
    </nav>
  </div>
</header>
