<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 管理员验证器
 * Class AdminUser
 * @package app\admin\validate
 */
class AdminUser extends Validate
{
    protected $rule = [
        'name'              => 'require|unique:sys_admin',
        'pwd'               => 'confirm:confirm_pwd',
        'confirm_pwd'  => 'confirm:pwd',
        'group_id'          => 'require'
    ];

    protected $message = [
        'name.require'              => '请输入用户名',
        'name.unique'               => '用户名已存在',
        'pwd.confirm'               => '两次输入密码不一致',
        'confirm_pwd.confirm'  => '两次输入密码不一致',
        'group_id'                  => '请选择所属权限组'
    ];
}