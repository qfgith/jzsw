<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"D:\wokerplace\juzhangshengwu\public/../app/home\view\index.html";i:1537347559;s:64:"D:\wokerplace\juzhangshengwu\public/../app/home\view\header.html";i:1537405798;s:64:"D:\wokerplace\juzhangshengwu\public/../app/home\view\footer.html";i:1537340482;}*/ ?>
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
<div class="gydm_banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php if(is_array($slide_index) || $slide_index instanceof \think\Collection): $i = 0; $__LIST__ = $slide_index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="swiper-slide">
                <div class="gydm_bannerbox">
                    <img src="<?php echo $vo['image']; ?>" style="background:url('__GX__/asset/images/banner.jpg') no-repeat center center/cover;" class="img-responsive" alt="">
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<div class="gydm_about paddingbox">
    <div class="containers">
        <div class="gydm_titles">
            <h4>关于我们</h4>
            <p><img src="__GX__/asset/images/line.jpg" alt=""></p>
        </div>
        <div class="gydm_about_cont">
            <p>云南巨漳生物科技有限公司（简称“巨漳生物”）成立于2018年，注册资本3000万元人民币，位于云南省昆明市呈贡新区上海东盟商务大厦A座6楼，是巨漳生物科技C（深圳）有限公司全资子公司，是一家以大健康产品为研究方向的生物科技公司。本着“诚以聚人，信以筑梦，漳以成渊”的理念，巨漳生物汇集了从事工业大麻研究、种植、加工、熟知工业大麻行业运营、管理以及具有丰富资本市场运作经验的多个专业团队。</p>
            <div class="gydm_ab_btn">
                <a href="./aboutus.html">查看详情 <i>&gt;&gt;</i></a>
            </div>
        </div>
    </div>
