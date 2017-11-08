<style type="text/css">
  .touxiang_img{
    width: 70px;
    height: 70px;
    line-height: 70px;
    margin: 0 auto;
    text-align: center;
    background-color: #FFF;
    cursor: pointer;
    color: #fff;
    border-radius: 50%;
  }
</style>
<?php 
    $index1 = "";
    $index2 = "";
    $index3 = "";
    $index4 = "";
    $index5 = "";
    $index6 = "";
    if ($this->uri->segment(2) == 'order'){
      $index2   = "layui-color-red";
    }else if ($this->uri->segment(2) == 'money'){
      $index3   = "layui-color-red";
    }else if($this->uri->segment(2) == 'chongzhi' ){
      $index4  = "layui-color-red";
    }else if($this->uri->segment(2) == 'tikuan' ){
      $index5  = "layui-color-red";
    }else if($this->uri->segment(2) == 'notice' ){
      $index6  = "layui-color-red";
    }else{
      $index1  = "layui-color-red";
    }
   ?>
      <div class="layui-col-sm2" style="width: 191px;height: 714px">
        <div class="left-box">
            <a  href="javascript:x_admin_show('修改头像','/home/upload_touxiang',1000,700)">
              <?php if ($member_info['touxiang'] != ""): ?>
                  <img src="<?php echo $member_info['touxiang'] ?>"  width="100%"  class="touxiang_img">
                <?php else: ?>
                  <img src="/public/img/touxiang.png"  width="100%"  class="touxiang_img">
              <?php endif ?>
              
            </a>
        </div>
        <div class="left-box">
           <a href="/member/" class="<?php echo $index1 ?>"><i class="iconfont ">&#xe62a;</i><br/>个人中心</a>
        </div> 
        <div class="left-box">  
           <a href="/member/order"  class="<?php echo $index2 ?>"><i class="layui-icon" style="font-size: 48px;">&#xe63c;</i><br/>购买记录</a>
        </div>
        <div class="left-box">
           <a href="/member/money"  class="<?php echo $index3 ?>"><i class="layui-icon">&#xe62a;</i><br/>消费明细</a>
        </div>

        <div class="left-box">
          <a href="/member/chongzhi"  class="<?php echo $index4 ?>"><i class="iconfont">&#xe619;</i><br/>充值</a>
        </div>
        <div class="left-box">
          <a href="/member/tikuan/"  class="<?php echo $index5 ?>"><i class="iconfont" style="font-size: 48px;">&#xe681;</i><br/>提款</a>
        </div>
        <div class="left-box">
          <a href="/member/notice"  class="<?php echo $index6 ?>"><i class="layui-icon">&#xe645;</i><br/>通知</a>
        </div>
      </div>
