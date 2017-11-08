<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title></title>
<link rel="stylesheet" href="/public/css/layui.css?v=222">
<link rel="stylesheet" href="/public/css/index.css?v=122">

</head>
<article>
  <div class="layui-container layui-text">
      <br/>
      <br/>
    <form class="layui-form" style="text-align: center;">
       	<div class="layui-form-item">
            <label class="layui-form-label">旧密码:</label>
            <div class="layui-input-inline">
               <input type="password" name="old_password" value="" lay-verify="required"  class="layui-input">
            </div>
         </div>
         <div class="layui-form-item">
            <label class="layui-form-label">新密码:</label>
            <div class="layui-input-inline">
               <input type="password" name="password"  lay-verify="required|pass" value="" class="layui-input">
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
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
      	<a class="layui-btn layui-bg-red layui-btn-big" lay-filter="change_pwd" lay-submit="" >确定提交</a>
    </form>
  </div>

</article>
<script src="/public/layui.js"></script>
<script>
layui.use(['element', 'form'], function(){
  var $ = layui.jquery,form = layui.form ,layer = layui.layer;
  var  pass  = $('input[name="password"]');
  form.verify({
   pass: [/(.+){6,12}$/, '密码必须6到12位']
   ,comfirm_password: function(value){
      if(pass.val() != value){
         return  '两次密码不一致';
      }
   }
  });
  //监听提交
  form.on('submit(change_pwd)',function(data) {
       $.post('/member/do_change_pwd/',data.field,function(data) {
           if(data.code == 1){
              layer.msg(data.msg,{icon:1,time:800},function(data) {
                parent.location.href = "/member/index";
              });
           }else{
             layer.msg(data.msg,{icon:2,time:800});
           }
      })
     return false;
  });                                            
});
</script>
</body>
</html>
