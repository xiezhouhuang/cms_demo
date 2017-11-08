
<?php $this->load->view('public/page_header_view'); ?>
<article >
  <div class="layui-row layui-container">
    <div class="layui-col-sm12 page-sub-content" style="width: 996px" >
      <div class="layui-row">
        <?php $this->load->view('public/page_left_sub_view'); ?>
        <div class="layui-col-sm9" style="width: 783px;" >
            <div class="breadcrumb-box">
              当前位置: 
              <span class="layui-breadcrumb" lay-separator=">">
                <a href="/">首页</a>
                <a href="/page/">我的直推网</a>
                <a><cite> <?php echo $key == "questions"?"常见问题":$title; ?></cite></a>
              </span>
              </div>
            <?php if($key == "questions"):?>
            <h3 class="layui-bg-gray">常见问题</h3>
            <div class="border-box-text">
              <?php foreach ($questions as $key => $value): ?>
                <h4 class="layui-bg-gray"><?php echo $value['title'] ?></h4>
                <p><?php echo $value['content'] ?></p>
              <?php endforeach ?>
            </div>
          <?php else: ?>
              <h3  class="layui-bg-gray"><?php echo $title; ?></h3>
              <div class="border-box-text"><?php echo $value; ?></div>
            <?php  endif; ?>
        </div>

      </div>
    </div>
  </div>
</article>
<?php $this->load->view('public/footer_view'); ?>