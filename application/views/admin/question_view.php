<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>页面管理</cite></a>
              <a><cite>常见问题</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form">
            <xblock>
            <button class="layui-btn"  lay-filter="add" onclick="question_action('新增','/admin/question/detail')"><i class="layui-icon">&#xe608;</i>增加</button></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>标题</th>
                        <th>内容</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($question_list as $question): ?>
                        <tr >
                                <td><?php echo $question['title'] ?></td>
                                <td><?php echo $question['content'] ?></td>
                                <td><?php echo $question['sort'] ?></td>
                                <td class="td-manage">
                                    <a title="编辑" href="javascript:;"
                                    onclick="question_action('编辑','/admin/question/detail/<?php echo $question['id'] ?>')"
                                    class="ml-5" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" href="javascript:;" onclick="question_del('<?php echo $question['id'] ?>')" 
                                    style="text-decoration:none">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                </td>
                            </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['element','layer','form'], function(){
                var $ = layui.jquery//jquery
                ,element = layui.element//面包导航
                ,form = layui.form//面包导航
               , layer = layui.layer;//弹出层
            });
             //-新增
            function question_action (title,url) {
                var w = '';
                var h = 400;
                x_admin_show(title,url,w,h); 
            }
           
            /*-删除*/
            function question_del(id){
                layer.confirm('确认要删除吗？',function(index){
                     $.post('/admin/question/del',{id:id,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                        layer.msg('删除成功', {icon: 1,time:800},function() {
                             location.reload();
                        });
                     });
                });
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>