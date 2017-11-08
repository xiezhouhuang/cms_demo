<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php echo $_web_name ?></title>
<link rel="stylesheet" href="/public/css/layui.css?v=112312">
<link rel="stylesheet" href="/public/css/index.css?v=2123">
<link rel="stylesheet" href="/public/css/font/iconfont.css">
</head>
<body style="background-color: #f1f1f3">

<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
  <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<header > 
  <div class="layui-container" style="padding: 10px 0px;height: 100px;line-height: 100px;vertical-align: middle;">
     <div class="layui-col-sm9">
       <img src="/public/img/logo.png" height="70">
     </div>
     <div class="layui-col-sm3" style="text-align: right;">
       <span class="layui-breadcrumb" lay-separator="|">
                <a href="/login/">已有账号,马上登录</a>
                <a href="/">返回首页</a>
              </span>
     </div>
  </div>

</header>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="layui-row">
        <div class="layui-col-sm6 layui-col-sm-offset3">
          <div class="layui-row layui-text ">
            <br/>
            <span class="h1-border">注册</span>
            <hr/>
            <br/>
          </div>
          <form class="layui-form">
            <div class="layui-form-item">
            <label class="layui-form-label">用户名:</label>
            <div class="layui-input-block">
               <input type="text" name="username" value="" lay-verify="required|username" placeholder="请输入用户名"  class="layui-input">
            </div>
           </div>
           <div class="layui-form-item">
              <label class="layui-form-label">密 &nbsp;码:</label>
              <div class="layui-input-block">
                 <input type="password" name="password"  lay-verify="required|pass"  value="" placeholder="请输入密码" class="layui-input">
              </div>
           </div>
           <div class="layui-form-item">
              <label class="layui-form-label">确认密码:</label>
              <div class="layui-input-block">
                 <input type="password" name="confirm_password" lay-verify="required|comfirm_password" placeholder="请输入确认密码" value="" class="layui-input">
              </div>
           </div>
           <div class="layui-form-item">
              <label class="layui-form-label">电子邮箱:</label>
              <div class="layui-input-block">
                 <input type="text" name="email" lay-verify="required|email" placeholder="请输入邮箱" class="layui-input">
              </div>
           </div>
           <div class="layui-form-item">
              <label class="layui-form-label">QQ:</label>
              <div class="layui-input-block">
                 <input type="text" name="qq"  value="" placeholder="请输入QQ" class="layui-input">
              </div>
           </div>
           <div class="layui-form-item">
              <label class="layui-form-label">手机:</label>
              <div class="layui-input-block">
                 <input type="tel" name="phone"  lay-verify="required|phone" value="" placeholder="请输入手机" class="layui-input">
              </div>
           </div>
           <br/>
           <div style="text-align: center;">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
            <button class="layui-btn layui-bg-red" lay-filter="register" lay-submit="">提交注册信息</button>
            </div>
          </form>
        </div>
    </div>
    <br />
  </div>
</article>
<?php $this->load->view('public/page_footer_view'); ?>
<script type="text/javascript">
            layui.use(['form'],
            function() {
                var $ = layui.jquery
                ,form = layui.form
                ,layer = layui.layer;
                var  pass  = $('input[name="password"]');
                form.verify({
                  username: function(value){
                    if(value.length < 5){
                      return '用户名至少得5个字符啊';
                    }
                  }
                  ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                  ,comfirm_password: function(value){
                    if(pass.val() != value){
                        return  '两次密码不一致';
                    }
                  }
                });
                //监听提交
                form.on('submit(register)',
                function(data) {
                    $.post('/login/do_register/',data.field,function(data) {
                      if(data.code == 1){
                        layer.msg(data.data,{icon:1,time:800},function(data) {
                          location.href = "/member/index";
                        });
                      }else{
                        layer.msg(data.data,{icon:2,time:800});
                      }
                    })
                    
                    return false;
                });

            });
</script>