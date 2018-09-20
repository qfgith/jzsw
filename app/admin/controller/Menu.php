<?php
namespace app\admin\controller;

use app\common\model\SysAuthRule as AuthRuleModel;
use app\common\controller\AdminBase;
use think\Db;

/**
 * 后台菜单
 * Class Menu
 * @package app\admin\controller
 */
class Menu extends AdminBase
{

    protected $auth_rule_model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->auth_rule_model = new AuthRuleModel();
        $this->auth_rule_m     = db("sys_auth_rule");
        $admin_menu_list       = $this->auth_rule_model->where("type=1")->order(['sort' => 'ASC', 'id' => 'ASC'])->select();
        $admin_menu_level_list = array2level($admin_menu_list);

        $this->assign('admin_menu_level_list', $admin_menu_level_list);
    }

    /**
     * 后台菜单
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 添加菜单
     * @param string $pid
     * @return mixed
     */
    public function add($pid = '')
    {
        return $this->fetch('add', ['pid' => $pid]);
    }

    /**
     * 保存菜单
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Menu');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->auth_rule_model->save($data)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑菜单
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $admin_menu = $this->auth_rule_model->find($id);

        return $this->fetch('edit', ['admin_menu' => $admin_menu]);
    }

    /**
     * 更新菜单
     * @param $id
     */
    public function update()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $id              = request()->param("id",0);
            $validate_result = $this->validate($data, 'Menu');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->auth_rule_m->where("id=".$id)->update($data) !== false) {
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除菜单
     * @param $id
     */
    public function delete($id)
    {
        $sub_menu = $this->auth_rule_model->where(['pid' => $id])->find();
        if (!empty($sub_menu)) {
            $this->error('此菜单下存在子菜单，不可删除');
        }
        if ($this->auth_rule_model->destroy($id)) {
            alertinfo('删除成功',url('admin/menu/index'));
        } else {
            alertinfo('删除失败');
        }
    }

    public function listorder(){
        $ids = request()->post();
        $ids = $ids['sort'];
        foreach($ids as $key=>$r) {
            $data['sort']=$r;
            $r = Db::name("sys_auth_rule")->where("id=".$key)->update($data);
            // echo Db::name("sys_auth_rule")->getLastSql();
        }
        $this->success ("操作成功");
    }
}