<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item" style="display: none;" >
                    <label class="layui-form-label">标题 </label>
                    <div class="layui-input-block">
                        <input placeholder="请输入标题" type="text" name="notice_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($notice['notice_name'])?$notice['notice_name']:'null'; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">内容 </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入通知内容" type="text" name="notice_content" required="" lay-verify=""
                        autocomplete="off" class="layui-textarea"><?php echo isset($notice['notice_content'])?$notice['notice_content']:''; ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block">
                        <input type="radio" name="status" value="0" title="隐藏" <?php if ((isset($notice['status']) && $notice['status'] == 0 )): ?> checked="" <?php endif ?>>
                          <input type="radio" name="status" value="1" title="显示"  <?php if(isset($notice['status']) && $notice['status'] == 1 || $notice_id == 0): ?> checked="" <?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="notice_style" value="<?php echo $notice_style; ?>">
                    <input type="hidden" name="notice_id" value="<?php echo $notice_id; ?>">
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                        <?php if ($notice_id > 0): ?>
                           修改
                           <?php else: ?> 
                            增加
                        <?php endif ?>
                    </button>
                </div>
            </form>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['element','layer','form'], function(){
              var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,layer = layui.layer//弹出层
              ,form = layui.form;

              //监听提交
              form.on('submit(save)', function(data){
                   $.post('/admin/notice/save',data.field,function (data) {
                        if(data.code == 0){
                            layer.msg('操作成功',{icon:1,time:800},function() {
                                parent.location.reload();
                            }); 

                        }else{
                            layer.msg('操作失败',{icon:2,time:800});
                        }
                        
                   });
                    return false;
              });
            });
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>