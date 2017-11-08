<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>页面管理</cite></a>
              <a><cite><?php echo $title ?></cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
         <div class="x-body">
            <form class="layui-form layui-form-pane" action="">
                        <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">页面详细</label>
                        <div class="layui-input-block">
                          <textarea class="layui-textarea layui-hide" name="value" lay-verify="content"  id="page_detail"><?php echo isset($value)?$value:''; ?></textarea>
                        </div>
                      </div>
                        
                        <div class="layui-form-item">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                            <input type="hidden" name="key" value="<?php echo $key ?>">
                            <button class="layui-btn" lay-submit="" lay-filter="save">
                                保存
                            </button>
                        </div>
            </form>
        </div> 
        </form>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['element','layer','form','layedit'], function(){
                var $ = layui.jquery//jquery
                ,element = layui.element//面包导航
                ,form = layui.form//面包导航
                ,layedit = layui.layedit
               , layer = layui.layer;//弹出层
                //创建一个编辑器
              layedit.set({
                  uploadImage: {
                    url: '/upload/do_upload/' //接口url
                    ,data :{<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>'}
                    ,type: 'post' //默认post
                  }
                });
              var editIndex = layedit.build('page_detail');
              //自定义验证规则
              form.verify({
                content: function(value){
                  layedit.sync(editIndex);
                }
              });
                //监听提交
                form.on('submit(save)', function(data){
                   $.post('/admin/config/save',data.field,function (data) {
                        if(data.code == 0){
                            layer.msg('操作成功',{icon:1,time:800},function() {
                                location.reload();
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