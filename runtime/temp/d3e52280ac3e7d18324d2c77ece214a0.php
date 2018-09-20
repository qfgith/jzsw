<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"D:\wokerplace\juzhangshengwu\public/../app/home\view\aboutus.html";i:1537348565;s:64:"D:\wokerplace\juzhangshengwu\public/../app/home\view\header.html";i:1537351150;s:64:"D:\wokerplace\juzhangshengwu\public/../app/home\view\footer.html";i:1537340482;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="__GX__/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="__GX__/asset/css/swiper.min.css">
    <link rel="stylesheet" href="__GX__/asset/css/startStyle.css">
    <link rel="stylesheet" href="__GX__/asset/css/index.css">
    <title>工业大麻</title>
</head>
<body>
<div class="header">
    <div class="containers hidden-xs">
        <div class="header_pc">
            <div class="header_plogo"><a href="<?php echo url('/'); ?>"><img src="__GX__/asset/images/logo.jpg" alt=""></a></div>
            <div class="header_pnav">
                <ul>
                    <li class="active">
                        <div class="header_pnav1"><a href="<?php echo url('/'); ?>">首页</a></div>
                    </li>
                    <li>
                        <div class="header_pnav1"><a href="<?php echo url('/about'); ?>">关于我们</a></div>
                        <div class="header_pnav2">
                            <ul>
                                <?php if(is_array($secondnav) || $secondnav instanceof \think\Collection): $i = 0; $__LIST__ = $secondnav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li><a href="<?php echo url('about',['cid'=>$v['id']]); ?>"><?php echo $v['name']; ?></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="header_pnav1"><a href="./product_center.html">产品中心</a></div>
                        <div class="header_pnav2">
                            <ul>
                                <li><a href="./product_center.html">产品中心</a></li>
                                <li><a href="./product_center.html">产品中心</a></li>
                                <li><a href="./product_center.html">产品中心</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="header_pnav1"><a href="./yanjiufazhan.html">研究发展</a></div>
                        <div class="header_pnav2">
                            <ul>
                                <li><a href="./yanjiufazhan.html">研究发展</a></li>
                                <li><a href="./yanjiufazhan.html">研究发展</a></li>
                                <li><a href="./yanjiufazhan.html">研究发展</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="header_pnav1"><a href="./news_center.html">新闻资讯</a></div>
                        <div class="header_pnav2">
                            <ul>
                                <li><a href="./news_center.html">新闻资讯</a></li>
                                <li><a href="./news_center.html">新闻资讯</a></li>
                                <li><a href="./news_center.html">新闻资讯</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="header_pnav1"><a href="./maxueyuan.html">麻学院</a></div>
                        <div class="header_pnav2">
                            <ul>
                                <li><a href="./maxueyuan.html">麻学院</a></li>
                                <li><a href="./maxueyuan.html">麻学院</a></li>
                                <li><a href="./maxueyuan.html">麻学院</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="header_pnav1"><a href="./renliziyuan.html">人力资源</a></div>
                        <div class="header_pnav2">
                            <ul>
                                <li><a href="./renliziyuan.html">人力资源</a></li>
                                <li><a href="./contactus.html">联系我们</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="header_language">
                <a href="./index.html" class="lan_cn active">中文</a>
                <a href="./index.html" class="lan_en">EN</a>
                <span class="header_languagebg"></span>
            </div>
        </div>
    </div>
    <div class="headerMB  hidden-sm hidden-md hidden-lg">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="header_language">
                        <a href="./index.html" class="lan_cn active">中文</a>
                        <a href="./index.html" class="lan_en">EN</a>
                        <span class="header_languagebg"></span>
                    </div>
                    <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="./index.html">
                        <img src="__GX__/asset/images/logo.jpg" alt="" class="img-responsive">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="./index.html">首页</a></li>

                        <li>
                            <a href="./aboutus.html">关于我们</a>
                            <p><a href="./ab_compintro.html">公司简介</a></p>
                            <p><a href="./aboutus.html">董事长致辞</a></p>
                            <p><a href="./ab_teams.html">公司团队</a></p>
                        </li>

                        <li>
                            <a href="./product_center.html">产品中心</a>
                            <p><a href="./product_center.html">产品中心</a></p>
                            <p><a href="./product_center.html">产品中心</a></p>
                        </li>
                        <li>
                            <a href="./yanjiufazhan.html">研究发展</a>
                            <p><a href="./yanjiufazhan.html">研究发展</a></p>
                            <p><a href="./yanjiufazhan.html">研究发展</a></p>
                        </li>
                        <li>
                            <a href="./news_center.html">新闻资讯</a>
                            <p><a href="./news_center.html">新闻资讯</a></p>
                            <p><a href="./news_center.html">新闻资讯</a></p>
                        </li>
                        <li>
                            <a href="./maxueyuan.html">麻学院</a>
                            <p><a href="./maxueyuan.html">麻学院</a></p>
                            <p><a href="./maxueyuan.html">麻学院</a></p>
                        </li>
                        <li>
                            <a href="./renliziyuan.html">人力资源</a>
                            <p><a href="./renliziyuan.html">人力资源</a></p>
                            <p><a href="./contactus.html">联系我们</a></p>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </div>
</div>
    <div class="in_banner">
        <img src="__GX__/asset/images/w1920h400.png" style="background:url('__GX__/asset/images/18.png') no-repeat center center/cover;" class="img-responsive" alt="">
        <div class="in_ban_cont">
            <p><i>关于我们</i></p>
            <span>NEWS</span>
        </div>
    </div>
    <div class="aboutus">
        <div class="container">
            <div class="in_main_title in_title_pd">
                <h4>SPEECH</h4>
                <p>董事长致辞</p>
            </div>
            <div class="aboutus_cont">
                <p><img src="__GX__/asset/images/16.png" alt=""></p>
            </div>
        </div>
    </div>
<div class="footer">
    <div class="containers">
        <div class="footer_box">
            <div class="footer_logo hidden-xs"><img src="__GX__/asset/images/logo2.png" alt=""></div>
            <div class="footer_cont">
                <p><span>邮箱：juzhang@163.com</span><span>电话：13603063271</span><span>公司地址：云南省昆明市呈贡区春融街779号上海东盟大厦A座406室</span></p>
                <p>云南巨漳生物科技有限公司版权所有<a href="##">www.jzsw.com.cn</a>粤ICP备130812345号-1 法律声明</p>
            </div>
            <div class="footer_QRcode hidden-xs">
                <span>扫码关注我们</span>
                <img src="__GX__/asset/images/QRcode.jpg" alt="">
            </div>
        </div>
    </div>
</div>

<script src="__GX__/asset/js/jquery-3.2.1.js"></script>
<script src="__GX__/asset/js/bootstrap.min.js"></script>
<script src="__GX__/asset/js/swiper.min.js"></script>
<script>
    $(function(){
        $('.header_pnav >ul >li,.header_pnav2').mouseover(function(){
            $(this).siblings('li').find('.header_pnav2').stop().slideUp();
            $(this).find('.header_pnav2').stop().slideDown();
        })
        $('.header_pnav').mouseleave(function(){
            $('.header_pnav2').stop().slideUp();
        })
        $(window).resize(function(){
            // 响应首页
            var winW = $(window).width();
            if(winW < 1200){
                $('.containers').addClass('container').removeClass('containers');
            }else{
                $('.container').addClass('containers').removeClass('container');
            }
        }).trigger('resize')

    })
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
</body>
</html>