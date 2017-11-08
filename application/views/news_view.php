<?php $this->load->view('public/header_view'); ?>
<article>

  <div class="layui-container ">
  <div class="breadcrumb-box">
    当前位置: 
    <span class="layui-breadcrumb" lay-separator=">>">
      <a href="/">首页直推</a>
      <a><cite>内部资讯</cite></a>
    </span>
    </div>
    <div class="layui-carousel" id="banner">
      <div carousel-item>
       <?php if (isset($_globals_banner['banner_6'])): ?>
            <div><img src="<?php echo $_globals_banner['banner_6'] ?>" width="100%"></div>
          <?php endif ?>
      </div>
    </div>
    <br />
    <div class="layui-row  layui-col-space20 left-nav">
      <div class="layui-col-sm9">
          <div class="layui-row layui-text " style="border: 1px solid #CCC; ">
              <h3 class="layui-bg-gray">&nbsp; 内部消息</h3>
          </div>
        <div class="layui-row like-table layui-text">

          <table class="layui-table small-table-padding" lay-skin="nob">
              <?php foreach ($news_list as $k => $v): ?>
                <?php if($k < 2): ?>
                <tr>
                  <td width="30%" rowspan="2"><img src="<?php echo $v['news_img'] ?>" width="100%"></td>
                  <td  width="70%"><h3 class="layui-color-red bottom-border"><?php echo $v['news_title'] ?></h3></td>
                </tr>
                <tr >
                  <td valign="top">
                  <?php echo $v['news_desc'] ?> <a href="/home/news_detail/<?php echo $v['news_id'] ?>">详情>></a></p>
                  </td>
                </tr>
              <?php endif; ?>
              <?php endforeach ?>
            </table>
          </div>
          <table class="layui-table" lay-skin="nob">
             <tbody id="news_list1">
              </tbody>
              <tfoot>
                <tr><td colspan="3" id="news_list_page"></td></tr>
              </tfoot>
          </table>
          <hr>
          <br/>
          <div class="layui-row layui-text " style="border: 1px solid #CCC; ">
              <h3 class="layui-bg-gray">&nbsp; 直推启示</h3>
          </div>
          <div class="layui-row like-table layui-text">

          <table class="layui-table small-table-padding" lay-skin="nob">
              <?php foreach ($news_list2 as $k => $v): ?>
                <?php if($k < 2): ?>
                <tr>
                  <td width="30%" rowspan="2"><img src="<?php echo $v['news_img'] ?>" width="100%"></td>
                  <td  width="70%"><h3 class="layui-color-red bottom-border"><?php echo $v['news_title'] ?></h3></td>
                </tr>
                <tr >
                  <td valign="top">
                  <?php echo $v['news_desc'] ?> <a href="/home/news_detail/<?php echo $v['news_id'] ?>">详情>></a></p>
                  </td>
                </tr>
              <?php endif; ?>
              <?php endforeach ?>
            </table>
          </div>
          <table class="layui-table" lay-skin="nob">
             <tbody id="news_list2">
               
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3" id="news_list2_page">
                  
                  </td>
                </tr>
              </tfoot>
          </table>
      </div>
      <?php $this->load->view('public/common_left_view'); ?>
    </div>
</article>

<?php $this->load->view('public/footer_view'); ?>
<script type="text/javascript">
  layui.use(['element','laypage'], function(){

  var $ = layui.jquery, element = layui.element,laypage=layui.laypage;
  laypage.render({
    elem: 'news_list_page'
    ,limit: 7
    ,count: <?php echo $count; ?>
    ,layout: ['prev', 'page', 'next', 'skip']
    ,jump: function(obj,first){
       $.get('/home/get_more_news/',{per_page:obj.curr},function(data) {
          $('#news_list1').html(data.data);
       })
    }
  });
  laypage.render({
    elem: 'news_list2_page'
    ,limit: 7
    ,count: <?php echo $count2; ?>
    ,layout: ['prev', 'page', 'next', 'skip']
    ,jump: function(obj,first){
        $.get('/home/get_more_news/1',{per_page:obj.curr},function(data) {
            $('#news_list2').html(data.data);
         })
    }
  });
});
</script>