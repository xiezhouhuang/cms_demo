 <?php $this->load->view('public/header_view'); ?>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="layui-row">
        <div class="layui-col-sm4 layui-col-sm-offset4">
          <div class="layui-row layui-text ">
            <br/>
            <span class="h1-border">登录</span>
            <hr/>
            <br/>
          </div>
          <form class="layui-form">
            <div class="layui-form-item">
            <label class="layui-form-label">用户名:</label>
            <div class="layui-input-block">
               <input type="text" name="username" value="" class="layui-input">
            </div>
           </div>
           <div class="layui-form-item">
              <label class="layui-form-label">密 &nbsp;码:</label>
              <div class="layui-input-block">
                 <input type="password" name="password"  value="" class="layui-input">
              </div>
           </div>
           <div class="layui-form-item" style="float: right;">
            <div class="layui-input-block">
              <a href="/login/forget_pwd">忘记密码?</a>
            </div>
           </div>
           <br/>
           <div class="layui-clear"></div>
           <div style="text-align: center;">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
            <button class="layui-btn layui-bg-red" lay-filter="login" lay-submit="">确定登录</button>
            </div>
          </form>
        </div>
    </div>
    <br />
  </div>
</article>
<?php $this->load->view('public/footer_view'); ?>