<?php $this->load->view('public/header_view'); ?>
<article class="member-content">

  <div class="layui-container ">
    <br />
    <div class="member-box">
      <div class="layui-row">
          <?php $this->load->view('public/member_left_view'); ?>

        <div class="layui-col-sm10 member-box-right">
            
             <?php $this->load->view('public/member_right_top_view'); ?>
            <div class="layui-row layui-text ">
              <br/>
              <span class="h1-border">消费明细</span>
              <hr/>
              <br/>
            </div>

            <div class="layui-row member-info">
              <table class="layui-table layui-table-center">
                <thead>
                    <tr class="layui-bg-red">
                      <th>交易时间</th>
                      <th>交易详情</th>
                      <th>收入</th>
                      <th>支出</th>
                      <th>余额</th>
                      <th>类型</th>
                      <th>备注</th>
                    </tr> 
                  </thead>
                  <tbody >
                    <?php foreach ($xiaofei_list as $v): ?>
                      <tr>
                        <td><?php echo $v['item_1'] ?></td>
                        <td><?php echo $v['item_2'] ?></td>
                        <td><?php echo $v['item_3'] ?></td>
                        <td class="layui-color-red"><?php echo $v['item_4'] ?></td>
                        <td><?php echo $v['item_5'] ?></td>
                        <td><?php echo $v['item_6'] ?></td>
                        <td><?php echo $v['item_7'] ?></td>
                      </tr>
                    <?php endforeach ?>

                  </tbody>
                  <!-- <tfoot>
                    <tr><td colspan="8" id="balance_list_page"></td></tr>
                  </tfoot> -->
              </table>
            </div>
        </div>
      </div>
    </div>
    <br />
  </div>
</article>
<?php $this->load->view('public/footer_view'); ?>
<script type="text/javascript">
  layui.use(['element','laypage'], function(){

  var $ = layui.jquery, element = layui.element,laypage=layui.laypage;
  /*laypage.render({
    elem: 'balance_list_page'
    ,limit: 10
    ,count: <?php echo $count; ?>
    ,layout: ['prev', 'page', 'next', 'skip']
    ,jump: function(obj,first){
        $.get('/member/get_balance_more/<?php echo $count ?>',{per_page:obj.curr},function(data) {
            $('#balance_list').html(data.data);

         })
    }
  });*/
});
</script>