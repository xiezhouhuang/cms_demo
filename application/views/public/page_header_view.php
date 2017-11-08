<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>直推网</title>
<link rel="stylesheet" href="/public/css/layui.css?v=123">
<link rel="stylesheet" href="/public/css/pg_layui.css?v=123">
<link rel="stylesheet" href="/public/css/index.css?v=123">
<link rel="stylesheet" href="/public/css/font/iconfont.css?v=122">
<link rel="shortcut icon" href="/public//public/img/favicon.ico" mce_href="/public//public/img/favicon.ico" type="image/x-icon">
<style type="text/css">
  article .layui-container{
    background: none;
  }
</style>
</head>
<body style="background-color: #f1f1f3">

<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?php 
    $index1 = "";
    $index2 = "";
    $index3 = "";
    $index4 = "";
    $index5 = "";
    if ($this->uri->segment(2) == 'static_page'){
      $index4   = "layui-this";
    }else if ($this->uri->segment(1) == '/'){
      $index5   = "layui-this";
    }else if($this->uri->segment(2) == 'team_index' ){
      $index2  = "layui-this";
    }else if($this->uri->segment(2) == 'team' ){
      $index3  = "layui-this";
    }else{
      $index1  = "layui-this";
    }
   ?>
<header style="background-color: #393D49;height: 51px">
    <div class="layui-container"  >
      <div class="layui-col-sm2" style="position: absolute;z-index: 999;left: 100px">
        <a href="/page/"><img src="/public/img/page_logo.png" height="108"></a>
      </div>
      <div class="layui-col-sm8 layui-col-sm-offset4">
        <nav class="layui-nav">
          <ul >
            <li class="layui-nav-item <?php echo $index1 ?>"><a href="/page/"> 首页直推</a></li>
            <li class="layui-nav-item  <?php echo $index2 ?>"><a href="/page/team_index/">团队智汇 </a></li>
            <li class="layui-nav-item <?php echo $index3 ?>"><a href="/page/team/"> 经典案例 </a></li>
            <li class="layui-nav-item <?php echo $index4 ?>"><a href="/page/static_page/WEBGONGYING"> 合作共赢 </a></li>
            <li class="layui-nav-item <?php echo $index5 ?>"><a href="/"> 我的直推网 </a></li>
          </ul>
        </nav>
      </div >
      </div>
</header>
