<?php $this->load->view('public/header_view'); ?>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="member-box">
      <div class="layui-row">
        <?php $this->load->view('public/member_left_view'); ?>

        <div class="layui-col-sm10 member-box-right">
            <?php $this->load->view('public/member_right_top_view'); ?>
            <br />
            <div style="border: 1px solid #CCC;display: none;" class="member-info">
              <div class="layui-row layui-text ">
                <h2 class="layui-bg-gray">账户充值</h2>
                <br/>
                
              </div>

              <div class="layui-row layui-text">
                <div class="layui-col-sm11 layui-col-sm-offset1">
                  <form class="layui-form">
                    <div class="layui-form-item">
                      <label class="layui-form-label">充值账号:</label>
                      <div class="layui-input-inline" >
                        <input type="text" name="title" disabled="" value="564415@qq.com" class="layui-input layui-color-red layui-my-disabled">
                      </div>

                    </div>
                    <hr>
                    <div class="layui-form-item">
                      <label class="layui-form-label">充值金额</label>
                      <div class="layui-input-inline">
                        <input type="text" name="title" value="100.00" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">元 (金额格式: 100.00 请务必手机完善邮箱,身份证且手机已经完成验证)</div>
                    </div>
                    <hr >
                    <div class="layui-form-item">
                      <label class="layui-form-label"><input type="radio" name="payment" title=" " class="layui-input"></label>
                      <div class="layui-input-inline">
                        <img src="/public/img/weixinpay.png" height="42">
                      </div>
                      <label class="layui-form-label"><input type="radio" name="payment" title=" " class="layui-input"></label>
                      <div class="layui-input-inline">
                        <img src="/public/img/alipay.png" height="42">
                      </div>
                    </div>
                    <hr>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <div ><button class="layui-btn layui-btn-big layui-bg-red">立即充值</button></div>
                    <br />
                    <br />
                  </form>
                </div>
              </div>
            </div>
            <br />
            <div style="border: 1px solid #CCC" class="member-info" >
              <div class="layui-row layui-text ">
                <h2 class="layui-bg-gray">人工充值</h2>
                <br/>
                
              </div>

              <div class="layui-row layui-text ">
                <div class="layui-col-sm11 layui-col-sm-offset1">
                    <p><img src="/public/img/wxpay.png" width="30"> 微信人工流程:</p>
                    <?php echo $_globals_setting['WXCHONGZHI'] ?>
                    
                    <hr >
                    <p><img src="/public/img/alilogo.png" width="30"> 支付宝人工流程:</p>
                    <?php echo $_globals_setting['ALICHONGZHI'] ?>
                    <hr>
                    <br />
                    <br />
                </div>
              </div>
            </div>
            <br />
        </div>
      </div>
    </div>
    <br />
  </div>
</article>
<script type="text/javascript">
  function open_url_2 (title,url) {
    var w = 400;
    var h = 400;
    x_admin_show(title,url,w,h); 
  }
</script>
<?php $this->load->view('public/footer_view'); ?>