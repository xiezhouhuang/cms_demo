<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">等级名称</label>
                    <div class="layui-input-inline">
                        <input type="text" id="group_name" name="group_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($group_info['group_name'])?$group_info['group_name']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                        <?php if ($group_id > 0): ?>
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
                   $.post('/admin/member/member_group_save',data.field,function (data) {
                        if(data.code == 0){
                            layer.msg('操作成功',{icon:1,time:800},function() {
                                parent.location.reload();
                            }); 

                        }else{
                            layer.msg('失败',{icon:2,time:800});
                        }
                        
                   });
                    return false;
              });
            })
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>