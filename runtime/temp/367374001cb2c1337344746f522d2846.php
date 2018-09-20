<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\wokerplace\juzhangshengwu\public/../app/admin\view\page_about_category\add.html";i:1535427774;s:63:"D:\wokerplace\juzhangshengwu\public/../app/admin\view\base.html";i:1537326424;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> 管理后台-<?php echo $webset['site_name']; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/bootstrap/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/bootstrap/css/font-awesome.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/bootstrap/css/ionicons.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/dist/css/style.css">
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo $cdomain; ?>__PTSTA__/dist/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $cdomain; ?>__PTSTA__/bootstrap/js/bootstrap.js"></script>
        <!-- boostrap datetimepicker -->
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <script src="<?php echo $cdomain; ?>__PTSTA__/plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <!-- iCheck 1.0.1 -->
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/plugins/iCheck/all.css">
        <script src="<?php echo $cdomain; ?>__PTSTA__/plugins/iCheck/icheck.min.js"></script>
        <!-- select2 -->
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/plugins/select2/select2.css">
        <script src="<?php echo $cdomain; ?>__PTSTA__/plugins/select2/select2.min.js"></script>
        <!--[if lt IE 9]>
        <script src="<?php echo $cdomain; ?>__PTSTA__/bootstrap/js/html5shiv.min.js"></script>
        <script src="<?php echo $cdomain; ?>__PTSTA__/bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini ">
        <div class="wrapper">
            <!-- top -->
            <header class="main-header">
                <div class="fix_div">
                    <!-- Logo -->
                    <a href="<?php echo url('admin/Index/index'); ?>" class="logo">
                        <span class="logo-mini"><b><?php echo $webset['site_name']; ?></b></span>
                        <span class="logo-lg"><b><?php echo $webset['site_name']; ?></b></span>
                    </a>
                    <nav class="navbar navbar-static-top">
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- User -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo $cdomain; ?><?php echo $admin_info['headpic']; ?>" class="user-image" >
                                        <span class="hidden-xs"><?php echo $admin_info['name']; ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="<?php echo $cdomain; ?><?php echo $admin_info['headpic']; ?>" class="img-circle" alt="User Image">
                                            <p><?php echo $admin_info['name']; ?> - <?php echo $admin_info['role_name']; ?><small>注册于 Nov. <?php echo date("Y",$admin_info['addtime']); ?></small></p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo url('admin/edit',['id'=>$admin_info['id']]); ?>" class="btn btn-default btn-flat">资料</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo url('login/logout'); ?>" class="btn btn-default btn-flat">登出</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Control Sidebar Toggle Button -->
                            </ul>
                        </div>

                    </nav>
                </div>
            </header>
            <!-- left -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php if(empty($admin_info['headpic']) || ($admin_info['headpic'] instanceof \think\Collection && $admin_info['headpic']->isEmpty())): ?>
                                <img class="img-circle" src="<?php echo $cdomain; ?>__PTSTA__/dist/img/user2-160x160.jpg" >
                            <?php else: ?>
                                <img class="img-circle" src="<?php echo $cdomain; ?><?php echo $admin_info['headpic']; ?>" >
                            <?php endif; ?>
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $admin_info['name']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $admin_info['role_name']; ?></a>
                        </div>
                    </div>
                    <!-- sidebar menu: : treeview --- navigate_admin.active = $vo[group] : active -->
                    <ul class="sidebar-menu">
                        <li class="header">导航</li>
                        <?php if(is_array($menu) || $menu instanceof \think\Collection): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
                        <li <?php if($navigate_admin['active'] == $vo['group']): ?>class="treeview active"<?php else: ?>class="treeview"<?php endif; ?> >
                            <a href="<?php echo url($vo['name']); ?>" >
                                <i class="<?php echo $vo['icon']; ?>"></i>
                                <span><?php echo $vo['title']; ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <?php if(!empty($vo['sub_menu'])): ?>
                            <ul class="treeview-menu">
                                <?php if(is_array($vo['sub_menu']) || $vo['sub_menu'] instanceof \think\Collection): if( count($vo['sub_menu'])==0 ) : echo "" ;else: foreach($vo['sub_menu'] as $key=>$v): ?>
                                    <li>
                                        <a href="<?php echo url($v['name']); ?>">
                                            <i class="<?php echo $v['icon']; ?>"></i><?php echo $v['title']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <div class="content-wrapper">
                <!-- breadcrumb -->
                <div class="breadcrumbs" id="breadcrumbs">
                    <ol class="breadcrumb">
                    <?php if(is_array($navigate_admin['list']) || $navigate_admin['list'] instanceof \think\Collection): if( count($navigate_admin['list'])==0 ) : echo "" ;else: foreach($navigate_admin['list'] as $k=>$v): if($k == '后台首页'): ?>  
                            <li><a href="<?php echo $v; ?>"><i class="fa fa-dashboard"></i>&nbsp;&nbsp;<?php echo $k; ?></a></li>
                        <?php else: ?>    
                            <li><a href="<?php echo $v; ?>"><?php echo $k; ?></a></li>
                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>          
                    </ol>
                </div>
                <!--主体-->
                 
