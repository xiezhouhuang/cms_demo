 <?php $this->load->view('public/header_view'); ?>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="layui-row">
        <div class="layui-col-sm4 layui-col-sm-offset4">
          <div class="layui-row layui-text ">
            <br/>
            <span class="h1-border">修改密码</span>
            <hr/>
            <br/>
          </div>
      <form class="layui-form" style="text-align: center;">
         <div class="layui-form-item">
            <label class="layui-form-label">新密码:</label>
            <div class="layui-input-inline">
               <input type="password" name="new_password"  lay-verify="required|pass" value="" class="layui-input">
            </div>
         </div>
         <div class="layui-form-item">
            <label class="layui-form-label">确认密码:</label>
            <div class="layui-input-inline">
               <input type="password" name="confirm_password"  lay-verify="required|comfirm_password" value="" class="layui-input">
            </div>
         </div>
         <br/>
         <br/>
         <input type="hidden" name="token" value="<?php echo $token ?>"   class="layui-input">
         <input type="hidden" name="token_name" value="<?php echo $token_name ?>"   class="layui-input">
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
        <a class="layui-btn layui-bg-red layui-btn-big" lay-filter="change_pwd" lay-submit="" >确定提交</a>
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
  var  pass  = $('input[name="new_password"]');
  form.verify({
   pass: [/(.+){6,12}$/, '密码必须6到12位']
   ,comfirm_password: function(value){
      console.log(pass.val());
      if(pass.val() != value){
         return  '两次密码不一致';
      }
   }
  });
  //监听提交
  form.on('submit(change_pwd)',function(data) {
       $.post('/login/do_forget_change_pwd/',data.field,function(data) {
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