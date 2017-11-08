<?php $this->load->view('public/header_view'); ?>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="member-box">
      <div class="layui-row">
        <?php $this->load->view('public/member_left_view'); ?>
        <div class="layui-col-sm10"  style="width: 801px;border-left: 1px solid #CCC;">
             <?php $this->load->view('public/member_right_top_view'); ?>
            <div class="layui-row layui-text ">
              <br/>
              <span class="h1-border">购买记录</span>
              <hr/>
              <br/>
            </div>

            <div class="layui-row  member-info">
              <table class="layui-table layui-table-center normal-table-padding">
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
                  <tbody id="member_order_list">
                  </tbody>
                  <tfoot>
                    <tr ><td colspan="8" align="center" id="order_list_page"></td></tr>
                  </tfoot>
              </table>
            </div>
            <div class="layui-row layui-text">
              <br/>
              <span class="h1-border">包赢购买记录</span>
              <span class="h1-border-right"  >五场命中率 :  <span id="mingzhonglv">未开奖</span></span>
              <hr/>
              <br/>
            </div>
            <div class="layui-row member-info">
              <table class="layui-table" lay-skin="nob" lay-even   style="border: 1px solid #CCC">
                <thead>
                    <tr class="layui-bg-red">
                      <th>时间</th>
                      <th>主队</th>
                      <th>盘口</th>
                      <th>客队</th>
                      <th>赛况</th>
                      <th></th>
                    </tr> 
                  </thead>
                  <tbody id="member_baoying_order_list">
                  </tbody>
                  <tfoot>
                    <tr><td align="center" colspan="7" id="baoying_order_list_page"></td></tr>
                  </tfoot>
              </table>
            </div>
        </div>
      </div>
      </div>
    <br />
  </div>
</article>
<script type="text/javascript">
  function open_url_2 (title,url) {
    var w = 400;
    var h = 400;
    x_admin_show(title,url,w,h); 
  }
</script>
<?php $this->load->view('public/footer_view'); ?>
<script type="text/javascript">
  layui.use(['element','laypage'], function(){

  var $ = layui.jquery, element = layui.element,laypage=layui.laypage;
  laypage.render({
    elem: 'order_list_page'
    ,limit: 10
    ,count: <?php echo $count; ?>
    ,layout: ['prev', 'page', 'next', 'skip']
    ,jump: function(obj,first){
        $.get('/member/get_order_more/<?php echo $count ?>',{per_page:obj.curr},function(data) {
            $('#member_order_list').html(data.data);
         })
    }
  });
  laypage.render({
    elem: 'baoying_order_list_page'
    ,limit: 5
    ,count: <?php echo $baoying_order_count; ?>
    ,layout: ['prev', 'page', 'next', 'skip']
    ,jump: function(obj,first){
        $.get('/member/get_baoying_order_more/<?php echo $baoying_order_count ?>',{per_page:obj.curr},function(data) {
            $('#mingzhonglv').empty().html(data.mingzhonglv);
            $('#member_baoying_order_list').html(data.data);
         })
    }
  });
});
</script>