<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">标题 </label>
                    <div class="layui-input-block">
                        <input placeholder="请输入标题" type="text" name="link_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($link['link_name'])?$link['link_name']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接 </label>
                    <div class="layui-input-block">
                        <input placeholder="请输入广告链接" type="text" name="link_url" required="" lay-verify=""
                        autocomplete="off" class="layui-input" value="<?php echo isset($link['link_url'])?$link['link_url']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-block">
                        <input type="text" id="sort" name="sort" required="" lay-verify="number"
                        autocomplete="off" class="layui-input" value="<?php echo isset($link['sort'])?$link['sort']:0; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片</label>
                        <div class="layui-input-inline">
                             <div class="layui-upload-drag" id="link_image">
                               <?php if(isset($link['link_image']) && !empty($link['link_image'])): ?>
                                   <img src="<?php echo $link['link_image'] ?>" height="100" class="layui-upload-img">
                                <?php else: ?>
                                  <i class="layui-icon">&#xe67c;</i>
                                  <p>点击上传，或将文件拖拽到此处</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del_file()" >删除</a></div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="link_id" value="<?php echo $link_id; ?>">
                    <input type="hidden" name="link_image" value="<?php echo isset($link['link_image'])?$link['link_image']:''; ?>">
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                        <?php if ($link_id > 0): ?>
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
            layui.use(['element','layer','form','upload'], function(){
              var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,layer = layui.layer//弹出层
               ,upload = layui.upload
              ,form = layui.form;

            //指定封面
                upload.render({
                  elem: '#link_image'
                  ,url: '/upload/do_upload/link'
                  ,data :{'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'}
                  ,accept: 'file' //普通文件
                  ,exts: 'jpg|png|gif|bmp|jpeg|svg' //只允许上传压缩文件
                  ,done: function(res){
                     if(res.code == 0){
                      $('#link_image').html('<img src="'+ res.data.src +'"  height="100"  class="layui-upload-img">');
                      $('input[name="link_image"]:hidden').val(res.data.src);
                     }else{
                      layer.alert(res.msg,{icon:2});
                    }
                  }
                });
              //监听提交
              form.on('submit(save)', function(data){
                   $.post('/admin/link/save',data.field,function (data) {
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
            function del_file() {
                $("#link_image").html('<i class="layui-icon">&#xe67c;</i><p>点击上传，或将文件拖拽到此处</p>');
                $('input[name="link_image"]:hidden').val('');
              }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>