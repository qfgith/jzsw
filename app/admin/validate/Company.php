<?php
namespace app\admin\validate;

use think\Validate;

class Company extends Validate
{
    protected $rule = [
        'title' => 'require',
        
    ];

    protected $message = [
        'title.require' => '请输入标题',
        
    ];

    protected $scene = [
        'edit'  =>  ['title'],
        
    ];

}