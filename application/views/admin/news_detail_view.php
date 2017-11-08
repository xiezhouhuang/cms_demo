<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input type="text" placeholder="请输入标题" name="news_title" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($news['news_title'])?$news['news_title']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                    <label class="layui-form-label">资讯类型</label>
                    <div class="layui-input-inline">
                     
                       <select name="style">
                          <?php foreach ($_globals_news_style as $k =>$v): ?>
                            <option value="<?php echo $k ?>" <?php if (isset($news['style']) && $news['style'] == $k): ?> selected="" <?php endif ?>><?php echo $v ?></option>
                          <?php endforeach ?>
                       </select>
                    </div>
                    </div>
                    <div class="layui-inline">
                      <label class="layui-form-label">归类</label>
                      <div class="layui-input-inline">
                       <input type="text" placeholder="请输入归类" name="news_sub" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($news['news_sub'])?$news['news_sub']:''; ?>">
                       </select>
                    </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片</label>
                        <div class="layui-input-inline">
                             <div class="layui-upload-drag" id="news_img">
                               <?php if(isset($news['news_img']) && !empty($news['news_img'])): ?>
                                   <img src="<?php echo $news['news_img'] ?>" height="100" class="layui-upload-img">
                                <?php else: ?>
                                  <i class="layui-icon">&#xe67c;</i>
                                  <p>点击上传，或将文件拖拽到此处</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del_file()" >删除</a></div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">简介</label>
                    <div class="layui-input-block">
                      <textarea placeholder="请输入简介" name="news_desc" class="layui-textarea"><?php echo isset($news['news_desc'])?$news['news_desc']:''; ?></textarea>
                    </div>
                  </div>
                  <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">详情</label>
                    <div class="layui-input-block">
                      <textarea class="layui-textarea layui-hide" name="news_content" lay-verify="content"  id="news_content"><?php echo isset($news['news_content'])?$news['news_content']:''; ?></textarea>
                    </div>
                  </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="news_id" value="<?php echo $news_id; ?>">
                     <input type="hidden" name="news_img" value="<?php echo isset($news['news_img'])?$news['news_img']:''; ?>">
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                        <?php if ($news_id > 0): ?>
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
            layui.use(['element','layer','form','layedit','upload'], function(){
              var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,layer = layui.layer//弹出层
               ,layedit = layui.layedit
               ,upload = layui.upload
              ,form = layui.form;
              //指定封面
                upload.render({
                  elem: '#news_img'
                  ,data :{'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'}
                  ,url: '/upload/do_upload/news'
                  ,accept: 'file' //普通文件
                  ,exts: 'jpg|png|gif|bmp|jpeg|svg' //只允许上传压缩文件
                  ,done: function(res){
                     if(res.code == 0){
                      $('#news_img').html('<img src="'+ res.data.src +'"  height="100"  class="layui-upload-img">');
                      $('input[name="news_img"]:hidden').val(res.data.src);
                     }else{
                      layer.alert(res.msg,{icon:2});
                    }
                  }
                });
              //创建一个编辑器
              layedit.set({
                  uploadImage: {
                    url: '/upload/do_upload/' //接口url
                    ,data :{<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>'}
                    ,type: 'post' //默认post
                  }
                });
              var editIndex = layedit.build('news_content');
              form.verify({
                content: function(value){
                  layedit.sync(editIndex);
                }
              });
              //监听提交
              form.on('submit(save)', function(data){
                   $.post('/admin/news/save',data.field,function (data) {
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