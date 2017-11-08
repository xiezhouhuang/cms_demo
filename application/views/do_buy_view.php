<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title></title>
<link rel="stylesheet" href="/public/css/layui.css?v=222">
<link rel="stylesheet" href="/public/css/index.css?v=122">
<style type="text/css">
  .duiwu{
    padding: 5px 10px;
    text-align: center;
    width: 80px;
    display: block;
    font-size: 20px;

  }
  .duiwu span{
    font-size: 14px;
  }
  .buy-content .layui-col-sm2,.buy-content .layui-col-sm3{
    text-align: center;
    padding-top: 25px;
    font-size: 20px;
  }
  .buy-content .layui-col-sm4{
    text-align: center;
  }
  .buy-content .my-yue{
    margin: 10px 0px;
    text-align: center; 
    padding: 20px 0px;
    border-top: 2px solid #E2E2E2;
    border-bottom: 2px solid #E2E2E2;
    font-size: 18px;
  }
  .buy-content p,.buy-content .layui-form-radio  span{
    font-size: 18px;
  }
  .buy-content .to-buy-box{
    text-align: center;margin: 10px 0px;
  }
</style>
</head>
<article class="buy-content">
  <div class="layui-container layui-text">
      <div class="layui-row layui-col-space5" style="padding: 10px 0px">
          <div class="layui-col-sm2" style="">
            <div class="duiwu layui-bg-red"><?php echo $product['zhudui'] ?><br/><span>(主)</span></div>
          </div>
          <div class="layui-col-sm4">
            <h3><?php echo $_globals_bisai_style[$product['bisai_style']] ?></h3>
            <h1>VS</h1>
            <h4><?php echo $product['start_date'] ?></h4>
          </div>
          <div class="layui-col-sm2"  >
            <div class="duiwu layui-bg-red"><?php echo $product['kedui'] ?><br/><span>(主)</span></div>
          </div>
          <div class="layui-col-sm2" style="border-left:2px solid #E2E2E2;" >
            <h3><b><?php echo $_globals_product_hot[$product['hot']] ?><?php echo$product['product_tags'] ?></b></h3>
            <br />
            <p><span class="layui-color-red"><?php echo $product['pankou'] ?></span></p>
          </div>
           <div class="layui-col-sm2" style="border-left:2px solid #E2E2E2;" >
            <h3><b>直推答案金</b></h3>
            <br />
            <p><span class="layui-color-red"><?php echo $product['product_price'] ?>金币</span></p>
          </div>
      </div>
      <div class="layui-bg-gray my-yue">您的余额: <span class="layui-color-red"><span id="my_balance">加载中..</span>金币</span></div>
      <form class="layui-form">
      <div class="layui-row">
        
          <div class="layui-col-sm9 layui-col-sm-offset3">
              <p style="margin-left: -50px">请选择购买方式:</p>
              <p >
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                <input type="radio" checked="" class="layui-input" name="price" title="使用金币购买">
              </p>
              <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
              <input type="hidden" name="product_price" value="<?php echo $product['product_price'] ?>">
              <p class="layui-color-red" style="padding-left: 30px">应付:<?php echo $product['product_price'] ?>金币</p>
          </div>
        
      </div>
      <div class="to-buy-box">
      <a href="javascript:;" class="layui-btn layui-bg-red layui-btn-big" lay-filter="to_by" lay-submit="">立即购买</a>
      </div>
      </form>
  </div>

</article>
<script src="/public/layui.js"></script>
<script>
layui.use(['element', 'form'], function(){
  var $ = layui.jquery, element = layui.element,form = layui.form;
  var  can_buy =  false;
   $.get('/member/get_member/',function(data) {
      var balance  = parseFloat(data.member_info.balance);
      var product_price  = parseFloat('<?php echo $product['product_price'] ?>');
      if(balance >= product_price){
        can_buy = true;
      }
      $('#my_balance').empty().html(data.member_info.balance);
   })

   form.on('submit(to_by)',function(data) {
    if(can_buy){
        layer.confirm('是否确定要购买?', function(index){
           $.post('/home/do_buy_handle',data.field,function(data) {
            if(data.code == 1){
              layer.msg(data.msg,{icon:1,time:800},function(data) {
                parent.location.href = "/home/product_detail/<?php echo $product['product_id'] ?>";
              });
            }else{
              layer.msg(data.msg,{icon:2,time:800});
            }
          })
        });    
        
     }else{
        layer.msg("您的余额不足,请及时充值",{icon:2,time:800});
     }
   })
});
</script>
</body>
</html>
