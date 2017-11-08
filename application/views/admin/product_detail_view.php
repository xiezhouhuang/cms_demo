<?php $this->load->view('admin/public/header_view'); ?>
<style type="text/css">
  .p_img{
    float: left;
    padding: 10px;
  }
  #images_show_error{
    clear: both;
    padding: 10px;
  }
</style>
        <div class="x-body">
            <form class="layui-form">
                  <div class="layui-form-item">
                    <div class="layui-inline">
                      <label class="layui-form-label">推荐类型</label>
                      <div class="layui-input-inline">
                        <select name="category_id">
                        <?php foreach ($category_list as $category): ?>
                          <option <?php if ($category['category_id'] == $product['category_id']): ?>
                            selected
                          <?php endif ?> value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                        <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="layui-inline">
                      <label class="layui-form-label">比赛类型</label>
                      <div class="layui-input-inline">
                        <select name="bisai_style">
                          <?php foreach ($_globals_bisai_style as $k =>$v): ?>
                            <option value="<?php echo $k ?>" <?php if (isset($product['bisai_style']) && $product['bisai_style'] == $k): ?> selected="" <?php endif ?>><?php echo $v ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>

                <div class="layui-form-item">
                 <div class="layui-inline">
                    <label class="layui-form-label">主队</label>
                    <div class="layui-input-inline">
                        <input type="text" name="zhudui" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($product['zhudui'])?$product['zhudui']:''; ?>">
                    </div>
                  </div>
                  <div class="layui-inline">
                    <label class="layui-form-label">客队</label>
                    <div class="layui-input-inline">
                        <input type="text" name="kedui" lay-verify="required"
                        autocomplete="off" class="layui-input" value="<?php echo isset($product['kedui'])?$product['kedui']:''; ?>">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                      <label class="layui-form-label">场次</label>
                      <div class="layui-input-inline">
                       <select name="hot">
                          <?php foreach ($_globals_product_hot as $k =>$v): ?>
                            <option value="<?php echo $k ?>" <?php if (isset($product['hot']) && $product['hot'] == $k): ?> selected="" <?php endif ?>><?php echo $v ?></option>
                          <?php endforeach ?>
                       </select>
                      </div>
                    </div>
                     <div class="layui-inline">
                      <label class="layui-form-label">玩法</label>
                      <div class="layui-input-inline">
                        <input type="text" name="product_tags" lay-verify="required" value="<?php echo isset($product['product_tags'])?$product['product_tags']:''; ?>" autocomplete="off" class="layui-input">
                      </div>
                    </div>
                    
                  </div>
                  <div class="layui-form-item">
                    <div class="layui-inline">
                      <label class="layui-form-label">开赛盘口</label>
                      <div class="layui-input-inline">
                        <input type="text" name="pankou" lay-verify="required" value="<?php echo isset($product['pankou'])?$product['pankou']:''; ?>" autocomplete="off" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-inline">
                      <label class="layui-form-label">开赛时间</label>
                      <div class="layui-input-inline">
                        <input type="text" name="start_date" id="start_date" lay-verify="required" value="<?php echo isset($product['start_date'])?$product['start_date']:''; ?>" autocomplete="off" class="layui-input">
                      </div>
                    </div>
                    
                  </div>
                  <div class="layui-form-item">
                    
                    <div class="layui-inline">
                      <label class="layui-form-label">答案</label>
                      <div class="layui-input-inline">
                       <input type="text" name="daan" lay-verify="required" value="<?php echo isset($product['daan'])?$product['daan']:''; ?>" autocomplete="off" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-inline">
                      <label class="layui-form-label">答案价钱</label>
                      <div class="layui-input-inline">
                        <input type="text" name="product_price" lay-verify="required" value="<?php echo isset($product['product_price'])?$product['product_price']:0.00; ?>" autocomplete="off" class="layui-input">
                      </div>
                    </div>
                  </div>
                   <div class="layui-form-item">
                    <div class="layui-inline">
                       <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                          <input type="radio" name="status" value="0" title="待开奖" <?php if ((isset($product['status']) && $product['status'] == 0 ) || $product_id == 0): ?> checked="" <?php endif ?>>
                          <input type="radio" name="status" value="1" title="已中奖"  <?php if(isset($product['status']) && $product['status'] == 1): ?> checked="" <?php endif; ?>>
                           <input type="radio" name="status" value="2" title="未中奖"  <?php if(isset($product['status']) && $product['status'] == 2): ?> checked="" <?php endif; ?>>
                          
                        </div>
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <div class="layui-inline">
                      <label class="layui-form-label">比赛结果</label>
                      <div class="layui-input-inline">
                        <input type="text" name="product_name" lay-verify="bifen" value="<?php echo isset($product['product_name'])?$product['product_name']:''; ?>" autocomplete="off" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">封面</label>
                        <div class="layui-input-inline">
                             <div class="layui-upload-drag" id="product_img">
                               <?php if(isset($product['product_img']) && !empty($product['product_img'])): ?>
                                   <img src="<?php echo $product['product_img'] ?>"  height="100" class="layui-upload-img">
                                <?php else: ?>
                                  <i class="layui-icon">&#xe67c;</i>
                                  <p>点击上传，或将文件拖拽到此处</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del_file('product_img')" >删除</a></div>
                    </div>
                  </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <input type="hidden" name="product_img" value="<?php echo isset($product['product_img'])?$product['product_img']:''; ?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" >
                    <a  href="javascript:;" class="layui-btn" lay-filter="save" lay-submit="">
                        <?php if ($product_id > 0): ?>
                           修改
                           <?php else: ?> 
                            增加
                        <?php endif ?>
                    </a>
                </div>
            </form>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['layer','form','upload','layedit','laydate'], function(){
               var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,layer = layui.layer//弹出层
              ,layedit = layui.layedit//弹出层
              ,upload = layui.upload
              ,form = layui.form
              ,laydate = layui.laydate;
              laydate.render({ 
                elem: '#start_date'
                ,type:'datetime'
                ,format: 'yyyy-MM-dd HH:mm' //可任意组合
              });

              //创建一个编辑器
              layedit.set({
                  uploadImage: {
                    url: '/upload/do_upload/' //接口url
                    ,data :{<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>'}
                    ,type: 'post' //默认post
                  }
                });
              var editIndex = layedit.build('product_detail');
                //指定文件
                upload.render({
                  elem: '#product_file'
                  ,url: '/upload/do_upload/product'
                  ,data :{<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>'}
                  ,accept: 'file' //普通文件
                  ,exts: 'zip|rar|7z' //只允许上传压缩文件
                  ,done: function(res){
                    if(res.code == 0){
                      $('#product_file').html('<p>'+res.data.orig_name+'</p>');
                      $('input[name="product_file"]:hidden').val(res.data.src);
                    }else{
                      layer.alert(res.msg,{icon:2});
                    }
                  }
                });
                //指定封面
                upload.render({
                  elem: '#product_img'
                  ,url: '/upload/do_upload/product'
                  ,data :{<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>'}
                  ,accept: 'file' //普通文件
                  ,exts: 'jpg|png|gif|bmp|jpeg|svg' //只允许上传压缩文件
                  ,done: function(res){
                     if(res.code == 0){
                      $('#product_img').html('<img src="'+ res.data.src +'" height="100"  class="layui-upload-img">');
                      $('input[name="product_img"]:hidden').val(res.data.src);
                     }else{
                      layer.alert(res.msg,{icon:2});
                    }
                  }
                });
                  //多图片上传
                  upload.render({
                    elem: '#product_images'
                    ,url: '/upload/do_upload/product_img'
                    ,data :{<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>'}
                    ,multiple: true
                    ,before: function(obj){
                      layer.load();
                    }
                    ,done: function(res){
                      layer.closeAll('loading');
                      if(res.code == 0){
                          $('#images_show').append(
                            '<div class="p_img">'+
                                '<img src="'+ res.data.src +'"  height="100" alt="'+ res.data.orig_name +'"class="layui-upload-img">'+
                                '<input name="product_images['+res.data.title+']" type="hidden" value="'+ res.data.src +'" />'+
                                '<input name="product_images_title['+res.data.title+']" type="hidden" value="'+ res.data.orig_name +'" />'+
                                '<p ><a class="layui-btn layui-btn-danger layui-btn-mini p_img_del" >删除</a></p>'+
                            '</div>');
                      }else{
                          $('#images_show_error').append("<p><span class='layui-color-red'>"+res.data.file_name+"</span> 上传失败</p>")
                      }
                    }
                  });
            

               //自定义验证规则
              form.verify({
                title: function(value){
                  if(value.length < 5){
                    return '标题至少得5个字符啊';
                  }
                }
                ,content: function(value){
                  layedit.sync(editIndex);
                }
                ,bifen: function(value){
                    var  status  = $('input:checked[name="status"]').val();
                    if(status > 0 && value.length < 1){
                        return  '已开奖请设置比分结果';
                    }
                  }
              });

              $(document).on('click','.p_img_del',function () {
                 $(this).parent().parent('.p_img').remove();
              })
              //监听提交
              form.on('submit(save)', function(data){
                   if(data.field.status > 0 ){
                    var  status  = "未中奖"
                    if(data.field.status == 1){
                      status = "已中奖";
                    }
                    layer.confirm("你确定要修改该赛程<br/>开奖结果:<span  style='font-size:30px; color:#F00'>"+status+"</span><br/>比赛结果:<span  style='font-size:30px; color:#F00'>"+data.field.product_name+"</span><br/>(确认后不可修改)",function() {
                       post_form(data);
                    })
                   }else if(data.field.category_id == 4 && data.field.product_id == 0){
                    layer.confirm("你确定新增包赢直推?(确认后不可修改)",function() {
                       post_form(data);
                    })
                   }else{
                      if((parseInt('<?php echo $product['category_id'] ?>')  == 4 || data.field.category_id == 4 )&& data.field.category_id != parseInt('<?php echo $product['category_id'] ?>') && data.field.product_id > 0){
                        layer.msg("不能修改直推类型",{icon:2,time:800});
                        return;
                      }

                       post_form(data);
                   }
              });
            })
            function post_form(data) {
              $.post('/admin/product/save',data.field,function (data) {
                        if(data.code == 0){
                            layer.msg('操作成功',{icon:1,time:800},function() {
                                parent.location.reload();
                            }); 

                        }else{
                            layer.msg('失败',{icon:2,time:800});
                        }
                        
                   });
            }
            function del_file(obj) {
                $("#"+obj).html('<i class="layui-icon">&#xe67c;</i><p>点击上传，或将文件拖拽到此处</p>');
                $('input[name="'+obj+'"]:hidden').val('');
              }
              function del_img(obj,id) {
                 $.post('/product/del_img',{id:id,'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function(data) {
                    if(data.code == 1){
                      obj.parent().parent('.p_img').remove();
                    }
                 })
              }
            </script>
<?php $this->load->view('admin/public/footer_view'); ?>