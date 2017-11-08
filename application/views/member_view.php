<?php $this->load->view('public/header_view'); ?>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="member-box">
      <div class="layui-row">
       <?php $this->load->view('public/member_left_view'); ?>
        <div class="layui-col-sm10 member-box-right" >
            <?php $this->load->view('public/member_right_top_view'); ?>
            <div class="layui-row layui-text member-info">
              <h2>个人中心</h2>
            </div>
            <hr/>
            <div class="layui-row layui-text member-info">
              <p>个人资料</p>
              <div class="layui-col-sm10 layui-col-sm-offset1 ">
                <form class="layui-form">
                  <div class="layui-form-item">
                    <label class="layui-form-label">用户名:</label>
                    <div class="layui-input-inline">
                      <input type="text" name="title" style="border: none;" disabled="" value="<?php echo $member_info['username'] ?>" class="layui-input">
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">E-mail:</label>
                    <div class="layui-input-inline">
                      <input type="text" name="title" disabled="" value="<?php echo $member_info['email'] ?>" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">如需修改请跟客服联系</div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">手 机:</label>
                    <div class="layui-input-inline">
                      <input type="text" name="title" disabled="" value="<?php echo $member_info['phone'] ?>" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">如需修改请跟客服联系</div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">Q Q:</label>
                    <div class="layui-input-inline">
                      <input type="text" name="title" value="<?php echo $member_info['qq'] ?>" disabled="" class="layui-input">
                    </div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <div class="layui-form-mid layui-word-aux">如需修改请跟客服联系</div>
                  </div>
                </form>
              </div>
            </div>
            <hr>
            <div class="layui-row layui-text like-table member-info">
              <div class="layui-col-sm12">
                  <table class="layui-table" lay-skin="nob">
                    <tr ><td colspan="5"><p>账号保护</p></td></tr>
                    <tr>
                      <td width="10%"></td>
                      <td width="60" valign="middle" align="center"><i class="layui-icon" style="font-size: 24px;">&#xe616;</i><br/>已完成</td>
                      <td width="80"><h3><b>用户密码</h3></b></td>
                      <td>账号登录密码,建议定期更换</td>
                      <td  width="30"><a href="javascript:;" onclick="open_url_2('修改密码','/member/change_pwd')" class="layui-color-red">修改</a></td>
                    </tr>
                    <tr ><td></td><td colspan="4"><hr></td></tr>
                     <tr>
                     <td width="20px"></td>
                      <td width="60"  align="center"><i class="layui-icon" style="font-size: 24px;">&#xe616;</i><br/>已认证</td>
                      <td width="80"><h3><b>手机认证</h3></b></td>
                      <td>非常重要:用户找回,银行卡绑定/修改和提款验证;以及接受短信通知等</td>
                      <td  width="30"></td>
                    </tr>
                    <tr ><td></td><td colspan="4"><hr></td></tr>
                    <tr ><td colspan="5"><p>资金保护</p></td></tr>
                    <tr>
                      <td width="10%"></td>
                      <td width="60"  valign="middle" align="center">
                      <?php if ($is_account): ?>
                          <i class="layui-icon" style="font-size: 24px;">&#xe616;</i><br/>已绑定
                        <?php else: ?>
                          <i class="layui-icon layui-color-red" style="font-size: 24px;">&#xe60b;</i><br/>未绑定
                          
                      <?php endif ?>
                      
                      </td>
                      <td width="80"><h3><b>提现设置</h3></b></td>
                      <td>以下设置将保密,不会对站内其他用户显示</td>
                      <td width="30"><a href="javascript:;" href="javascript;" onclick="open_url_2('提现设置','/member/bing_account')" class="layui-color-red">修改</a></td>
                    </tr>
                  </table>
              </div>
              
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
    var h = 300;
    x_admin_show(title,url,w,h); 
  }
</script>
<?php $this->load->view('public/footer_view'); ?>
