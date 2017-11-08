<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>消费记录</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form">
        <form class="layui-form x-center" action="" >
                <div class="layui-form-pane">
                  <div class="layui-form-item">
                    <label class="layui-form-label">搜索</label>
                    <div class="layui-input-inline" style="width:200px;text-align: left">
                        <input type="text" name="search" placeholder="用户名或邮箱或队名" class="layui-input"  value="<?php echo isset($where['search'])?$where['search']:'' ?>">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="add"><i class="layui-icon">&#xe615;</i>筛选</button>
                        </div>
                    </div>
                </div> 
            </form>
         <form class="layui-form x-center" action=""  style="display: none;" >
                <div class="layui-form-pane">
                  <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline" style="width:120px;text-align: left">
                        <select name="status">
                            <option value="">全部</option>
                            <option value="0" <?php echo isset($where['status']) && $where['status'] == 0?"selected":"" ?> >待开奖</option>
                            <option value="1" <?php echo isset($where['status']) && $where['status'] == 1?"selected":"" ?> >已开奖</option>
                            <option value="1" <?php echo isset($where['status']) && $where['status'] == 2?"selected":"" ?> >未开奖</option>
                        </select>
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="add"><i class="layui-icon">&#xe615;</i>筛选</button>
                        </div>
                    </div>
                </div> 
            </form>
            <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>编码</th>
                        <th>购买会员</th>
                        <th>购买赛事</th>
                        <th>中奖情况</th>
                        <th>购买价钱</th>
                        <th>购买时间</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($order_list as $order): ?>
                        <tr >
                                <td><?php echo $order['order_no'] ?></td>
                                <td><?php echo $order['username'] ?></td>
                                <td><?php echo $order['zhudui'] ?>VS<?php echo $order['kedui'] ?></td>
                                <td>
                            
                                <?php switch ($order['result_status']) {
                                    case 0:
                                        echo '<button class="layui-btn layui-btn-normal layui-btn-mini">待开奖</button>';
                                        break;
                                    case 1:
                                        echo '<button class="layui-btn layui-btn-mini">已中奖</button>';
                                         break;
                                    case 2:
                                        echo '<button class="layui-btn layui-btn-danger layui-btn-mini">未中奖</button>';
                                        break;
                                    default:
                                        # code...
                                        break;
                                }
                                ?>
                        </td>
                                <td>
                                    <?php echo $order['price'] ?>
                                </td>
                                <td><?php echo $order['order_date'] ?></td>
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
                $("input[name='order_id']:checked").each(function(){
                    checked.push($(this).val());
                }) 
                if(checked.length > 0){
                    layer.confirm('确认要删除吗？',function(index){
                        $.post('/admin/order/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
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
            function order_action (title,url) {
                var w = '';
                var h = '';
                x_admin_show(title,url,w,h); 
            }
           
            /*-删除*/
            function order_del(id){
                layer.confirm('确认要删除吗？',function(index){
                     var checked  = [id];
                     $.post('/admin/order/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                        layer.msg('删除成功', {icon: 1,time:800},function() {
                             location.reload();
                        });
                     });
                });
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>