<?php $this->load->view('public/header_view'); ?>
    <link rel="stylesheet" media="all" type="text/css" href="/public/extends/style/style-demo.css">
    <script src="/public/extends/script/jquery-1.11.1.js"></script>
    <script src="/public/extends/script/jquery.easing-1.3.js"></script>
    <script src="/public/extends/script/jquery.mousewheel-3.1.12.js"></script>
    <script src="/public/extends/script/jquery.jcarousellite.js"></script>
  <style type="text/css">
    #FontScroll{float:left;height:28px;line-height:28px;overflow: hidden;}
  </style>
<article>

  <div class="layui-container ">
     <div class="notice_box layui-row">
      
      <div class="layui-col-sm3" style="font-weight: bold;width: auto;">
      <img src="/public/img/notice.png" height="28">今日推荐公告: &nbsp;&nbsp;&nbsp;</div>
      <div class="layui-col-sm9" id="FontScroll">
          <ul>
          <?php foreach ($notice_list as $key => $value): ?>
                 <li><?php echo $value['notice_content']; ?></li>
            <?php endforeach ?>
          </ul>
      </div>
      
    </div>
    <div class="layui-carousel" id="banner" style="margin-bottom: 5px;">
      <div carousel-item>
          <?php foreach ($_globals_banner['banner_big_0'] as $key => $value): ?>
               <div><img src="<?php echo $value ?>" width="100%"></div>
          <?php endforeach ?>
        <!-- <?php if (isset($_globals_banner['banner_3'])): ?>
          <div><img src="<?php echo $_globals_banner['banner_3'] ?>" width="100%"></div>
        <?php endif ?> -->
      </div>
    </div>
    <div class="layui-row  layui-col-space15 left-nav">
      <div class="layui-col-sm9">
          <div  id="small-banner" class="layui-bg-gray">
              <div class="custom-container default">
                  <a href="#" class="prev">&lsaquo;</a>
                    <div class="carousel">
                        <ul>
                          <?php foreach ($_globals_banner['banner_0'] as $key => $value): ?>
                            <li><a href="javascript:;" class="banner_0"><img src="<?php echo $value ?>"></a></li>
                          <?php endforeach ?>
                        </ul>
                    </div>
                  <a href="#" class="next">&rsaquo;</a>
                  <div class="clear"></div>
              </div>
          </div>
          <div class="layui-tab layui-tab-brief index-tab" lay-filter="docDemoTabBrief">
            <a href="index.php" class="layui-bg-black tab-right-link">NBA夏季联赛</a>
            <a href="index.php" class="layui-bg-black tab-right-link">NBA</a>
            <ul class="layui-tab-title">
              <li class="layui-this">早盘直推</li>
              <li>中场直推</li>
            </ul>

            <div class="layui-tab-content">
              <div class="layui-tab-item layui-show">
                <img src="/public/img/banner2.png" width="100%">
                <div class="layui-row index-product like-table">
                  <?php foreach ($zhongxin as $k => $v): ?>
                    <div class="index-product-item">
                      <table class="layui-table layui-table-center layui-table-no-padding index-product-item-table" lay-skin="nob" >
                        <tbody>
                          <tr>
                            <td width="142" rowspan="2" class="cate_img">
                            <?php if($v['status'] == 1): ?>
                              <img src="/public/img/zj2.png" >
                            <?php elseif($v['status'] == 2): ?>
                              <img src="/public/img/cuo.png" >
                            <?php else: ?>
                              <img src="/public/img/cate1.png" >
                            <?php endif; ?>
                            </td>
                            <td ><?php echo $v['zhudui'] ?></td><td rowspan="2">VS</td><td><?php echo $v['kedui'] ?></td>
                          </tr>

                         <tr><td>(主)</td><td>(客)</td></tr>
                        </tbody>
                      </table>
                      <table class="layui-table  small-table-padding"  lay-skin="nob">
                        <tbody>
                          <tr>
                            <td valign="top" width="30%" rowspan="6">
                            <img src="<?php echo $v['product_img'] ?>" width="100%"></td>
                            <td >重点推荐: <?php echo $_globals_bisai_style[$v['bisai_style']] ?></td>
                          </tr>
                          <tr><td>开赛时间: <?php echo $v['start_date'] ?></td></tr>
                          <tr><td>直推类型: <?php echo $_globals_product_hot[$v['hot']] ?><?php echo $v['product_tags'] ?></td></tr>
                          <tr><td>开赛盘口: <?php echo $v['pankou'] ?></td></tr>
                          <tr><td>答案价格: <?php echo $v['product_price'] ?>元</td></tr>
                          <tr><td>
                           <?php if ($v['status'] == 0): ?>
                            <button  onClick="location='/home/product_detail/<?php echo $v['product_id'] ?>'"   class="layui-btn buy-btn"></button>
                          <?php else: ?>
                             <button  onClick="location='/home/product_detail/<?php echo $v['product_id'] ?>'"  class="layui-btn zhongjian-btn"></button>
                          <?php endif; ?>
                        </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                  <?php endforeach; ?>
                  <?php foreach ($zaopan as $k => $v): ?>
                  <div class="index-product-item">
                      <table class="layui-table layui-table-center layui-table-no-padding index-product-item-table" lay-skin="nob" >
                        <tbody>
                          <tr>
                            <td width="142" rowspan="2" class="cate_img">
                            <?php if($v['status'] == 1): ?>
                              <img src="/public/img/zj2.png" >
                            <?php elseif($v['status'] == 2): ?>
                              <img src="/public/img/cuo.png" >
                            <?php else: ?>
                              <img src="/public/img/cate2.png" >
                            <?php endif; ?>
                            </td>
                            <td ><?php echo $v['zhudui'] ?></td><td rowspan="2">VS</td><td><?php echo $v['kedui'] ?></td>
                          </tr>

                         <tr><td>(主)</td><td>(客)</td></tr>
                        </tbody>
                      </table>
                      <table class="layui-table  small-table-padding"  lay-skin="nob">
                        <tbody>
                          <tr>
                            <td valign="top" width="1%" rowspan="6"></td>
                            <td >比赛推荐: <?php echo $_globals_bisai_style[$v['bisai_style']] ?></td>
                          </tr>
                          <tr><td>开赛时间: <?php echo $v['start_date'] ?></td></tr>
                          <tr><td>直推类型: <?php echo $_globals_product_hot[$v['hot']] ?><?php echo $v['product_tags'] ?></td></tr>
                          <tr><td>开赛盘口: <?php echo $v['pankou'] ?></td></tr>
                          <tr><td>答案价格: <?php echo $v['product_price'] ?>元</td></tr>
                          <tr><td>
                           <?php if ($v['status'] == 0): ?>
                            <button  onClick="location='/home/product_detail/<?php echo $v['product_id']?>'"   class="layui-btn buy-btn"></button>
                          <?php else: ?>
                             <button  onClick="location='/home/product_detail/<?php echo $v['product_id'] ?>'"   class="layui-btn zhongjian-btn"></button>
                          <?php endif; ?>
                        </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="layui-tab-item">
                <img src="/public/img/banner8.png" width="100%">
                 <div class="layui-row index-product like-table">
                  <?php foreach ($zhongchan as $k => $v): ?>
                  <div class="index-product-item">
                      <table class="layui-table layui-table-center layui-table-no-padding index-product-item-table" lay-skin="nob" >
                        <tbody>
                          <tr>
                            <td width="142" rowspan="2" class="cate_img">
                              <?php if($v['status'] == 1): ?>
                                <img src="/public/img/zj2.png" >
                              <?php elseif($v['status'] == 2): ?>
                                <img src="/public/img/cuo.png" >
                              <?php else: ?>
                                <img src="/public/img/zctj.png" >
                              <?php endif; ?>
                            </td>
                            <td ><?php echo $v['zhudui'] ?></td><td rowspan="2">VS</td><td><?php echo $v['kedui'] ?></td>
                          </tr>

                         <tr><td>(主)</td><td>(客)</td></tr>
                        </tbody>
                      </table>
                      <table class="layui-table  small-table-padding"  lay-skin="nob">
                        <tbody>
                          <tr>
                            <td valign="top" width="1%" rowspan="6"></td>
                            <td >比赛推荐: <?php echo $_globals_bisai_style[$v['bisai_style']] ?></td>
                          </tr>
                          <tr><td>开赛时间: <?php echo $v['start_date'] ?></td></tr>
                          <tr><td>直推类型: <?php echo $_globals_product_hot[$v['hot']] ?><?php echo $v['product_tags'] ?></td></tr>
                          <tr><td>开赛盘口: <?php echo $v['pankou'] ?></td></tr>
                          <tr><td>答案价格: <?php echo $v['product_price'] ?>元</td></tr>
                          <tr><td>
                           <?php if ($v['status'] == 0): ?>
                            <button  onClick="location='/home/product_detail/<?php echo $v['product_id']?>'"   class="layui-btn buy-btn"></button>
                          <?php else: ?>
                             <button  onClick="location='/home/product_detail/<?php echo $v['product_id'] ?>'"  class="layui-btn zhongjian-btn"></button>
                          <?php endif; ?></td></tr>
                        </tbody>
                      </table>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div> 
      </div>
       <?php $this->load->view('public/common_left_view'); ?>
    </div>
    <div><img src="/public/img/banner4.png" width="100%"></div>
