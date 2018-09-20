<?php
namespace app\admin\controller;

use app\common\model\SysAuthGroup as AuthGroupModel;
use app\common\model\SysAuthRule as AuthRuleModel;
use app\common\controller\AdminBase;

/**
 * 权限组
 * Class AuthGroup
 * @package app\admin\controller
 */
class AuthGroup extends AdminBase
{
    protected $auth_group_model;
    protected $auth_rule_model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->auth_group_model = new AuthGroupModel();
        $this->auth_rule_model  = new AuthRuleModel();
        $this->auth_group_m     = db("sys_auth_group");
    }

    /**
     * 权限组
     * @return mixed
     */
    public function index()
    {
        $auth_group_list = $this->auth_group_model->select();
        // dump($auth_group_list);
        return $this->fetch('index', ['auth_group_list' => $auth_group_list]);
    }

    /**
     * 添加权限组
     * @return mixed
     */
    public function add()
    {
        $right = db('sys_auth_rule')->order('pid asc,sort asc,id asc')->select();
        $right = array2level($right);

        foreach ($right as $val){
            $val['enable'] = 0;
            $modules[$val['group']][] = $val;
        }

        // dump($modules);
        return $this->fetch('add', ['modules' => $modules]);
    }

    /**
     * 保存权限组
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            $data['rules'] = implode(",", $data['right']);

            unset($data['right']);
            if ($this->auth_group_model->save($data) !== false) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
    }

    /**
     * 编辑权限组
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $rules = db("sys_auth_group")->where("id=".$id)->find();
        $rules_list = explode(",",$rules["rules"]);

        $right = db('sys_auth_rule')->order('pid asc,sort asc,id asc')->select();
        $right = array2level($right);
        foreach ($right as $val){
            if(!empty($rules)){
                $val['enable'] = in_array($val['id'],$rules_list );
            }
            $modules[$val['group']][] = $val;
        }
        // dump($modules);
        $auth_group = $this->auth_group_model->find($id);
// dump($auth_group);
        return $this->fetch('edit', ['info' => $auth_group , 'modules' => $modules ]);
    }

    /**
     * 更新权限组
     * @param $id
     */
    public function update()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $id   = request()->param("id",0);

            $data['rules'] = implode(",", $data['right']);

            unset($data['right']);

            if ($id == 1 && $data['status'] != 1) {
                $this->error('超级管理组不可禁用');
            }
            if ( $this->auth_group_m->where("id=".$id)->update($data) !== false) {
                $this->success('更新成功');
            } else {
                $this->error('更新失败');
            }
        }
    }

    /**
     * 删除权限组
     * @param $id
     */
    public function delete($id)
    {
        if ($id == 1) {
            $this->error('超级管理组不可删除');
        }
        if ($this->auth_group_model->destroy($id)) {
            add_admin_log('删除权限组');
            alertinfo('删除成功',url('admin/auth_group/index'));
        } else {
            alertinfo('删除失败');
        }
    }

    
}