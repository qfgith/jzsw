<?php
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'user_name'         => 'require',
        'nick_name'         => 'require',
        'phone'             => 'require|unique:im_user',
    ];

    protected $message = [
        'user_name.require'     => '请输入用户名',
        'nick_name.require'     => '请输入昵称',
        'phone.require'         => '请输入手机号码',
        'phone.unique'          => '此手机号码已存在',
    ];
}