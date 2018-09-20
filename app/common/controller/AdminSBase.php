<?php
namespace app\common\controller;

use org\Sauth;
use think\Loader;
use think\Cache;
use think\Controller;
use think\Db;
use think\Session;

/**
 * 后台公用基础控制器
 * Class AdminBase
 * @package app\common\controller
 */
class AdminSBase extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();

        $this->checkAuth();
        $this->getMenu();
        $this->webconfig();
    }

    /**
     * 权限检查
     * @return bool
     */
    protected function checkAuth()
    {

        if (!Session::has('admin_id')) {
            $this->redirect('adminshop/login/index');
        }else{
            $admin_id = Session::get('admin_id');
        }
        $request = request();
        $module     = $request->module();
        $controller = $request->controller();
        $action     = $request->action();

        // 排除权限
        $not_check = ['adminshop/Index/index', 'adminshop/AuthGroup/getjson', 'adminshop/System/clear'];

        if (!in_array($module . '/' . $controller . '/' . $action, $not_check)) {
            $sauth=new Sauth();
            $sauth->init(intval(session("role_id")),2);
            $hasauth = $sauth->check($module . '/' . $controller . '/' . $action);

            if(!$hasauth && ($admin_id != 1)){
                alertinfo("没有权限") ;
            }else{
                $str = "有权限";
            }
        }
    }

    /**
     * 获取侧边栏菜单
     */
    protected function getMenu()
    {
        $menu     = [];
        $admin_id = Session::get('admin_id');

        $sauth=new Sauth();
        $sauth->init(intval(session("role_id")),2);

        if( $admin_id == 1 ){
            $menu = $sauth->get_all_menu();
        }else{
            $menu = $sauth->get_menu_by_auth();
        }

        $this->assign('menu', $menu);
    }
    // 网站配置
    protected function webconfig(){
        $webset = db("sys_config")->where("meta_id=1 and meta_key ='site_name'")->select();
        $admin_info = get_ainfo(Session::get('admin_id'),'shop_admin','shop_auth_group');
        $navigate_admin = navigate_admin();

        $this->assign(['cdomain' => config('cdomain') , 'agroup' => config('agroup') , 'webset' => sort_info2($webset,'meta_key','meta_value') , 'navigate_admin' => $navigate_admin , 'admin_info' => $admin_info]);
    }
}