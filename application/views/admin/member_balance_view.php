<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
            <a><cite><?php echo $status_msg ?></cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body layui-form">
             <form class="layui-form x-center" action="" >
                <div class="layui-form-pane">
                  <div class="layui-form-item">
                    <label class="layui-form-label">搜索</label>
                    <div class="layui-input-inline" style="width:200px;text-align: left">
                        <input type="text" name="search" placeholder="请输入用户名或邮箱" class="layui-input"  value="<?php echo isset($where['search'])?$where['search']:'' ?>">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                   
                        <button class="layui-btn"  lay-submit="" lay-filter="add"><i class="layui-icon">&#xe615;</i>筛选</button>
                        </div>
                    </div>
                </div> 
            </form>
            <form class="layui-form x-center" action="" style="display: none;" >
                <div class="layui-form-pane">
                  <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline" style="width:120px;text-align: left">
                        <select name="status">
                            <option value="">全部</option>
                            <option value="0" <?php echo isset($where['status']) && $where['status'] == 0?"selected":"" ?> ><?php if($status_type == 1): ?>审核中<?php else: ?>未支付<?php endif; ?>
                            </option>
                            <option value="1" <?php echo isset($where['status']) && $where['status'] == 1?"selected":"" ?> ><?php if($status_type == 1): ?>已通过<?php else: ?>已支付<?php endif; ?>
                            </option>
                            <option value="2" <?php echo isset($where['status']) && $where['status'] == 2?"selected":"" ?> ><?php if($status_type == 1): ?>未通过<?php else: ?>支付失败<?php endif; ?>
                            </option>
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
                        <th>会员名</th>
                        <th>编码</th>
                        <th>
                            <?php echo $status_msg; ?>
                        </th>
                        <th>提交时间</th>
                        <th style="display: none;">状态</th>
                        <th style="display: none;">操作</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach ($member_list as $member): ?>
                        <tr >
                                <td><?php echo $member['username'] ?></td>
                                <td><?php echo $member['trade_no'] ?></td>
                                <td><?php echo $member['total'] ?></td>
                                <td><?php echo $member['add_date'] ?></td>
                                <td  style="display: none;">
                                  <?php switch ($member['status']) {
                                    case 0:
                                        if($status_type == 1){
                                            echo '<button class="layui-btn layui-btn-normal layui-btn-mini">审核中</button>';
                                        }else{
                                            echo '<button class="layui-btn layui-btn-normal layui-btn-mini">未支付</button>';
                                        }
                                        
                                        break;
                                    case 1:
                                        if($status_type == 1){
                                            echo '<button class="layui-btn layui-btn-mini">已提现</button>';
                                        }else{
                                            echo '<button class="layui-btn layui-btn-mini">已充值</button>';
                                        }
                                        
                                         break;
                                     case 2:
                                        if($status_type == 1){
                                            echo '<button class="layui-btn layui-btn-mini">未通过</button>';
                                        }else{
                                            echo '<button class="layui-btn layui-btn-mini">支付失败</button>';
                                        }
                                         break;
                                    default:
                                        # code...
                                        break;
                                    }
                                ?>
                                </td>
                                <td style="display: none;">
                                    <?php if($status_type == 1 && $member['status'] == 0): ?>
                                        <button class="layui-btn" onclick="set_balance_status('<?php echo $member['balance_id'] ?>',1)"><i class="layui-icon">&#xe618;</i>同意提现</button>
                                         <button class="layui-btn layui-btn-danger" onclick="set_balance_status('<?php echo $member['balance_id'] ?>',2)"><i class="layui-icon">&#x1006;</i>不同意提现</button>
                                    <?php endif; ?>
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
            });
            
            //批量删除提交
             function set_balance_status (id,status) {
                var  msg =  "不通过";
                if(status == 1){
                    msg = "通过"
                }
                layer.confirm('确认要'+msg+'审核吗？',function(index){
                        $.post('/admin/member/set_balance_status',{id:id,status:status,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                            layer.msg('审核'+msg+'成功', {icon: 1,time:800},function() {
                              location.reload();
                            });
                        });
                });
                    
             }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>