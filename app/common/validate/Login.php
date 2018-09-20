<?php
namespace app\common\validate;

use think\Validate;

/**
 * 后台登录验证
 * Class Login
 * @package app\admin\validate
 */
class Login extends Validate
{
    protected $rule = [
        'name' => 'require',
        'pwd' => 'require',
        // 'verify'   => 'require|captcha'
    ];

    protected $message = [
        'name.require' => '请输入用户名',
        'pwd.require' => '请输入密码',
        // 'verify.require'   => '请输入验证码',
        // 'verify.captcha'   => '验证码不正确'
    ];
}