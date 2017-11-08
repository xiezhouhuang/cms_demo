<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>等级列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form">
            <xblock>
                <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
                <button class="layui-btn"  lay-filter="add" onclick="group_action('新增','/admin/member/member_group_detail')"><i class="layui-icon">&#xe608;</i>增加</button>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>等级名称</th>
                        <th>会员数量</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($group_list as $group): ?>
                        <tr >
                            <td><?php echo $group['group_id'] ?></td>
                                <td><?php echo $group['group_name'] ?></td>
                                <td><?php echo $group['member_num'] ?></td>
                                <td class="td-manage">
                                    <a title="编辑" href="javascript:;"
                                    onclick="group_action('编辑','/admin/member/member_group_detail/<?php echo $group['group_id'] ?>')"
                                    class="ml-5" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" href="javascript:;" onclick="group_del('<?php echo $group['group_id'] ?>','<?php echo $group['member_num'] ?>')" 
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
            function group_action (title,url) {
                var w = '';
                var h = '';
                x_admin_show(title,url,w,h); 
            }
            
            /*-删除*/
            function group_del(id,num){
                if(num > 0){
                    layer.msg('该等级下有'+num+'个会员,无法删除', {icon: 2,time:800});
                    return;
                }
                layer.confirm('确认要删除吗？',function(index){
                     $.post('/admin/member/member_group_del',{id:id,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                        layer.msg('删除成功', {icon: 1,time:800},function() {
                             location.reload();
                        });
                     });
                });
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>