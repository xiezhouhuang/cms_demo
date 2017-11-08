
<footer>
  <div class="layui-row footer-top">
       <p><span class="layui-breadcrumb" lay-separator="|">
          <a href="/page/static_page/ABOUT_US">关于我们</a>
          <a href="/page/static_page/questions">常见问题</a>
          <a href="/page/static_page/WEBSHENGMING">本站声明</a>
          <a href="/page/static_page/WEBCONTACT">联系我们</a>
        </span>
      </p>
      <p>推荐阅读 : <span class="layui-breadcrumb" lay-separator="|">
          <a href="/home/history/">推荐战绩</a>
          <a href="/home/news/">内部资讯</a>
          <a href="/page/">团队智汇</a>
          <a href="/page/team/">经典案例</a>
          <a href="/page/team_index/">专业团队</a>
          <a href="/page/static_page/WEBGONGYING">合作共赢</a>
        </span>
      </p>
  </div>
  <div class="layui-row layui-container footer-bottom">
    <div class="layui-col-sm10 layui-text">
      <p><?php echo $_web_footer_copyright ?></p>
      <p><?php echo $_web_footer_beian ?></p>
      <?php echo $_globals_setting['FOOTERMSG'] ?>
    </div>
    <div class="layui-col-sm2" style="text-align: center;">
      <?php if (isset($_globals_banner['banner_9'])): ?>
            <img src="<?php echo $_globals_banner['banner_9'] ?>" height="130">
          <?php endif ?>
    </div>

  </div>
  <br/>
</footer>
<script src="/public/layui.js"></script>
<script type="text/javascript" src="/public/x-layui.js"></script>
<script>
layui.use(['element', 'layer','laypage','form','util','upload'], function(){
  var $ = layui.jquery,element = layui.element,form = layui.form ,layer = layui.layer,laypage=layui.laypage,util=layui.util,upload=layui.upload;
  //固定块
  util.fixbar({
    bar1: '<img src="/public/img/kf.jpg"  width="87"/>'
    ,top: '<img src="/public/img/top.jpg" width="87"/>'
    ,css: {right: 85, bottom: 100}
    ,bgcolor: '#e15d2d'
    ,click: function(type){
      if(type === 'bar1'){
        layer.msg('客服功能即将上线')
      }
    }
  });

  form.on('submit(login)',
      function(data) {
          $.post('/login/do_login/',data.field,function(data) {
              if(data.code == 1){
                  layer.msg(data.data,{icon:1,time:800},function(data) {
                   location.href = "/member/index";
                });
              }else{
                  layer.msg(data.data,{icon:2,time:800});
              }
      })          
      return false;
  });
  <?php if($this->nativesession->get("session_member_id") > 0): ?>
    $.get('/member/get_member/',function(data) {
        $('#top_member_balance').empty().html(data.member_info.balance);
     })
  <?php endif; ?>
});
//完整功能
function open_url (title,url) {
    var w = '';
    var h = 500;
    x_admin_show(title,url,w,h); 
  }
</script>

</body>
</html>
