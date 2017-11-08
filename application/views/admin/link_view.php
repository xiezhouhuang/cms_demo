<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>系统管理</cite></a>
              <a><cite>友情链接</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form">
            <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
            <button class="layui-btn"  lay-filter="add" onclick="link_action('新增','/admin/link/detail')"><i class="layui-icon">&#xe608;</i>增加</button></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="60"><input type="checkbox" lay-skin="primary" name="" lay-filter="allChoose" value=""></th>
                        <th>标题</th>
                        <th>图片</th>
                        <th>链接</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($link_list as $link): ?>
                        <tr >
                            <td><input type="checkbox" lay-skin="primary" value="<?php echo $link['link_id'] ?>" name="link_id"></td>
                                <td><?php echo $link['link_name'] ?></td>
                                <td><img src="<?php echo $link['link_image'] ?>"  height="100"></td>
                                <td><?php echo $link['link_url'] ?></td>
                                <td><?php echo $link['sort'] ?></td>
                                <td class="td-manage">
                                    <a title="编辑" href="javascript:;"
                                    onclick="link_action('编辑','/admin/link/detail/<?php echo $link['link_id'] ?>')"
                                    class="ml-5" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" href="javascript:;" onclick="link_del('<?php echo $link['link_id'] ?>')" 
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
                //全选  
                form.on('checkbox(allChoose)', function(data){  
                    var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');  
                    child.each(function(index, item){  
                      item.checked = data.elem.checked;  
                    });  
                    form.render('checkbox');  
                }); 

            });
            
            //批量删除提交
             function delAll () {
                var checked = []; 
                $("input[name='link_id']:checked").each(function(){
                    checked.push($(this).val());
                }) 
                if(checked.length > 0){
                    layer.confirm('确认要删除吗？',function(index){
                        $.post('/admin/link/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                            layer.msg('删除成功', {icon: 1,time:800},function() {
                              location.reload();
                            });
                        });
                    });
                }else{
                    layer.msg('请勾选删除项!',{icon:2,time:800});
                }
                    
             }
             //-新增
            function link_action (title,url) {
                var w = 500;
                var h = 500;
                x_admin_show(title,url,w,h); 
            }
           
            /*-删除*/
            function link_del(id){
                layer.confirm('确认要删除吗？',function(index){
                     var checked  = [id];
                     $.post('/admin/link/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                        layer.msg('删除成功', {icon: 1,time:800},function() {
                             location.reload();
                        });
                     });
                });
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>