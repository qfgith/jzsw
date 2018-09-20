<?php
namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Session;

/**
 * 后台登录
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
    /**
     * 后台登录
     * @return mixed
     */
    public function index()
    {
        $webset = db("sys_config")->where("meta_id=1")->select();
        //cdomain->http://www.juzhang.com/   webset->一维数组
        $this->assign(['cdomain' => config('cdomain'),'webset' => sort_info2($webset,'meta_key','meta_value')]);
        // echo md5('admin' . Config::get('salt'));
        return $this->fetch('index');
    }

    /**
     * 登录验证
     * @return string
     */
    public function login()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->only(['name', 'pwd', 'verify']);
            $validate_result = $this->validate($data, 'Login');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $where['name'] = $data['name'];
                $where['pwd'] = md5($data['pwd'] . Config::get('salt'));

                $admin_user = Db::name('sys_admin')->field('id,name,group_id,status')->where($where)->find();

                if (!empty($admin_user)) {
                    if ($admin_user['status'] != 1) {
                        $this->error('当前用户已禁用');
                    } else {
                        Session::set('admin_id', $admin_user['id']);
                        Session::set('admin_name', $admin_user['name']);
                        Session::set('role_id', $admin_user['group_id']);
                        Db::name('sys_admin')->update(
                            [
                                'last_login'    => time(),
                                'last_ip'       => $this->request->ip(),
                                'id'            => $admin_user['id']
                            ]
                        );
                        add_admin_log('登录平台管理后台');
                        $this->success('登录成功', 'admin/index/index');
                    }
                } else {
                    $this->error('用户名或密码错误');
                }
            }
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::delete('admin_id');
        Session::delete('admin_name');
        
        alertinfo('退出成功',url('admin/login/index'));
    }
}
