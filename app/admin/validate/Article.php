<?php
namespace app\admin\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'cid'   => 'require',
        'title' => 'require',
    ];

    protected $message = [
        'cid.require'   => '请选择所属栏目',
        'title.require' => '请输入标题',
    ];

    protected $scene = [
        'edit'  =>  ['title'],
        // 'com_edit'=>['title']
        
    ];

}