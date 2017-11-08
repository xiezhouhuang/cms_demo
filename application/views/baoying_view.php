<?php $this->load->view('public/header_view'); ?>
<article class="baoying">

  <div class="layui-container ">
    <br />
    <div class="layui-row">
      <?php if (isset($_globals_banner['banner_4'])): ?>
        <img src="<?php echo $_globals_banner['banner_4'] ?>" width="100%">
      <?php endif ?>
    </div>
    <br />
    <div class="layui-row" style="border-bottom: 1px solid #CCC; height: 64px; ">
      <div class="layui-col-sm3" style="width: 220px ">
        <img src="/public/img/baoying.png" height="100%">
      </div>
      <div class="layui-col-sm8 layui-color-red" style="text-align: bottom;line-height: 64px; font-size: 18px">
        5场命中率达到60%以上才收取答案金,达不到60%以上退还全部答案金
      </div>
    </div>
    <br />
    <div class="layui-row layui-text" >
      <p><span class="layui-color-red">每轮场次 :</span> 包赢直推每轮五场比赛,五场比赛将会在1-3天内直推完毕</p>
      <p><span class="layui-color-red">收费细则 :</span> 五场比赛答案金将会一次性收取,客户只需要等待每天比赛推出,直接查看答案即可;</p>
      <p><span class="layui-color-red">退费细节 :</span> 每轮5场比赛全部推荐完毕,命中率达到60%以上(包括60%),我们才收取答案金。答案金按中奖场次收取
      <p style="text-indent: 68px">比如5中5,则收取全部答案金;5中4,则收4场退1场;5中3,则收3场退2场。</p>
    </div>
    <hr>
    <br />
    <div class="layui-row">
      <h3>已结束比赛</h3>
      <table class="layui-table layui-table-center" lay-even lay-skin="nob">
        <thead>
          <tr>
            <th></th>
            <th>时间</th>
            <th>联赛</th>
            <th>主队</th>
            <th>盘口</th>
            <th>客队</th>
            <th>比赛结果</th>
            <th></th>
          </tr> 
        </thead>
        <tbody  class="tableData2">
          <?php foreach ($product_list as $k  => $v): ?>
            <?php 
            if($v['status'] == 1){
                  $status = '<span class="layui-color-red">中</span>';
               }else if($v['status'] == 2){
                $status = '<span class="layui-color-gray">错</span>';
               }else{
                  $status = '<span class="layui-color-block">未开奖</span>';
               } 
            ?>
                <?php if ($k >= $beizhu && $k < ($beizhu+5) ): ?>
                  <tr>
                    <td><?php echo ($count-$k) ?></td>
                    <td><?php echo date('m-d H:i',strtotime($v['start_date'])) ?></td>
                    <td><span class="layui-btn layui-bg-gray layui-btn-mini"><?php echo $_globals_bisai_style[$v['bisai_style']] ?></span></td>
                    <td><?php echo $v['zhudui'] ?></td>
                    <td><?php echo $v['daan'].$v['pankou'] ?></td>
                    <td><?php echo $v['kedui'] ?></td>
                    <td><?php echo $status ?></td>
                     <td><a href="/home/product_detail/<?php echo $v['product_id'] ?>">查看详情</a></td>
                  </tr>
                <?php endif ?>
           <?php endforeach ?>
        </tbody>
      </table>
    </div>
     <br />
    <br />
    <div class="layui-row layui-text">
            <div style="float: left;height: 31px;padding-right: 10px">
            <?php if ($is_buy_baoying < 0): ?>
                <a class="layui-btn buy-btn-red" href="/login/"></a>
              <?php else: ?>
                 <button  class="layui-btn buy-btn-red" onclick="to_buy('<?php echo $is_buy_baoying ?>')"></button>
              <?php endif ?>
              </div>
              <div style="float: left;height: 31px;line-height: 31px;">
                <i class="layui-icon" style="color: #000;font-size: 30px;">&#xe645;</i>
                <?php foreach ($notice_list as $v): ?>
                    <span style="font-size: 16px;"><?php echo $v['notice_content'] ?></span>
                <?php endforeach ?>
              </div>
              <div class="layui-clear"></div>
      <table class="layui-table layui-table-center" lay-even lay-skin="nob">
        <thead>
          <tr class="layui-bg-black">
            <th></th>
            <th>时间</th>
            <th>联赛</th>
            <th>主队</th>
            <th>玩法</th>
            <th>客队</th>
            <th>结果</th>
            <th></th>
          </tr> 
        </thead>
        <tbody class="tableData">
          <?php for ($i=abs($beizhu -5); $i > 0 ; $i--): ?>
             <tr><td><?php echo ($count+$i); ?></td><td colspan="7" style="text-align: left;">空缺</td></tr>
          <?php endfor ?>
          <?php 
            $baoying_product  = array();
            $baoying_price = 0;
            $status =  0;
           ?>
           <?php foreach ($product_list as $k  => $value): ?>
                <?php if ($k < $beizhu): ?>
                  <?php if ($k == ($beizhu-1)):  // 读取第一条?> 
                      <?php  
                          
                          $baoying_price = $value['product_price']; 
                       ?>
                  <?php endif ?>
                  <?php 
                   $status  += $value['status'];
                   $baoying_product[]  = array('product_id' => $value['product_id'],'product_price' => $value['product_price']); 
                   ?>
                   <?php 

                    if($value['status'] == 1){
                          $status_msg = '<span class="layui-color-red">中</span>';
                       }else if($value['status'] == 2){
                          $status_msg = '<span class="layui-color-gray">错</span>';
                       }else{
                          $status_msg = '<span class="layui-color-block">未开奖</span>';
                       } 
                    ?>
                  <tr>
                    <td><?php echo ($count-$k) ?></td>
                    <td><?php echo  date('m-d H:i',strtotime($value['start_date'])) ?></td>
                    <td><span class="layui-btn layui-bg-blue layui-btn-mini">
                      <?php echo  $_globals_bisai_style[$value['bisai_style']] ?></span></td>
                    <td><?php echo  $value['zhudui'] ?></td>
                    <td><?php echo  $_globals_product_hot[$value['hot']].$value['product_tags'] ?></td>
                    <td><?php echo  $value['kedui'] ?></td>
                    <td><?php echo $status_msg ?></td>
                    <td><a href="/home/product_detail/<?php echo  $value['product_id'] ?>">查看详情</a></td>
                  </tr>
                <?php endif ?>
                
           <?php endforeach ?>
        </tbody>
      </table>
      <br/>
      <br/>
    </div>
