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
        <div class="x-body" style="min-height: 600px">
            <form class="layui-form">
                  <div class="layui-form-item">
                    <div class="layui-input-block" style="margin-left: 0px">
                      <div class="layui-upload">
                        <button type="button" class="layui-btn" id="icon_images">多图片上传</button> 
                        <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                          预览图：
                          <div class="layui-upload-list" id="images_show">
                          </div>
                          <div id="images_show_error"></div>
                       </blockquote>
                      </div>
                    </div>
                  </div>
                <div class="layui-form-item">
                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <button  class="layui-btn" lay-filter="save" lay-submit="">确定上传</button>
                </div>
            </form>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
        <script>
            layui.use(['layer','form','upload','layedit'], function(){
               var $ = layui.jquery//jquery
              ,element = layui.element//面包导航
              ,layer = layui.layer//弹出层
              ,layedit = layui.layedit//弹出层
              ,upload = layui.upload
              ,form = layui.form;

              //创建一个编辑器
              layedit.set({
                  uploadImage: {
                    url: '/upload/do_upload' //接口url
                    ,data :{<?php echo $this->security->get_csrf_token_name() ?>:'<?php echo $this->security->get_csrf_hash() ?>'}
                    ,type: 'post' //默认post
                  }
                });
                  //多图片上传
                  upload.render({
                    elem: '#icon_images'
                    ,url: '/upload/do_upload/icon'
                    ,data :{'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'}
                    ,multiple: true
                    ,exts: 'jpg|png|gif|bmp|jpeg|svg' //只允许上传压缩文件
                    ,before: function(obj){
                      layer.load();
                    }
                    ,done: function(res){
                      layer.closeAll('loading');
                      if(res.code == 0){
                          $('#images_show').append(
                            '<div class="p_img">'+
                                '<img src="'+ res.data.src +'"  height="100" alt="'+ res.data.orig_name +'"class="layui-upload-img">'+
                                '<input name="img['+res.data.title+']" type="hidden" value="'+ res.data.src +'" />'+
                                '<input name="name['+res.data.title+']" class="layui-input" value="'+ res.data.orig_name +'" />'+
                                '<p ><a class="layui-btn layui-btn-danger layui-btn-mini p_img_del" >删除</a></p>'+
                            '</div>');
                      }else{
                          $('#images_show_error').append("<p><span class='layui-color-red'>"+res.data.file_name+"</span> 上传失败</p>")
                      }
                    }
                  });
              $(document).on('click','.p_img_del',function () {
                 $(this).parent().parent('.p_img').remove();
              })
              //监听提交
              form.on('submit(save)', function(data){
                   $.post('/admin/config/icon_upload_save',data.field,function (data) {
                        if(data.code == 0){
                            layer.msg('操作成功',{icon:1,time:800},function() {
                                location.reload();
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