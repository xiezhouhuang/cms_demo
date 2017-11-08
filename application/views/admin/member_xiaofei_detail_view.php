<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">交易时间</label>
                    <div class="layui-input-inline">
                        <input type="text" name="item_1" lay-verify="required"
                        autocomplete="off" class="layui-input" value="">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">交易详情</label>
                    <div class="layui-input-inline">
                        <input type="text" name="item_2" 
                        autocomplete="off" class="layui-input" value="">
                    </div>
                  </div>
                </div>

                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">收入</label>
                    <div class="layui-input-inline">
                        <input type="text" name="item_3" 
                        autocomplete="off" class="layui-input" value="">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">支出</label>
                    <div class="layui-input-inline">
                        <input type="text" name="item_4" 
                        autocomplete="off" class="layui-input" value="">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">余额</label>
                    <div class="layui-input-inline">
                        <input type="text" name="item_5" 
                        autocomplete="off" class="layui-input" value="">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">类型</label>
                    <div class="layui-input-inline">
                        <input type="text" name="item_6" 
                        autocomplete="off" class="layui-input" value="">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-inline">
                    <label class="layui-form-label">备注</label>
                    <div class="layui-input-inline">
                        <input type="text" name="item_7" 
                        autocomplete="off" class="layui-input" value="">
                    </div>
                  </div>
                  <div class="layui-inline" style="display: none;">
                    <label class="layui-form-label">待定</label>
                    <div class="layui-input-inline">
                        <input type="text" name="item_8" 
                        autocomplete="off" class="layui-input" value="">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                       保存
                    </button>
                </div>
            </form>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['element','layer','form','layedit','upload'], function(){
              var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,layer = layui.layer//弹出层
               ,layedit = layui.layedit
               ,upload = layui.upload
              ,form = layui.form;
              //监听提交
              form.on('submit(save)', function(data){
                   $.post('/admin/member/xiaofei_save',data.field,function (data) {
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