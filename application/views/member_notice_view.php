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
              <span class="h1-border">通知</span>
              <hr/>
              <br/>
            </div>

            <div class="layui-row like-table member-info">
               <table class="layui-table small-table-padding" lay-skin="nob">
                 <tbody id="notice_list">

                 </tbody>
                 <tfoot>
                   <tr><td colspan="2" id="notice_list_page"></td></tr>
                 </tfoot>
               </table>
            </div>
        </div>
      </div>
    </div>
    <br />
  </div>
</article>
<?php $this->load->view('public/footer_view'); ?>
<?php $this->load->view('public/footer_view'); ?>
<script type="text/javascript">
  layui.use(['element','laypage'], function(){

  var $ = layui.jquery, element = layui.element,laypage=layui.laypage;
  laypage.render({
    elem: 'notice_list_page'
    ,limit: 10
    ,count: <?php echo $count; ?>
    ,layout: ['prev', 'page', 'next', 'skip']
    ,jump: function(obj,first){
        $.get('/member/get_notice_more/<?php echo $count ?>',{per_page:obj.curr},function(data) {
            $('#notice_list').html(data.data);
         })
    }
  });
});
</script>