<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>赛事管理</cite></a>
              <a><cite>赛事列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form" >
             <form class="layui-form x-center" action="" >
                <div class="layui-form-pane">
                  <div class="layui-form-item">
                    <label class="layui-form-label">类型</label>
                    <div class="layui-input-inline" style="width:120px;text-align: left">
                        <select name="category_id">
                            <option value="">全部</option>
                            <?php foreach ($category as $v): ?>
                                <option value="<?php echo $v['category_id'] ?>" <?php echo isset($where['category_id']) && $where['category_id'] == $v['category_id']?"selected":"" ?> ><?php echo $v['category_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline" style="width:120px;text-align: left">
                        <select name="status">
                            <option value="">全部</option>
                            <?php foreach ($_globals_bisai_status as $k => $v): ?>
                                <option value="<?php echo $k?>" <?php echo isset($where['status']) && $where['status'] == $k?"selected":"" ?> ><?php echo $v?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <label class="layui-form-label">搜索</label>
                    <div class="layui-input-inline" style="width:200px;text-align: left">
                        <input type="text" name="search" placeholder="请输入队名" class="layui-input"  value="<?php echo isset($where['search'])?$where['search']:'' ?>">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="add"><i class="layui-icon">&#xe615;</i>筛选</button>
                        </div>
                    </div>
                </div> 
            </form>
            <xblock>
                <button class="layui-btn"  lay-filter="add" onclick="product_action('新增','/admin/product/detail')">
                    <i class="layui-icon">&#xe608;</i> 增加
                </button>
                <button class="layui-btn layui-bg-red"  onclick="change_status('del',1)">
                    批量删除
                </button>
                <button class="layui-btn layui-bg-blue"  onclick="change_status('show_index',1)">
                    首页显示
                </button>
                <button class="layui-btn layui-bg-cyan"  onclick="change_status('show_index',0)">
                    首页隐藏
                </button>
                <button class="layui-btn layui-bg-blue"  onclick="change_status('show_left',1)">
                    昨日显示
                </button>
                <button class="layui-btn layui-bg-cyan"  onclick="change_status('show_left',0)">
                    昨日隐藏
                </button>
                <button class="layui-btn layui-bg-blue"  onclick="change_status('show_history',1)">
                    战绩显示
                </button>
                <button class="layui-btn layui-bg-cyan"  onclick="change_status('show_history',0)">
                    战绩隐藏
                </button>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="60"><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="" title="ID"></th>
                        <th>主队</th>
                        <th>客队</th>
                        <th>推荐类型</th>
                        <th>玩法</th>
                        <th>盘口</th>
                        <th>答案价钱</th>
                        <th>开赛时间</th>
                        <th>状态</th>
                        <th>显示</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($product_list as $product): ?>
                        <tr>
                        <td><input type="checkbox" name="product_id"  lay-skin="primary" value="<?php echo $product['product_id'] ?>" title="<?php echo $product['product_id'] ?>"></td>
                        <td><?php echo $product['zhudui'] ?></td>
                        <td><?php echo $product['kedui'] ?></td>
                        <td><?php echo $product['category_name'] ?></td>
                        <td><?php echo $product['product_tags'] ?></td>
                        <td><?php echo $product['pankou']  ?></td>
                        <td><?php echo $product['product_price'] ?></td>
                        <td><?php echo $product['start_date'] ?></td>
                        <td>
                            
                                <?php switch ($product['status']) {
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
                            <?php if ($product['show_index'] == 1): ?>
                            <button class="layui-btn layui-btn-normal layui-btn-mini">首页</button>
                            <?php endif ?>
                            <?php if ($product['show_left'] == 1): ?>
                            <button class="layui-btn layui-btn-mini">昨日</button>
                            <?php endif ?>
                            <?php if ($product['show_history'] == 1): ?>
                            <button class="layui-btn layui-btn-danger layui-btn-mini">战绩</button>
                            <?php endif ?>
                        </td>
                        <td>
                        <?php if ($product['status'] == 0): ?>
                            <a title="编辑" href="javascript:;" onclick="product_action('编辑','/admin/product/detail/<?php echo $product['product_id'] ?>')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="product_del('<?php echo $product['product_id'] ?>')" 
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        <?php else: ?>
                            <i class="layui-icon layui-color-red">&#xe618;</i>已完成
                        <?php endif; ?>
                            
                        </td>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="layui-box layui-laypage layui-laypage-default">
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
             //-新增
            function product_action (title,url) {
                var w = '';
                var h = '';
                x_admin_show(title,url,w,h); 
            }
            function product_del(id) {
                var  key = "del";
                var  value = 1;
                var  ids  = [id];
                layer.confirm('确认要删除作吗？',function(index){
                        $.post('/admin/product/change_status',{ids:ids,value:value,key:key,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                            layer.msg('删除成功', {icon: 1,time:800},function() {
                              location.reload();
                            });
                        });
                    });
            }
            //批量修改状态
             function change_status (key,value) {
                var checked = []; 
                $("input[name='product_id']:checked").each(function(){
                    checked.push($(this).val());
                }) 
                if(checked.length > 0){
                    layer.confirm('确认要执行该操作吗？',function(index){
                        $.post('/admin/product/change_status',{ids:checked,value:value,key:key,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                            layer.msg('操作成功', {icon: 1,time:800},function() {
                              location.reload();
                            });
                        });
                    });
                }else{
                    layer.msg('请勾选删除项!',{icon:2,time:800});
                }
                    
             }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>