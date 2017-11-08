<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body layui-form">
             <xblock>
            <button class="layui-btn"  lay-filter="add" onclick="xiaofei_action('新增','/admin/member/xiaofei_detail/<?php echo $member_id ?>')"><i class="layui-icon">&#xe608;</i>增加</button>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>交易时间</th>
                        <th>交易详情</th>
                        <th>收入</th>
                        <th>支出</th>
                        <th>余额</th>
                        <th>类型</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                              
                </thead>
                <tbody >
                    <?php foreach ($xiaofei_list as $xiaofei): ?>
                        <tr >
                                <td><?php echo $xiaofei['item_1'] ?></td>
                                <td><?php echo $xiaofei['item_2'] ?></td>
                                <td><?php echo $xiaofei['item_3'] ?></td>
                                <td><?php echo $xiaofei['item_4'] ?></td>
                                <td><?php echo $xiaofei['item_5'] ?></td>
                                <td><?php echo $xiaofei['item_6'] ?></td>
                                <td><?php echo $xiaofei['item_7'] ?></td>
                                <td class="td-manage">
                                    <a title="删除" href="javascript:;" onclick="xiaofei_del('<?php echo $xiaofei['id'] ?>')" 
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
            function xiaofei_action (title,url) {
                var w = '800';
                var h = '';
                x_admin_show(title,url,w,h); 
            }
           
            /*-删除*/
            function xiaofei_del(id){
                layer.confirm('确认要删除吗？',function(index){
                     $.post('/admin/member/xiaofei_del',{id:id,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function(data) {
                        if(data.code == 0){
                          layer.msg('删除成功', {icon: 1,time:800},function() {
                               location.reload();
                          });
                        }else{
                          layer.msg('删除失败', {icon: 2,time:800});
                        }
                     });
                });
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>