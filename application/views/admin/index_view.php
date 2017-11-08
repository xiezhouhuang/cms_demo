<?php $this->load->view('admin/public/header_view'); ?>
<style type="text/css">
    .layui-tab-title .zuomian .layui-tab-close {
        display: none;
    }
</style>
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header header header-demo">
                <div class="layui-main">
                    <a class="logo" href="javascript:;" >
                        <?php echo $_web_name; ?>
                    </a>
                    <ul class="layui-nav" lay-filter="">
                      <li class="layui-nav-item"><?php echo $admin_name ?></li>
                      <li class="layui-nav-item"><a href="javascript:;" onclick="clear_cache()">清除缓存</a></li>
                      <!-- <li class="layui-nav-item">
                        <a href="" title="消息">
                            <i class="layui-icon" style="top: 1px;">&#xe63a;</i>
                        </a>
                        </li> -->
                      <li class="layui-nav-item x-index"><a href="/">前台首页</a></li>
                       <li class="layui-nav-item"><a href="/admin/login/logout">退出</a></li>
                    </ul>
                </div>
            </div>
            <div class="layui-side layui-bg-black x-side">
                <div class="layui-side-scroll">
                    <ul class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
                        <li class="layui-nav-item">
                            <a class="javascript:;" href="javascript:;">
                                <i class="layui-icon" style="top: 3px;">&#xe614;</i><cite>系统设置</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/config">
                                        <cite>系统设置</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/notice/index/1">
                                        <cite>官方通知</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/notice/index/0">
                                        <cite>今日公告</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/notice/index/2">
                                        <cite>包赢公告</cite>
                                    </a>
                                </dd>
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/config/index/ZHITUIZHANJI">
                                            <cite>NBA重心战绩</cite>
                                        </a>
                                    </dd>
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/config/index/ZHONGXINZHANJI">
                                            <cite>NBA直推战绩</cite>
                                        </a>
                                </dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item layui-nav-itemed">
                            <a class="javascript:;" href="javascript:;">
                                <i class="layui-icon" style="top: 3px;">&#xe62d;</i><cite>赛事管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd class="">
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/product">
                                            <cite>赛事列表</cite>
                                        </a>
                                    </dd>
                                </dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a class="javascript:;" href="javascript:;">
                                <i class="layui-icon" style="top: 3px;">&#xe612;</i><cite>会员管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/member/">
                                        <cite>会员列表</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/order/">
                                        <cite>消费记录</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/order/baoying">
                                        <cite>包赢消费记录</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/member/balance_list/2">
                                        <cite>提现记录</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/member/balance_list/1">
                                        <cite>充值记录</cite>
                                    </a>
                                </dd>

                                 <dd class="">
                                    <a href="javascript:;" _href="/admin/member/balance_list/3">
                                        <cite>直推退款记录</cite>
                                    </a>
                                </dd>
                                <dd class="" style="display: none;">
                                    <a href="javascript:;" _href="/admin/member/balance_list/5">
                                        <cite>包赢退款记录</cite>
                                    </a>
                                </dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item ">
                            <a class="javascript:;" href="javascript:;">
                                <i class="layui-icon" style="top: 3px;">&#xe634;</i><cite>轮播管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd class="">
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/banner">
                                            <cite>轮播列表</cite>
                                        </a>
                                    </dd>
                                </dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item ">
                            <a class="javascript:;" href="javascript:;">
                                <i class="layui-icon" style="top: 3px;">&#xe630;</i><cite>新闻管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd class="">
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/news">
                                            <cite>新闻列表</cite>
                                        </a>
                                    </dd>
                                </dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item ">
                            <a class="javascript:;" href="javascript:;">
                                <i class="layui-icon" style="top: 3px;">&#xe60a;</i><cite>页面管理</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd class="">
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/config/index/ABOUT_US">
                                            <cite>关于我们</cite>
                                        </a>
                                    </dd>
                                </dd>
                                <dd class="">
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/config/index/WEBCONTACT">
                                            <cite>联系我们</cite>
                                        </a>
                                    </dd>
                                </dd>
                                <dd class="">
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/config/index/WEBGONGYING">
                                            <cite>合作共赢</cite>
                                        </a>
                                    </dd>
                                </dd>
                                <dd class="">
                                    <dd class="">
                                        <a href="javascript:;" _href="/admin/config/index/WEBSHENGMING">
                                            <cite>网站声明</cite>
                                        </a>
                                    </dd>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/question/index">
                                            <cite>常见问题</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/config/index/WXCHONGZHI">
                                            <cite>微信充值流程</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/config/index/ALICHONGZHI">
                                            <cite>支付宝充值流程</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/config/index/QUKUAN">
                                            <cite>取款流程</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/config/index/FOOTERMSG">
                                            <cite>底部信息</cite>
                                    </a>
                                </dd>
                                
                                
                            </dl>
                        </li>
                        <li class="layui-nav-item ">
                            <a class="javascript:;" href="javascript:;">
                                <i class="layui-icon" style="top: 3px;">&#xe60a;</i><cite>团队页面</cite>
                            </a>
                            <dl class="layui-nav-child">
                                <dd class="">
                                     <a href="javascript:;" _href="/admin/config/index/PAGETEAMINDEX">
                                        <cite>团队智汇</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/config/index/RANGFEN">
                                           <cite>让分团队</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/config/index/DAXIAOFEN">
                                           <cite>大小分团队</cite>
                                    </a>
                                </dd>
                                <dd class="">
                                    <a href="javascript:;" _href="/admin/config/index/DASHUJU">
                                        <cite>大数据团队</cite>
                                    </a>
                                </dd>
                                
                            </dl>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="layui-tab layui-tab-card site-demo-title x-main" lay-filter="x-tab" lay-allowclose="true">
                <div class="x-slide_left"></div>
                <ul class="layui-tab-title">
                    <li class="layui-this zuomian">
                        我的桌面
                    </li>
                </ul>
                <div class="layui-tab-content site-demo site-demo-body">
                    <div class="layui-tab-item layui-show">
                        <iframe frameborder="0" src="/admin/index/welcome" class="x-iframe"></iframe>
                    </div>
                </div>
            </div>
            <div class="site-mobile-shade">
            </div>
        </div>
        <?php $this->load->view('admin/public/script_view'); ?>
        <script type="text/javascript">
            layui.use(['element','layer'], function(){
                var $ = layui.jquery//jquery
                ,element = layui.element//面包导航//面包导航
               , layer = layui.layer;//弹出层

            });
            //-新增
            function clear_cache () {
                $.post('/admin/index/clear_cache',{'<?php echo $this->security->get_csrf_token_name(); ?>':"<?php echo $this->security->get_csrf_hash() ?>"},function() {
                    layer.msg('清除成功', {icon: 1,time:800});
                });
            }
        </script>
<?php $this->load->view('admin/public/footer_view'); ?>