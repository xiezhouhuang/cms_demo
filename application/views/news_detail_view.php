<?php $this->load->view('public/header_view'); ?>
<style type="text/css">
  .news_detail_content img{
    text-align: center;
    max-width: 450px;
    display: block;
    margin: 0 auto;
  }

</style>
<article>
<br />
  <div class="layui-container ">
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
        <div class="breadcrumb-box" >
          <span class="layui-breadcrumb">
            <a href="/">首页</a>
            <a href="/home/news">内部资讯</a>
            <a><cite>详细</cite></a>
          </span>
        </div>
        <div class="layui-text" style="text-align: center;">
          <h2 class="layui-color-red"><?php echo $news['news_title'] ?></h2>
          <hr>
          <p>资料来源 : <?php echo $news['news_sub'] ?> <?php echo $news['create_date'] ?></p>
        </div>
        <br />
        <div class="layui-text news_detail_content">
        <p><?php echo $news['news_content'] ?></p>
        </div>
        <br />
        <br />
        <br />
      </div>

       <?php $this->load->view('public/common_left_view'); ?>
    </div>
</article>
<?php $this->load->view('public/footer_view'); ?>