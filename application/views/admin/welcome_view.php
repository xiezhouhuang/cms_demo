<?php $this->load->view('admin/public/header_view'); ?>
    <style type="text/css">
        .layui-col-sm6{
            text-align: center;
            padding: 20px;
        }
        .count_box{
            font-size: 20px;
            font-weight: 550;
            padding: 100px 0px;
            text-align: center;
            vertical-align: middle;
        }
        .count_box p{
            font-size: 36px;
            padding: 10px;
        }

    </style>
        <div class="x-body">
            <blockquote class="layui-elem-quote">
                概况
            </blockquote>
            <div class="layui-row">
                

                <div class="layui-col-sm6 ">
                    <div class="count_box layui-bg-red">
                        待开奖总赛事
                        <p><?php echo $product_status_count ?></p>
                    </div>
                </div>
                 <div class="layui-col-sm6 ">
                    <div class="count_box layui-bg-cyan">
                        消费总数<p><?php echo $order_count ?></p>
                    </div>
                </div>
                <div class="layui-col-sm6 ">
                    <div class="count_box layui-bg-orange">
                        会员总数<p><?php echo $member_count ?></p>
                    </div>
                </div>

                <div class="layui-col-sm6 ">
                    <div class="count_box layui-bg-green">
                        赛事总数<p><?php echo $product_count ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-footer footer footer-demo">
            <div class="layui-main">
                
                <p>
                    <?php echo $_web_footer_copyright ?>
                </p>
            </div>
        </div>
       <?php $this->load->view('admin/public/script_view'); ?>
<?php $this->load->view('admin/public/footer_view'); ?>