</div>
<div class="show_list">
    <ul>
        <li class="">
            <div class="show_listbox dis_flex">
                <div class="show_liscont flex1">
                    <div class="show_cbox">
                        <div class="show_listitle">
                            <p><img src="__GX__/asset/images/2.png" alt=""></p>
                            <h4>大麻二酚</h4>
                            <p>Cannabidiol</p>
                        </div>
                        <div class="show_contents">
                            <p>大麻酚　一种麻醉药，分子式C21H26O2。它存在于大麻叶中,有止咳、镇痉、止痛、镇静、安眠等活性。为一种嗜好品，吸食后产生精神愉快感，能致习惯性，应用时应小心。大麻叶中含有多种大麻酚类衍生物，已分离到15种以上,较重要的有:大麻酚、大麻二酚、四氢大麻酚、大麻酚酸、大麻二酚</p>
                            <div class="show_btns"><a href="./product_detail.html">查看详情 <i>&gt;&gt;</i></a></div>
                        </div>
                    </div>
                </div>
                <div class="show_lisimg flex1">
                    <img src="__GX__/asset/images/w1000h550.png" style="background:url('__GX__/asset/images/1.jpg') no-repeat center center/cover;" class="img-responsive" alt="">
                </div>
            </div>
        </li>
        <li>
            <div class="show_listbox dis_flex">
                <div class="show_lisimg flex1">
                    <img src="__GX__/asset/images/w1000h550.png" style="background:url('__GX__/asset/images/1.jpg') no-repeat center center/cover;" class="img-responsive" alt="">
                </div>
                <div class="show_liscont flex1">
                    <div class="show_cbox">
                        <div class="show_listitle">
                            <p><img src="__GX__/asset/images/3.png" alt=""></p>
                            <h4>大麻二酚</h4>
                            <p>Cannabidiol</p>
                        </div>
                        <div class="show_contents">
                            <p>大麻酚　一种麻醉药，分子式C21H26O2。它存在于大麻叶中,有止咳、镇痉、止痛、镇静、安眠等活性。为一种嗜好品，吸食后产生精神愉快感，能致习惯性，应用时应小心。大麻叶中含有多种大麻酚类衍生物，已分离到15种以上,较重要的有:大麻酚、大麻二酚、四氢大麻酚、大麻酚酸、大麻二酚</p>
                            <div class="show_btns"><a href="./product_detail.html">查看详情 <i>&gt;&gt;</i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="gydm_yy paddingbox">
    <img src="__GX__/asset/images/6.jpg" class="gydm_yyright" alt="">
    <img src="__GX__/asset/images/5.jpg" class="gydm_yyleft" alt="">
    <div class="gydm_titles">
        <h4>工业大麻应用</h4>
        <p><img src="__GX__/asset/images/line.jpg" alt=""></p>
    </div>
    <div class="containers">
        <ul class="dis_flex gydm_yylist">
            <li class="flex1">
                <div class="gydm_yybox">
                    <div class="gydm_yyimg"><img src="__GX__/asset/images/w300h300.png" style="background:url('__GX__/asset/images/4.png') no-repeat center center/cover;" class="img-responsive" alt=""></div>
                    <h4>籽的利用</h4>
                    <p>大麻籽易于消化，比奇亚籽或亚麻籽的蛋白质含量更高，是一种健康食品。</p>
                </div>
            </li>
            <li class="flex1">
                <div class="gydm_yybox">
                    <div class="gydm_yyimg"><img src="__GX__/asset/images/w300h300.png" style="background:url('__GX__/asset/images/4.png') no-repeat center center/cover;" class="img-responsive" alt=""></div>
                    <h4>纤维利用</h4>
                    <p>大麻籽易于消化，比奇亚籽或亚麻籽的蛋白质含量更高，是一种健康食品。</p>
                </div>
            </li>
            <li class="flex1">
                <div class="gydm_yybox">
                    <div class="gydm_yyimg"><img src="__GX__/asset/images/w300h300.png" style="background:url('__GX__/asset/images/4.png') no-repeat center center/cover;" class="img-responsive" alt=""></div>
                    <h4>花叶利用</h4>
                    <p>大麻籽易于消化，比奇亚籽或亚麻籽的蛋白质含量更高，是一种健康食品。</p>
                </div>
            </li>
            <li class="flex1">
                <div class="gydm_yybox">
                    <div class="gydm_yyimg"><img src="__GX__/asset/images/w300h300.png" style="background:url('__GX__/asset/images/4.png') no-repeat center center/cover;" class="img-responsive" alt=""></div>
                    <h4>杆的利用</h4>
                    <p>大麻籽易于消化，比奇亚籽或亚麻籽的蛋白质含量更高，是一种健康食品。</p>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="gydm_news paddingbox" style="background:url('__GX__/asset/images/8.jpg') no-repeat center center/cover;">
    <div class="containers">
        <div class="gydm_titles">
            <h4>新闻资讯</h4>
            <p><img src="__GX__/asset/images/line.jpg" alt=""></p>
        </div>
        <div class="gydm_tabs">
            <div class="gydm_tabs_nav">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#gydm_new1" aria-controls="gydm_new1" role="tab" data-toggle="tab">行业新闻</a></li>
                    <li role="presentation"><a href="#gydm_new2" aria-controls="gydm_new2" role="tab" data-toggle="tab">公司新闻</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="gydm_new1">
                    <div class="gydm_newsbox row">
                        <div class="gydm_newsbl col-sm-6">
                            <a href="./news_detail.html">
                                <div class="gydm_newsblimg">
                                    <img src="__GX__/asset/images/w900h700.png" style="background:url('__GX__/asset/images/11.png') no-repeat center center/cover;" class="img-responsive" alt="">
                                </div>
                                <div class="gydm_newsblcont">
                                    <h4><i></i>云南巨漳生物科技有限公司古景腾董事长调研考察</h4>
                                    <p>云南巨漳生物科技有限公司古景腾董事长调研考察云南巨漳生物科技有限公司古景腾董事长调研考察</p>
                                    <img src="__GX__/asset/images/left.png" alt="">
                                </div>
                            </a>
                        </div>
                        <div class="gydm_newsbr col-sm-6">
                            <a href="./news_detail.html">
                                <div class="gydm_newsbrimg"><img src="__GX__/asset/images/w900h340.png" style="background:url('./__GX__/asset/images/10.png') no-repeat center center/cover;" class="img-responsive" alt=""></div>
                                <div class="gydm_newsbrcont">
                                    <p class="line1"><i></i>云南巨漳生物科技有限公司古景腾董事长调研考察<img src="__GX__/asset/images/left.png" alt=""></p>
                                </div>
                            </a>
                            <a href="./news_detail.html">
                                <div class="gydm_newsbrimg"><img src="__GX__/asset/images/w900h340.png" style="background:url('./__GX__/asset/images/10.png') no-repeat center center/cover;" class="img-responsive" alt=""></div>
                                <div class="gydm_newsbrcont">
                                    <p class="line1"><i></i>云南巨漳生物科技有限公司古景腾董事长调研考察<img src="__GX__/asset/images/left.png" alt=""></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="gydm_new2">...</div>
            </div>
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