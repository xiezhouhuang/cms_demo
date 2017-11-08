<footer  style="background: #f1f1f3">
  <div class="layui-row  footer-bottom" style="width: 700px; margin: 0px auto">
    <div class="layui-text"  style="float: left;">
      <p>版权所有:NBA直推网 Copyright©2006-2016ICP  ICP备14021150号-1</p>
      <div class="page-footer-breadcrumb-box layui-text">
          推荐阅读: 
          <span class="layui-breadcrumb" lay-separator="|">
             <a href="/home/history">推荐战绩</a>
            <a href="/home/news">内部资讯</a>
            <a href="/page/">团队智汇</a>
            <a href="/page/team/">经典案例</a>
            <a href="/page/team_index">专业团队</a>
            <a href="/page/static_page/WEBGONGYING">合作共赢</a>
            <a href="/page/static_page/ABOUT_US">关于我们</a>
          </span>
      </div>
      
    </div>
    <div style="float: left;margin-top: -16px;padding-left: 10px">
      <?php if (isset($_globals_banner['banner_10'])): ?>
            <img src="<?php echo $_globals_banner['banner_10'] ?>" height="100">
          <?php endif ?>
    </div>

  </div>
  <br/>
</footer>
<script src="/public/layui.js"></script>
<script type="text/javascript">
  layui.use(['element'], function(){
     var element = layui.element 
  })
</script>
</body>
</html>