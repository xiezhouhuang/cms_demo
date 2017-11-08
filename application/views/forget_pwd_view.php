 <?php $this->load->view('public/header_view'); ?>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="layui-row">
        <div class="layui-col-sm5 layui-col-sm-offset3">
          <div class="layui-row layui-text ">
            <br/>
            <span class="h1-border">忘记密码</span>
            <hr/>
            <br/>
          </div>
          <form class="layui-form">
            <div class="layui-form-item">
            <label class="layui-form-label">邮箱:</label>
            <div class="layui-input-block">
               <input type="text" name="email" lay-verify="required|email"  class="layui-input">
            </div>
           </div>
           <div class="layui-form-item">
            <div class="layui-input-block layui-color-red">
               <i class="layui-icon">&#xe60b;</i>
               发送修改密码链接到您的邮箱,请查收
             </div>
           </div> 
           <div style="text-align: center;">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
              <a class="layui-btn layui-bg-red" lay-filter="forget_pwd" lay-submit="">确定发送</a>
            </div>
          </form>
        </div>
    </div>
    <br />
  </div>
</article>
 <?php $this->load->view('public/footer_view'); ?>
<script>
layui.use(['element', 'form'], function(){
  var $ = layui.jquery,form = layui.form ,layer = layui.layer;
  //监听提交
  form.on('submit(forget_pwd)',function(data) {
       $.post('/login/send_forget_pwd/',data.field,function(data) {
           if(data.code == 1){
              layer.msg(data.msg,{icon:1,time:1000},function(data) {
                location.href = "/login";
              });
           }else{
             layer.msg(data.msg,{icon:2,time:1000});
           }
      })
     return false;
  });                                            
});
</script>