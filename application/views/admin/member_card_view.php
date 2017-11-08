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
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline" style="width:120px;text-align: left">
                        <select name="status" lay-submit="">
                            <option value="">全部</option>
                            <option value="0" <?php echo isset($where['status']) && $where['status'] == 0?"selected":"" ?> >审核中</option>
                            <option value="1" <?php echo isset($where['status']) && $where['status'] == 1?"selected":"" ?> >已认证</option>
                            <option value="2" <?php echo isset($where['status']) && $where['status'] == 2?"selected":"" ?> >未通过</option>
                        </select>
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="add"><i class="layui-icon">&#xe615;</i>筛选</button>
                        </div>
                    </div>
                </div> 
            </form>
            <xblock>
                <button class="layui-btn" onclick="passAll(1)"><i class="layui-icon">&#xe618;</i>通过认证成为设计师</button>
                <button class="layui-btn layui-btn-danger" onclick="passAll(2)"><i class="layui-icon">&#x1006;</i>不通过认证成为普通会员</button>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo $count; ?> 条</span>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="60"><input type="checkbox" lay-skin="primary" name="" lay-filter="allChoose" value=""></th>
                        <th>会员名</th>
                        <th>姓名</th>
                        <th>身份证</th>
                        <th>过期时间</th>
                        <th>正面</th>
                        <th>反面</th>
                        <th>提交时间</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($member_list as $member): ?>
                        <tr >
                            <td><input type="checkbox" lay-skin="primary" value="<?php echo $member['member_id'] ?>" name="member_id"></td>
                                <td><?php echo $member['username'] ?></td>
                                <td><?php echo $member['name'] ?></td>
                                <td><?php echo $member['card_num'] ?></td>
                                <td><?php echo $member['expiration_date'] ?></td>
                                <td><img src="<?php echo $member['z_img'] ?>" height="100" onclick="open_img('<?php echo $member['z_img'] ?>')"></td>
                                <td><img src="<?php echo $member['f_img'] ?>" height="100" onclick="open_img('<?php echo $member['f_img'] ?>')"></td>
                                <td><?php echo $member['add_date'] ?></td>
                                <td>
                                  <?php switch ($member['status']) {
                                    case 0:
                                        echo '<button class="layui-btn layui-btn-normal layui-btn-mini">审核中</button>';
                                        break;
                                    case 1:
                                        echo '<button class="layui-btn layui-btn-mini">已通过</button>';
                                         break;
                                    case 2:
                                        echo '<button class="layui-btn layui-btn-danger layui-btn-mini">未通过</button>';
                                        break;
                                    default:
                                        # code...
                                        break;
                                    }
                                ?>
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
             function passAll (status) {
                var checked = []; 
                $("input[name='member_id']:checked").each(function(){
                    checked.push($(this).val());
                }) 
                var  msg =  "不通过";
                if(status == 1){
                    msg = "通过"
                }
                if(checked.length > 0){
                    layer.confirm('确认要'+msg+'审核吗？',function(index){
                        $.post('/admin/member/set_card_status',{ids:checked,status:status},function() {
                            layer.msg('审核'+msg+'成功', {icon: 1,time:800},function() {
                              location.reload();
                            });
                        });
                    });
                }else{
                    layer.msg('请勾选通过项!',{icon:2,time:800});
                }
                    
             }
             //-新增
            function open_img (url) {
                layer.alert("<img src="+url+" />");
            }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>