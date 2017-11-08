 <?php $this->load->view('public/page_header_view'); ?>
 <style type="text/css">
   .info-left{
    text-align: right;
    margin-right: -46px;
    z-index: 99;
    margin-top: 20px;
    vertical-align: middle;
   }
   .info-right{
    padding: 10px;
    padding-left: 50px;
   }
   .info-right .p1{
      padding-top: 15px;
      padding-bottom: 36px;
   }
   .info-right .p2{

   }
   .info-right .p3{

   }
 </style>
<article >
  <div class="layui-container" style="width: 1254px">
        <?php if (isset($_globals_banner['banner_7'])): ?>
            <img src="<?php echo $_globals_banner['banner_7'] ?>" width="100%">
          <?php endif ?>
  </div>
  <div class="layui-row layui-container">
    <div class="layui-col-sm12 page-content"  style="width: 997px;padding: 60px 46px;">
      <div class="layui-row">
        <div class="layui-col-sm12 layui-text">
            <div class="layui-bg-gray" style="padding: 10px">
             <?php echo $value; ?>
        </div>

      </div>
    </div>
  </div>
</article>

  <?php $this->load->view('public/page_footer_view'); ?>
