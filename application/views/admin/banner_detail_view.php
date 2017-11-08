<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item" style="display: none;">
                    <label class="layui-form-label">广告名 </label>
                    <div class="layui-input-block">
                        <input placeholder="请输入广告名" type="text" name="banner_name" 
                        autocomplete="off" class="layui-input" value="<?php echo isset($banner['banner_name'])?$banner['banner_name']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item" style="display: none;">
                    <label class="layui-form-label">广告链接 </label>
                    <div class="layui-input-block">
                        <input placeholder="请输入广告链接" type="text" name="banner_url"
                        autocomplete="off" class="layui-input" value="<?php echo isset($banner['banner_url'])?$banner['banner_url']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片位置 </label>
                    <div class="layui-input-block">
                        <select name="banner_style">
                          <?php foreach ($_globals_banner_style as $k =>$v): ?>
                            <option value="<?php echo $k ?>" <?php if (isset($banner['banner_style']) && $banner['banner_style'] == $k): ?> selected="" <?php endif ?>><?php echo $v ?></option>
                          <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item"  style="display: none;">
                    <label class="layui-form-label">排序</label>
                    <div class="layui-input-block">
                        <input type="text" id="sort" name="sort" required="" lay-verify="number"
                        autocomplete="off" class="layui-input" value="<?php echo isset($banner['sort'])?$banner['sort']:0; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片</label>
                        <div class="layui-input-inline">
                             <div class="layui-upload-drag" id="banner_image">
                               <?php if(isset($banner['banner_image']) && !empty($banner['banner_image'])): ?>
                                   <img src="<?php echo $banner['banner_image'] ?>" height="100" class="layui-upload-img">
                                <?php else: ?>
                                  <i class="layui-icon">&#xe67c;</i>
                                  <p>点击上传，或将文件拖拽到此处</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del_file()" >删除</a></div>
                </div>
                <?php if ($banner['banner_style'] == 0): ?>
                  <div class="layui-form-item">
                      <label class="layui-form-label">大图</label>
                          <div class="layui-input-inline">
                               <div class="layui-upload-drag" id="big_image">
                                 <?php if(isset($banner['big_image']) && !empty($banner['big_image'])): ?>
                                     <img src="<?php echo $banner['big_image'] ?>" height="100" class="layui-upload-img">
                                  <?php else: ?>
                                    <i class="layui-icon">&#xe67c;</i>
                                    <p>点击上传，或将文件拖拽到此处</p>
                                  <?php endif; ?>
                              </div>
                          </div>
                      <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del_file()" >删除</a></div>
                  </div>
                <?php endif ?>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="banner_id" value="<?php echo $banner_id; ?>">
                    <input type="hidden" name="banner_image" value="<?php echo isset($banner['banner_image'])?$banner['banner_image']:''; ?>">
                    <input type="hidden" name="big_image" value="<?php echo isset($banner['big_image'])?$banner['big_image']:''; ?>">
                    
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                        <?php if ($banner_id > 0): ?>
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
                  elem: '#banner_image'
                  ,url: '/upload/do_upload/banner'
                  ,data :{'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'}
                  ,accept: 'file' //普通文件
                  ,exts: 'jpg|png|gif|bmp|jpeg|svg' //只允许上传压缩文件
                  ,done: function(res){
                     if(res.code == 0){
                      $('#banner_image').html('<img src="'+ res.data.src +'"  height="100"  class="layui-upload-img">');
                      $('input[name="banner_image"]:hidden').val(res.data.src);
                     }else{
                      layer.alert(res.msg,{icon:2});
                    }
                  }
                });
                //指定封面
                upload.render({
                  elem: '#big_image'
                  ,url: '/upload/do_upload/banner'
                  ,data :{'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'}
                  ,accept: 'file' //普通文件
                  ,exts: 'jpg|png|gif|bmp|jpeg|svg' //只允许上传压缩文件
                  ,done: function(res){
                     if(res.code == 0){
                      $('#big_image').html('<img src="'+ res.data.src +'"  height="100"  class="layui-upload-img">');
                      $('input[name="big_image"]:hidden').val(res.data.src);
                     }else{
                      layer.alert(res.msg,{icon:2});
                    }
                  }
                });
              //监听提交
              form.on('submit(save)', function(data){
                   $.post('/admin/banner/save',data.field,function (data) {
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
                $("#banner_image").html('<i class="layui-icon">&#xe67c;</i><p>点击上传，或将文件拖拽到此处</p>');
                $('input[name="banner_image"]:hidden').val('');
              }
               function del_file2() {
                $("#big_image").html('<i class="layui-icon">&#xe67c;</i><p>点击上传，或将文件拖拽到此处</p>');
                $('input[name="big_image"]:hidden').val('');
              }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>