<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>产品管理</cite></a>
              <a><cite>分类管理</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form">
            <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
            <button class="layui-btn"  lay-filter="add" onclick="cate_action('新增','/admin/category/detail')"><i class="layui-icon">&#xe608;</i>增加</button></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="60"><input type="checkbox" lay-skin="primary" name="" lay-filter="allChoose" value=""></th>
                        <th>分类名</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody >
                    <?php 
                     function category($list,$sub = 0)
                    {   

                        foreach ($list as $category) {
                          echo '<tr>
                                <td> <input type="checkbox" lay-skin="primary" value="'.$category['category_id'].'" name="category_id"></td>
                                <td>'.str_repeat("-- ",$sub).$category['category_name'].'</td>
                                <td>'. $category['sort'].'</td>
                                <td class="td-manage">
                                    <a title="编辑" href="javascript:;"
                                    onclick="cate_action(\'编辑\',\'/admin/category/detail/'.$category['category_id'].'\')"
                                    class="ml-5" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" href="javascript:;" onclick="cate_del(\''.$category['category_id'].'\')" 
                                    style="text-decoration:none">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                </td>
                            </tr>';
                            if(!empty($category['sub_child'])){
                                category($category['sub_child'],$sub+1);
                            }
                        } 
                    }
                    ?>
                    <?php category($category_list); ?>
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
                $("input[name='category_id']:checked").each(function(){
                    checked.push($(this).val());
                }) 
                if(checked.length > 0){
                    layer.confirm('确认要删除吗？',function(index){
                        $.post('/admin/category/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
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
            function cate_action (title,url) {
                var w = 500;
                var h = 300;
                x_admin_show(title,url,w,h); 
            }
           
            /*-删除*/
            function cate_del(id){
                layer.confirm('确认要删除吗？',function(index){
                     var checked  = [id];
                     $.post('/admin/category/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                        layer.msg('删除成功', {icon: 1,time:800},function() {
                             location.reload();
                        });
                     });
                });
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>