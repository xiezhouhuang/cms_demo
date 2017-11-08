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
              <a><cite><?php echo $_globals_bisai_category2[$product['category_id']] ?>答案购买</cite></a>
            </span>
          </div>
          <div class="layui-row" >
            <table class="layui-table" id="product_detail_id">
              <thead>
                <tr >
                  <th >赛事</th>
                  <th>主队</th>
                  <th><img src="/public/img/ball_black.png"></th>
                  <th >客队</th>
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
                  <td colspan="2">玩 法 : <?php echo $_globals_product_hot[$product['hot']] ?><?php echo $product['product_tags'] ?></td>
                </tr>
                <tr>
                  <td colspan="2">答 案 金 : <span class="layui-color-red"><?php echo $product['product_price'] ?></span></td>
                  <td colspan="2">盘 口 : <?php echo $product['pankou'] ?></td>
                </tr>
                <tr>
                  <td colspan="2">推荐类型 : <span class="layui-color-red"><?php echo $_globals_bisai_category3[$product['category_id']] ?></span></td>
                  <td colspan="2">保 障 : <?php echo $_globals_baozhang[$product['category_id']] ?></td>
                </tr>
                <tr>
                  <?php if ($is_buy > 0): ?>
                    <td colspan="4" class="layui-bg-red">推荐答案 : <?php echo $product['pankou'] ?><?php echo $product['daan'] ?></td>
                  <?php else: ?>
                    <td colspan="4">推    荐 : <span class="layui-color-red">此内容需要购买才能查看</span></td>
                  <?php endif ?>
                </tr>
              </tbody>
            </table>
          </div> 
          <div class="layui-row"  style="text-align: center;">
           
              <?php if ($is_buy < 0): ?>
                <a class="layui-btn layui-btn-danger" href="/login/">立即购买</a>
              <?php elseif($is_buy == 0): ?>
                 <?php if ($product['category_id'] == 4): ?>
                 <a class="layui-btn layui-btn-danger" href="/home/baoying">包赢直推不支持单买,去购买</a>
                  <?php else: ?>
                <button class="layui-btn layui-btn-danger" onclick="open_url('购买直推答案','/home/do_buy/<?php echo $product['product_id'] ?>')">立即购买</button>
                <?php endif ?>
              <?php endif ?>
            
            
            
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
