<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>系统管理</cite></a>
              <a><cite>系统设置</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
         <div class="x-body">
            <form class="layui-form layui-form-pane" action="">
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                网站名称
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="CONFIG_WEB_NAME" autocomplete="off" placeholder="控制在25个字、50个字节以内"
                                class="layui-input" value="<?php echo isset($CONFIG_WEB_NAME)?$CONFIG_WEB_NAME:"" ?>">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                关键词
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="CONFIG_KEYWORDS" autocomplete="off" placeholder="5个左右,8汉字以内,用英文,隔开" value="<?php echo isset($CONFIG_KEYWORDS)?$CONFIG_KEYWORDS:"" ?>" 
                                class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                
                                描述
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="CONFIG_CONTENT" autocomplete="off" placeholder="空制在80个汉字，160个字符以内" value="<?php echo isset($CONFIG_CONTENT)?$CONFIG_CONTENT:"";?>" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                底部版权信息
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="CONFIG_FOOTER_COPYRIGHT" autocomplete="off" placeholder="&copy; 2016 X-admin"
                                class="layui-input" value="<?php echo isset($CONFIG_FOOTER_COPYRIGHT)?$CONFIG_FOOTER_COPYRIGHT:"" ?>">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">
                                
                                备案号
                            </label>
                            <div class="layui-input-block">
                                <input type="text" name="CONFIG_FOOTER_BEIAN" autocomplete="off" placeholder="京ICP备00000000号"
                                class="layui-input" value="<?php echo isset($CONFIG_FOOTER_BEIAN)?$CONFIG_FOOTER_BEIAN:"" ?>">
                            </div>
                        </div>
                        <div class="layui-form-item">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                            <input type="hidden" name="key" value="BASE_CONFIG">
                            <button class="layui-btn" lay-submit="" lay-filter="save">
                                保存
                            </button>
                        </div>
            </form>
        </div> 
        </form>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['element','layer','form'], function(){
                var $ = layui.jquery//jquery
                ,element = layui.element//面包导航
                ,form = layui.form//面包导航
               , layer = layui.layer;//弹出层
                //全选  
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