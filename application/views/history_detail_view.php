<?php $this->load->view('public/header_view'); ?>
<style type="text/css">
  #product_detail_id th{
    text-align: center;
  }
</style>
<article class="ss-buy">

  <div class="layui-container ">
    <br />
    <div class="layui-row  layui-col-space20 left-nav">
      <div class="layui-col-sm9">
          <div class="breadcrumb-box" >
            <span class="layui-breadcrumb">
              <a href="/">首页</a>
              <a href="/home/history">推荐战绩</a>
              <a><cite>推荐战绩结果</cite></a>
            </span>
          </div>
          <div class="layui-row" >
            <table class="layui-table" id="product_detail_id">
              <thead>
                <tr >
                  <th>赛事</th>
                  <th>主队</th>
                  <th><img src="/public/img/ball_black.png"></th>
                  <th>客队</th>
                </tr> 
              </thead>
              <tbody>
                <tr style="text-align: center;">
                  <td><?php echo $_globals_bisai_style[$product['bisai_style']] ?></td>
                  <td><?php echo $product['zhudui'] ?></td>
                  <td><span class="layui-color-blue" style="font-size: 20px">VS</span></td>
                  <td><?php echo $product['kedui'] ?></td>
                </tr>
                <tr>
                  <td colspan="2">比赛时间 : <?php echo $product['start_date'] ?></td>
                  <td colspan="2">保 障 : <?php echo $_globals_baozhang[$product['category_id']] ?></td>
                </tr>
              </tbody>
            </table>

            <div class="layui-row like-table">
              <div class="layui-col-sm8 layui-col-sm-offset2">
              <table class="layui-table layui-table-center" >
                <tr>
                  <td>比赛玩法</td>
                  <td><span class="layui-color-red"><?php echo $_globals_product_hot[$product['hot']] ?><?php echo $product['product_tags'] ?></span></td>
                  <td rowspan="4"><img src="/public/img/logo.png" width="200"></td>
                </tr>
                <tr>
                  <td>盘口</td>
                  <td><span class="layui-color-red"><?php echo $product['pankou'] ?></span></td>
                </tr>
                <tr>
                  <td>直推答案</td>
                  <td><span class="layui-color-red"><?php $product['daan'] ?></span></td>
                </tr>
                <tr>
                  <td>推荐类型</td>
                  <td><span class="layui-color-red"><?php echo $_globals_bisai_category3[$product['category_id']] ?></span></td>
                </tr>
              </table>
              </div>
              <div class="layui-col-sm4 layui-col-sm-offset4">
              <table class="layui-table layui-table-center" >
                <tr>
                  <td>比分</td>
                  <td><span class="layui-color-red"><?php echo $product['product_name'] ?></span></td>
                </tr>
                <tr>
                  <td>结果</td>
                  <td>
                    <?php if ($product['status'] == 1): ?>
                      <span class="layui-color-red">中</span>
                    <?php elseif($product['status'] == 2): ?>
                      <span class="layui-color-gray">错</span>
                    <?php else: ?>
                      <span class="layui-color-black">未开奖</span>
                    <?php endif ?>
                  

                  </td>
                </tr>
              </table>
              </div>
            </div>
          </div> 
          <br />
          <br />
          <br />
          <br />
          <br />
          <div class="layui-row layui-text">
            <p><h4>NBA直推网声明</h4></p>
            <p>1、为保障直推的准确性和权威性,所有答案都是出BA直推网专家团队直接推介。</p>
            <p>2、所有的推荐仅供合法体育彩票投注参考。</p>
            <p>3、本站只专业推荐NBA赛事,其他赛事特殊情况下(比如极度看好)可做为补充。</p>
            <p>4、为维护会员权益,如有疑问联系我们的服务QQ或微信</p>
          </div>
      </div>
       <?php $this->load->view('public/common_left_view'); ?>
    </div>
</article>
<?php $this->load->view('public/footer_view'); ?>