<?php $this->load->view('public/header_view'); ?>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="member-box">
      <div class="layui-row">
        <?php $this->load->view('public/member_left_view'); ?>
        <div class="layui-col-sm10 member-box-right">
            
             <?php $this->load->view('public/member_right_top_view'); ?>
            <div class="layui-row layui-text">
              <br/>
              <span class="h1-border">提款</span>
              <hr/>
              <br/>
            </div>

            <div class="layui-row layui-text  member-info">
                <br />
                <br />
                <p>您的用户名 : <?php echo $member_info['username'] ?></p>
                <p>您的支付宝姓名 : <?php echo $account['account_name'] ?></p>
                <p>您的支付宝账号 : <?php echo $account['account_no'] ?> &nbsp;&nbsp;(退款将汇入此支付宝,确保该账户真实有效)</p>
                <br />
                
                <?php echo $_globals_setting['QUKUAN'] ?>

            </div>
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