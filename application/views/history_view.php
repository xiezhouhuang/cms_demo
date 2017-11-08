<?php $this->load->view('public/header_view'); ?>
<article>
  <div class="layui-container ">
    <div class="breadcrumb-box">
    当前位置: 
    <span class="layui-breadcrumb" lay-separator=">>">
      <a href="/">首页直推</a>
      <a><cite>推荐战绩</cite></a>
    </span>
    </div>
    <div class="layui-row  layui-col-space15 left-nav">
      <div class="layui-col-sm9">
          <?php if (isset($_globals_banner['banner_5'])): ?>
            <div><img src="<?php echo $_globals_banner['banner_5'] ?>" width="100%"></div>
          <?php endif ?>
          <div class="layui-tab layui-tab-brief index-tab" lay-filter="docDemoTabBrief">
            <ul class="layui-tab-title">
              <li class="layui-this">早场、中场直推战绩</li>
            </ul>
            <div class="layui-tab-content">
              <div class="layui-tab-item layui-show">
                <div class="layui-row">
            <table class="layui-table layui-table-center small-table-padding">
              <thead>
                  <tr class="layui-bg-red">
                    <th>类型</th>
                    <th>赛事</th>
                    <th width="140" >球队</th>
                    <th width="100" >答案</th>
                    <th>比分</th>
                    <th>胜负</th>
                    <th>金币</th>
                    <th>详情</th>
                  </tr> 
                </thead>
                <tbody id="history_list">
                  
                </tbody>
                <tfoot>
                  <tr><td colspan="8"  id="list_page" ></td></tr>
                </tfoot>
            </table>
          </div>
              </div>
            </div>
          </div> 
      </div>
       <?php $this->load->view('public/common_left_view'); ?>
    </div>
</article>
<?php $this->load->view('public/footer_view'); ?>
<script type="text/javascript">
  layui.use(['element','laypage'], function(){

  var $ = layui.jquery, element = layui.element,laypage=layui.laypage;
  laypage.render({
    elem: 'list_page'
    ,limit: 10
    ,count: <?php echo $count; ?>
    ,layout: ['prev', 'page', 'next', 'skip']
    ,jump: function(obj,first){
        $.get('/home/get_more_history/',{per_page:obj.curr},function(data) {
            $('#history_list').html(data.data);
         })
    }
  });
});
</script>