</article>
<?php $this->load->view('public/footer_view'); ?>
<script type="text/javascript">
  function doit(f, t) {
        
  }
  function to_buy(is_buy) {
    var status  = '<?php echo $status ?>';

    if(parseInt(status) > 0 ){
      layer.alert("本轮直推已经有开奖的,不能购买",{icon:2});
      return;
    }
    if(is_buy == 0){
        open_url('购买包赢直推答案','/home/do_buy_baoying/?baoying_price=<?php echo $baoying_price ?>&baoying_product=<?php echo urlencode(json_encode($baoying_product)) ?>');
    }else{
       layer.alert("您购买的五场包赢直推还未全部开奖",{icon:2});
    }
  }

  layui.use(['element','laypage'], function(){

  var $ = layui.jquery, element = layui.element,laypage=layui.laypage;
  laypage.render({
    elem: 'baoying_list_page'
    ,limit: 10
    ,count: <?php echo $count; ?>
    ,layout: ['prev', 'page', 'next', 'skip']
    ,jump: function(obj,first){
        $.get('/home/get_more_baoying/',{per_page:obj.curr},function(data) {
            $('#baoying_list').html(data.data);
         })
    }
  });

  $(".tableData tr:nth-child(" + 1 + ")").insertAfter($(".tableData tr:nth-child(" + 5 + ")"));
  $(".tableData tr:nth-child(" + 1 + ")").insertAfter($(".tableData tr:nth-child(" + 4 + ")"));
  $(".tableData tr:nth-child(" + 1 + ")").insertAfter($(".tableData tr:nth-child(" + 3 + ")"));
  $(".tableData tr:nth-child(" + 1 + ")").insertAfter($(".tableData tr:nth-child(" + 2 + ")"));

  $(".tableData2 tr:nth-child(" + 1 + ")").insertAfter($(".tableData2 tr:nth-child(" + 5 + ")"));
  $(".tableData2 tr:nth-child(" + 1 + ")").insertAfter($(".tableData2 tr:nth-child(" + 4 + ")"));
  $(".tableData2 tr:nth-child(" + 1 + ")").insertAfter($(".tableData2 tr:nth-child(" + 3 + ")"));
  $(".tableData2 tr:nth-child(" + 1 + ")").insertAfter($(".tableData2 tr:nth-child(" + 2 + ")"));

});
</script>