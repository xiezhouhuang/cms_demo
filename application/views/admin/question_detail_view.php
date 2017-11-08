<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input type="text" placeholder="请输入标题" name="title" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($question['title'])?$question['title']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-block">
                        <input type="text" placeholder="请输入排序" name="sort" required="" lay-verify="number|required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($question['sort'])?$question['sort']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">内容</label>
                    <div class="layui-input-block">
                      <textarea placeholder="请输入内容" name="content" class="layui-textarea"><?php echo isset($question['content'])?$question['content']:''; ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                        <?php if ($id > 0): ?>
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
               ,layedit = layui.layedit
               ,upload = layui.upload
              ,form = layui.form;
              //监听提交
              form.on('submit(save)', function(data){
                   $.post('/admin/question/save',data.field,function (data) {
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
            });
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>