</article>
    <script type="text/javascript">
        $(function() {
            $(".default .carousel").jCarouselLite({
                btnNext: ".default .next",
                btnPrev: ".default .prev",
                circular:false,
                visible: 3
            });
            
            $(".index-product").each(function() {
                $(this).children(".index-product-item").each(function(index) {
                  if(index%2 == 0){
                    $(this).addClass("index-product-item2");
                  }
               })
               var lenth = $(this).children(".index-product-item").size();
               $(this).find(".index-product-item").eq(lenth-1).addClass("index-product-last");
               if(lenth%2 == 0){
                  $(this).find(".index-product-item").eq(lenth-2).addClass("index-product-last");
               }
            })
        });

    </script>
<script>
(function($){
    $.fn.FontScroll = function(options){
        var d = {time: 5000,s: 'fontColor',num: 1}
        var o = $.extend(d,options);
        

        this.children('ul').addClass('line');
        var _con = $('.line').eq(0);
        var _conH = _con.height(); //滚动总高度
        var _conChildH = _con.children().eq(0).height();//一次滚动高度
        var _temp = _conChildH;  //临时变量
        var _time = d.time;  //滚动间隔
        var _s = d.s;  //滚动间隔


        _con.clone().insertAfter(_con);//初始化克隆

        //样式控制
        var num = d.num;
        var _p = this.find('li');
        var allNum = _p.length;

        _p.eq(num).addClass(_s);


        var timeID = setInterval(Up,_time);
        this.hover(function(){clearInterval(timeID)},function(){timeID = setInterval(Up,_time);});

        function Up(){
            _con.animate({marginTop: '-'+_conChildH});
            //样式控制
            _p.removeClass(_s);
            num += 1;
            _p.eq(num).addClass(_s);
            
            if(_conH == _conChildH){
                _con.animate({marginTop: '-'+_conChildH},"normal",over);
            } else {
                _conChildH += _temp;
            }
        }
        function over(){
            _con.attr("style",'margin-top:0');
            _conChildH = _temp;
            num = 1;
            _p.removeClass(_s);
            _p.eq(num).addClass(_s);
        }
    }
})(jQuery);

//$('#FontScroll').FontScroll({time: 5000,num: 1});

</script>
<?php $this->load->view('public/footer_view'); ?>
<script type="text/javascript">
layui.use(['element','carousel'], function(){
  var $ = layui.jquery,carousel = layui.carousel;
  //建造实例
  var ins =  carousel.render({
    elem: '#banner'
    ,width: '100%' //设置容器宽度
    ,height:'206'
    ,autoplay:false
    ,arrow: 'hover' //始终显示箭头
    ,indicator: 'none' //切换动画方式
  });
  $(".carousel ul li").click(function() {
    var index=   $(this).index();

    var  options = ins.config;
    if(index > options.index){
      ins.slide('add', index - options.index);
    } else if(index < options.index){
      ins.slide('sub', options.index - index);
    }
  })
  
});
</script>