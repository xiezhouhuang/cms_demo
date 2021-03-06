<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>会员列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form">
            <form class="layui-form x-center" action="" >
                <div class="layui-form-pane">
                  <div class="layui-form-item">
                    <label class="layui-form-label">搜索</label>
                    <div class="layui-input-inline" style="width:200px;text-align: left">
                        <input type="text" name="search" placeholder="请输入用户名或邮件" class="layui-input"  value="<?php echo isset($where['search'])?$where['search']:'' ?>">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="add"><i class="layui-icon">&#xe615;</i>筛选</button>
                        </div>
                    </div>
                </div> 
            </form>
            <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量停用</button>
            <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="60"><input type="checkbox" lay-skin="primary" name="" lay-filter="allChoose" value=""></th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>QQ</th>
                        <th>手机</th>
                        <th>答案金</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($member_list as $member): ?>
                        <tr >
                            <td><input type="checkbox" lay-skin="primary" value="<?php echo $member['member_id'] ?>" name="member_id"></td>
                                <td><?php echo $member['username'] ?></td>
                                <td><?php echo $member['email'] ?></td>
                                <td><?php echo $member['qq'] ?></td>
                                <td><?php echo $member['phone'] ?></td>
                                <td><?php echo $member['balance'] ?></td>
                                <td><?php echo $member['create_date'] ?></td>
                                <td class="td-manage">
                                    <a title="充值" href="javascript:;"
                                    onclick="member_action('充值','/admin/member/balance_detail/chongzhi/<?php echo $member['member_id'] ?>')"
                                    class="ml-5" style="text-decoration:none">
                                       充值
                                    </a>|
                                     <a title="提款" href="javascript:;"
                                    onclick="member_action('提款','/admin/member/balance_detail/tikuan/<?php echo $member['member_id'] ?>')"
                                    class="ml-5" style="text-decoration:none">
                                       提款
                                    </a>
                                    |
                                    <a title="消费" href="javascript:;"
                                    onclick="member_action('消费','/admin/member/xiaofei/<?php echo $member['member_id'] ?>')"
                                    class="ml-5" style="text-decoration:none">
                                       消费
                                    </a>
                                    <a title="删除" href="javascript:;" onclick="member_del('<?php echo $member['member_id'] ?>')" 
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
                $("input[name='member_id']:checked").each(function(){
                    checked.push($(this).val());
                }) 
                if(checked.length > 0){
                    layer.confirm('确认要停用吗？',function(index){
                        $.post('/admin/member/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                            layer.msg('停用成功', {icon: 1,time:800},function() {
                              location.reload();
                            });
                        });
                    });
                }else{
                    layer.msg('请勾选停用项!',{icon:2,time:800});
                }
                    
             }
             //-新增
            function member_action (title,url) {
                var w = '';
                var h = '';
                x_admin_show(title,url,w,h); 
            }
           
            /*-删除*/
            function member_del(id){
                layer.confirm('确认要删除吗？',function(index){
                     var checked  = [id];
                     $.post('/admin/member/del',{ids:checked,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                        layer.msg('删除成功', {icon: 1,time:800},function() {
                             location.reload();
                        });
                     });
                });
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>