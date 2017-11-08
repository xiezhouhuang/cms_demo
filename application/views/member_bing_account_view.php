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
            <label class="layui-form-label">真正姓名:</label>
            <div class="layui-input-inline">
               <input type="text" name="account_name" value="<?php echo isset($account['account_name'])?$account['account_name']:"" ?>" lay-verify="required" class="layui-input">
            </div>
         </div>
         <div class="layui-form-item">
            <label class="layui-form-label">支付宝账号:</label>
            <div class="layui-input-inline">
               <input type="text" name="account_no"  lay-verify="required" value="<?php echo isset($account['account_no'])?$account['account_no']:"" ?>" class="layui-input">
            </div>
         </div>
         <br/>
         <br/>
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
         <input type="hidden" name="account_id" value="<?php echo isset($account['account_id'])?$account['account_id']:0 ?>">
      	<button class="layui-btn layui-bg-red layui-btn-big" lay-filter="bing_account" lay-submit="">确定</button>
    </form>
  </div>

</article>
<script src="/public/layui.js"></script>
<script>
layui.use(['element', 'form'], function(){
  var $ = layui.jquery
                ,form = layui.form
                ,layer = layui.layer;
                //监听提交
                form.on('submit(bing_account)',
                function(data) {
                    $.post('/member/do_bing_account/',data.field,function(data) {
                      if(data.code == 1){
                        layer.msg("绑定成功",{icon:1,time:800},function(data) {
                          parent.location.href = "/member/index";
                        });
                      }else{
                        layer.msg("绑定失败",{icon:2,time:800});
                      }
                    })
                    
                    return false;
                });

});
</script>
</body>
</html>
