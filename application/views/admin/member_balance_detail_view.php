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
                    <label class="layui-form-label">余额 </label>
                    <div class="layui-input-inline">
                        <input  type="text" disabled="" class="layui-input" value="<?php echo $member['balance'] ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label"><?php echo $action_msg ?>金额 </label>
                    <div class="layui-input-inline">
                        <input  type="text"  class="layui-input" name="balance" id="balance" lay-verify="required|number" value="">
                    </div>
                  </div>
                  <div class="layui-inline">
                  <input type="hidden" name="member_id" value="<?php echo $member['member_id'] ?>">
                  <input type="hidden" name="action" value="<?php echo $action ?>">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <a  href="javascript:;" class="layui-btn" lay-filter="chognzhi" lay-submit="">确定<?php echo $action_msg ?></a>
                  </div>
                </div>
                </div>  
              
          </form>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['element','form','layer'], function(){
              var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,layer =  layui.layer
              ,form = layui.form;
              form.on('submit(chognzhi)',function(data) {
                  var  balance =  $('#balance').val();
                  layer.confirm("确定要为<?php echo $member['username'] ?><?php echo $action_msg ?>"+balance+"金币吗?",function(msg) {
                     $.post('/admin/member/do_balance_change',data.field,function(data) {
                         if(data.code == 0){
                            layer.msg('<?php echo $action_msg ?>成功',{icon:1,time:800},function() {
                                parent.location.reload();
                            }); 

                        }else{
                            layer.msg('<?php echo $action_msg ?>失败',{icon:2,time:800});
                        }
                     })
                  })
              })
            });
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>