<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="info_box">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">详细信息</h3>
                    </div>                       
                    <form id="form1" method="post" action="<?php echo url('admin/PageAboutCategory/save'); ?>">
                        
                        <div class="panel mt20">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td id="box">上级栏目</td>
                                        <td >
                                             <select name="pid" lay-verify="required" class='col-sm-4 form-control select2'>
                                                <option value="0">--无--</option>
                                                <?php if(is_array($category_level_list) || $category_level_list instanceof \think\Collection): if( count($category_level_list)==0 ) : echo "" ;else: foreach($category_level_list as $key=>$vo): ?>
                                                <option value="<?php echo $vo['id']; ?>" <?php if($pid==$vo['id']): ?> selected="selected"<?php endif; ?>><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' ----';} endif; ?> <?php echo $vo['name']; ?></option>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td id="box">栏目名称</td>
                                        <td >
                                            <input type="text" name="name" value="" required  lay-verify="required" placeholder="栏目名称" class="form-control">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td id="box">别名</td>
                                        <td >
                                            <input type="text" name="alias" value=""  placeholder="别名" class="form-control">
                                        </td>
                                    </tr>
                                    

                                    <tr>
                                        <td id="box"> banner图 </td>
                                        <td >
                                            <input type="text" name="thumb" id="img" size="50" value="" class="layui-input input-text">
                                            <button type="button" class="btn btn-primary layui_upimage">上传图片</button>
                                            <img src="" class="th1_img imgb">
                                        </td>
                                    </tr>
                                    

                                    <tr>
                                        <td id="box">描述</td>
                                        <td >
                                            <textarea name='introduction' class="form-control" placeholder="描述" rows='5'></textarea>
                                        </td>
                                    </tr>

                                   

                                    <tr>
                                        <td class="col-sm-2"></td>
                                        <td class="col-sm-8 text-right">
                                            <input class="btn btn-primary" type="submit" lay-submit lay-filter="*" value="保存">
                                        </td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>



            </div>
            <!-- bottom -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs"></div>
                <strong>Copyright &copy; 2014-<?php echo date("Y"); ?> .</strong> All rights
                reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- AdminLTE App -->
        <!-- <script>
            var GV = {
                current_controller: "admin/<?php echo (isset($controller) && ($controller !== '')?$controller:''); ?>/",
                base_url: "<?php echo $cdomain; ?>__PTSTA__"
            };
        </script>
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/plugins/layui/css/layui.css" media="all">
        <script src="<?php echo $cdomain; ?>__PTSTA__/plugins/layui/lay/dest/layui.all.js"></script>
        <script src="<?php echo $cdomain; ?>__PTSTA__/dist/js/func.js"></script> -->
        <link rel="stylesheet" href="<?php echo $cdomain; ?>__PTSTA__/plugins/layui230/css/layui.css" media="all">
        <script src="<?php echo $cdomain; ?>__PTSTA__/plugins/layui230/layui.all.js"></script>
        <script src="<?php echo $cdomain; ?>__PTSTA__/dist/js/func2.js"></script>
        <script src="<?php echo $cdomain; ?>__PTSTA__/dist/js/app.min.js"></script>
    </body>
</html>