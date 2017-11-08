<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">会员名 </label>
                    <div class="layui-input-inline">
                        <input  type="text" disabled="" class="layui-input" value="<?php echo $member['username'] ?>">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">邮箱 </label>
                    <div class="layui-input-inline">
                        <input  type="text" disabled="" class="layui-input" value="<?php echo $member['email']; ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">牛币 </label>
                    <div class="layui-input-inline">
                        <input type="text" disabled="" class="layui-input" value="<?php echo $member['balance'] ?>">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">牛毛 </label>
                    <div class="layui-input-inline">
                        <input type="text" disabled="" class="layui-input" value="<?php echo $member['points']; ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">所在组 </label>
                    <div class="layui-input-inline">
                        <input  type="text" disabled="" class="layui-input" value="<?php echo isset($group['group_name'])?$group['group_name']:''; ?>">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">真实姓名 </label>
                    <div class="layui-input-inline">
                        <input type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['realname'])?$member_info['realname']:''; ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">性别 </label>
                    <div class="layui-input-inline">
                        <input  type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['gender'])?$group['gender']:''; ?>">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">生日 </label>
                    <div class="layui-input-inline">
                        <input type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['birthday'])?$member_info['birthday']:''; ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">手机 </label>
                    <div class="layui-input-inline">
                        <input  type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['phone'])?$group['phone']:''; ?>">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">QQ </label>
                    <div class="layui-input-inline">
                        <input type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['qq'])?$member_info['qq']:''; ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">省份 </label>
                    <div class="layui-input-inline">
                        <input  type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['province'])?$group['province']:''; ?>">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">城市 </label>
                    <div class="layui-input-inline">
                        <input type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['city'])?$member_info['city']:''; ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">工作年限 </label>
                    <div class="layui-input-inline">
                        <input  type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['job_year'])?$group['job_year']:''; ?>">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">擅长领域 </label>
                    <div class="layui-input-inline">
                        <input type="text" disabled="" class="layui-input" value="<?php echo isset($member_info['good_tool'])?$member_info['good_tool']:''; ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">简介 </label>
                    <div class="layui-input-block">
                        <textarea disabled="" class="layui-textarea" value=""><?php echo isset($member_info['jianjie'])?$group['jianjie']:''; ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">支付绑定 </label>
                    <div class="layui-input-block">
                      <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                        <?php foreach ($account as $v): ?>
                          <?php if ($v['account_style'] == 1): ?>
                              <p>支付宝:<?php echo $v['account_name'] ?>(<?php echo $v['account_no'] ?>)</p>
                          <?php elseif($v['account_style'] == 2): ?>
                              <p>微信:<?php echo $v['account_name'] ?>(<?php echo $v['account_no'] ?>)</p>
                          <?php endif ?>
                        <?php endforeach ?>
                      </blockquote>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">身份认证 </label>
                    <div class="layui-input-block">
                      <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                        <?php if (!empty($idcard)): ?>
                          <p>姓名:<span class="x-red"><?php echo $idcard['name'] ?></span></p>
                          <p>身份证: <span class="x-red"><?php echo $idcard['card_num'] ?></span></p>
                          <p>过期时间:<?php echo $idcard['expiration_date'] ?></p>
                          <p>正面照:<img src="<?php echo $idcard['z_img'] ?>" height="200"> 反面照:<img src="<?php echo $idcard['f_img'] ?>" height="200"></p>
                        <?php endif ?>
                      </blockquote>
                    </div>
                </div>
              </div>
          </form>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['element','form'], function(){
              var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,form = layui.form;
            });
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>