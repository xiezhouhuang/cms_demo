<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>系统管理</cite></a>
              <a><cite><?php if ($notice_style == 1): ?>
                    官方通知
                <?php elseif($notice_style == 2): ?>
                    包赢公告
                  <?php else: ?>
                    今日公告
              <?php endif ?></cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form">
            <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
            <button class="layui-btn"  lay-filter="add" onclick="notice_action('新增','/admin/notice/detail/<?php echo $notice_style ?>')"><i class="layui-icon">&#xe608;</i>增加</button></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="60"><input type="checkbox" lay-skin="primary" name="" lay-filter="allChoose" value=""></th>
                        <th style="display: none;" width="100">标题</th>
                        <th>内容</th>
                        <th width="100">日期</th>
                        <th width="50">状态</th>
                        <th width="80">操作</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($notice_list as $notice): ?>
                        <tr >
                            <td><input type="checkbox" lay-skin="primary" value="<?php echo $notice['notice_id'] ?>" name="notice_id"></td>
                                <td style="display: none;" ><?php echo $notice['notice_name'] ?></td>
                                <td><?php echo $notice['notice_content'] ?></td>
                                <td><?php echo $notice['notice_date'] ?></td>
                                <td>
                                    <?php switch ($notice['status']) {
                                    case 1:
                                        echo '<button class="layui-btn layui-btn-mini">显示</button>';
                                         break;
                                    case 0:
                                        echo '<button class="layui-btn layui-btn-danger layui-btn-mini">隐藏</button>';
                                        break;
                                    default:
                                        # code...
                                        break;
                                }
                                ?>
                                </td>
                                <td class="td-manage">
                                    <a title="编辑" href="javascript:;"
                                    onclick="notice_action('编辑','/admin/notice/detail/<?php echo $notice_style ?>/<?php echo $notice['notice_id'] ?>')"
                                    class="ml-5" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" href="javascript:;" onclick="notice_del('<?php echo $notice['notice_id'] ?>')" 
                                    style="text-decoration:none">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                </td>
                            </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="layui-box layui-laypage layui-laypage-default ">
                <?php echo $page; ?>
            </div>
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
                $("input[name='notice_id']:checked").each(function(){
                    checked.push($(this).val());
                }) 
                if(checked.length > 0){
                    layer.confirm('确认要删除吗？',function(index){
                        $.post('/admin/notice/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
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
            function notice_action (title,url) {
                var w = 500;
                var h = 500;
                x_admin_show(title,url,w,h); 
            }
           
            /*-删除*/
            function notice_del(id){
                layer.confirm('确认要删除吗？',function(index){
                     var checked  = [id];
                     $.post('/admin/notice/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                        layer.msg('删除成功', {icon: 1,time:800},function() {
                             location.reload();
                        });
                     });
                });
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>