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
class AdminBase extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();

        $this->checkAuth();
        $this->getMenu();
        $this->webconfig();
         $request = \think\Request::instance();
        $currentcontr=$request->controller();
        
//var_dump($currentcontr);die;
        switch($currentcontr){
            case 'Team':   //团队
                $this->spai=1;
                break;
            case 'Cases':   //成功案例
                $this->spai=2;
                break;
            case 'MaXueYuan': //麻学院
                $this->spai=3;
                break;
            case 'Article':
                $this->spai=4;  //文章
                break;
            case 'Page':
                $this->spai=10;  //单页
                break;
            default:
                $this->spai = -1;

        }
        
    }

    /**
     * 权限检查
     * @return bool
     */
    protected function checkAuth()
    {

        if (!Session::has('admin_id')) {
            $this->redirect('admin/login/index');
        }else{
            $admin_id = Session::get('admin_id');
        }
        $request = request();
        $module     = $request->module();
        $controller = $request->controller();
        $action     = $request->action();

        // 排除权限
        $not_check = ['admin/Index/index', 'admin/AuthGroup/getjson', 'admin/System/clear'];

        if (!in_array($module . '/' . $controller . '/' . $action, $not_check)) {
            $sauth=new Sauth();
            $sauth->init(intval(session("role_id")));
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
        $sauth->init(intval(session("role_id")));

        if( $admin_id == 1 ){
            $menu = $sauth->get_all_menu();
        }else{
            $menu = $sauth->get_menu_by_auth();
        }

        $this->assign('menu', $menu);
    }
    // 网站配置
    protected function webconfig(){
        $webset = db("sys_config")->where("meta_id=1")->select();
        $admin_info = get_ainfo(Session::get('admin_id'));
        $navigate_admin = navigate_admin();

        $this->assign(['cdomain' => config('cdomain') , 'agroup' => config('agroup') , 'webset' => sort_info2($webset,'meta_key','meta_value') , 'navigate_admin' => $navigate_admin , 'admin_info' => $admin_info]);
    }
}