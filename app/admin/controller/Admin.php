<?php
namespace app\admin\controller;

use app\common\model\SysAdmin as AdminUserModel;
use app\common\model\SysAuthGroup as AuthGroupModel;
use app\common\controller\AdminBase;
use think\Config;
use think\Db;

/**
 * 管理员管理
 * Class AdminUser
 * @package app\admin\controller
 */
class Admin extends AdminBase
{
    protected $admin_user_model;
    protected $auth_group_model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->admin_user_model        = new AdminUserModel();
        $this->auth_group_model        = new AuthGroupModel();

        $this->admin_m                 = db("sys_admin");
    }

    /**
     * 管理员管理
     * @return mixed
     */
    public function index($page=1)
    {
        $tname = "sys_admin";
        $wh = "isdel=0 and name != 'iswweb'";
        $search = [];
        $field = "id, name, realname, last_login, last_ip, status, addtime";
        $order = ['id' => 'ASC'];
        $pnum = 10;
        $keywords = request()->param("keywords","");
        if (!empty($keywords)) {
            $wh .= " and (name like '%{$keywords}%' or realname like '%{$keywords}%')";
            $search['keywords'] = $keywords;
        }

        $list  = get_page_list($tname , $wh, $page, $search, $field, $order, $pnum);
        // echo Db::name("sys_admin")->getLastSql();

        $pagenum = db($tname)->field($field)->where($wh)->count();
        // 获取分页显示
        $pages = $list->render();

        return $this->fetch('index', ['list' => $list,'pages'=>$pages,'pagenum'=>$pagenum, 'keywords' => $keywords]);
    

        // return $this->fetch('index', ['list' => $admin_user_list]);
    }

    /**
     * 添加管理员
     * @return mixed
     */
    public function add()
    {
        $auth_group_list = $this->auth_group_model->select();

        return $this->fetch('add', ['role' => $auth_group_list]);
    }

    /**
     * 保存管理员
     * @param $group_id
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'AdminUser');
            $group_id        = request()->param("group_id",0);

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $group_id = $data['group_id'];

                $data['pwd'] = md5($data['pwd'] . Config::get('salt'));
                $data['addtime'] = time();

                if ($this->admin_user_model->allowField(true)->save($data)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑管理员
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $admin_user             = $this->admin_user_model->find($id);
        $auth_group_list        = $this->auth_group_model->select();

        return $this->fetch('edit', ['admin_user' => $admin_user, 'role' => $auth_group_list]);
    }

    /**
     * 更新管理员
     * @param $id
     * @param $group_id
     */
    public function update()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'AdminUser');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {

                if (!empty($data['pwd']) && !empty($data['confirm_pwd'])) {
                    $data['pwd'] = md5($data['pwd'] . Config::get('salt'));
                    unset($data['confirm_pwd']);
                }else{
                    unset($data['pwd']);
                    unset($data['confirm_pwd']);
                }
                if ($this->admin_m->update($data) !== false) {
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除管理员
     * @param $id
     */
    public function delete($id)
    {
        if ($id == 1) {
            $this->error('默认管理员不可删除');
        }
        $save['isdel'] = 1;
        $save['modtime'] = time();
        $map['id'] = $id;
        if ( $this->admin_m->where($map)->update($save) ) {
            add_admin_log('删除管理员');
            alertinfo('删除成功',url('admin/admin/index'));
        } else {
            alertinfo('删除失败');
        }
    }

    /**
     * 更新密码
     */
    public function updatePassword()
    {
        if ($this->request->isPost()) {
            $admin_id    = Session::get('admin_id');
            $data   = $this->request->param();
            $result = Db::name('admin_user')->find($admin_id);

            if ($result['password'] == md5($data['old_password'] . Config::get('salt'))) {
                if ($data['password'] == $data['confirm_password']) {
                    $new_password = md5($data['password'] . Config::get('salt'));
                    $res          = Db::name('admin_user')->where(['id' => $admin_id])->setField('password', $new_password);

                    if ($res !== false) {
                        $this->success('修改成功');
                    } else {
                        $this->error('修改失败');
                    }
                } else {
                    $this->error('两次密码输入不一致');
                }
            } else {
                $this->error('原密码不正确');
            }
        }
    }
}