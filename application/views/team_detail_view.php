 <?php $this->load->view('public/page_header_view'); ?>
 <style type="text/css">
  .team_page_class img{
    max-width: 400px;
  }

 </style>
<article >
  <div class="layui-container" style="width: 1254px">
      <?php if (isset($_globals_banner['banner_8'])): ?>
         <img src="<?php echo $_globals_banner['banner_8'] ?>" width="100%">
      <?php endif ?>
  </div>
  <div class="layui-row layui-container">
    <div class="layui-col-sm12  page-content" style="width: 997px" >
      <div class="layui-row  layui-col-space20">
        <div class="breadcrumb-box">
              当前位置: 
              <span class="layui-breadcrumb" lay-separator=">">
                <a href="/page/">首页</a>
                <a href="/page/team_index">团队智汇</a>
                <a><cite>
                  <?php echo $title ?>
                </cite></a>
              </span>
              </div>
         <?php $this->load->view('public/team_left_view'); ?>
        <div class="layui-col-sm9 layui-text team_page_class"  style="width:690px">
            <?php echo $value ?>
        </div>

      </div>
    </div>
  </div>
</article>
<?php $this->load->view('public/page_footer_view'); ?>
