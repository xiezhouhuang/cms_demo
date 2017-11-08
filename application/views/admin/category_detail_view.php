<?php $this->load->view('admin/public/header_view'); ?>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label  class="layui-form-label">所属分类
                    </label>
                    <div class="layui-input-inline">
                        <select name="parent_id">
                            <option value="0">顶级</option>
                            <?php 

                             function category($list,$parent_id = 0,$sub = 0)
                            {   

                                foreach ($list as $category) {
                                    $select = '';
                                    if( $category['category_id'] == $parent_id){
                                        $select = "selected";
                                    }
                                  echo '<option '.$select.' value="'.$category['category_id'].'">'.str_repeat("&nbsp;&nbsp;",$sub).$category['category_name'].'</option>';
                                    if(!empty($category['sub_child'])){
                                        category($category['sub_child'],$parent_id,$sub+1);
                                    }
                                } 
                            }
                            ?>

                            <?php category($category_list,isset($cate_info['parent_id'])?$cate_info['parent_id']:0); ?>
                           
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">分类名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="category_name" name="category_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($cate_info['category_name'])?$cate_info['category_name']:''; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="phone" class="layui-form-label">排序</label>
                    <div class="layui-input-inline">
                        <input type="text" id="sort" name="sort" required="" lay-verify="required|number"
                        autocomplete="off" class="layui-input" value="<?php echo isset($cate_info['sort'])?$cate_info['sort']:0; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
                        <?php if ($category_id > 0): ?>
                           修改
                           <?php else: ?> 
                            增加
                        <?php endif ?>
                    </button>
                </div>
            </form>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['element','layer','form'], function(){
              var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,layer = layui.layer//弹出层
              ,form = layui.form;

              //监听提交
              form.on('submit(save)', function(data){
                   $.post('/admin/category/save',data.field,function (data) {
                        if(data.code == 0){
                            layer.msg('操作成功',{icon:1,time:800},function() {
                                parent.location.reload();
                            }); 

                        }else{
                            layer.msg('失败',{icon:2,time:800});
                        }
                        
                   });
                    return false;
              });
            })
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>