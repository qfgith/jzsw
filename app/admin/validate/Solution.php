<?php
namespace app\admin\validate;

use think\Validate;

class Solution extends Validate
{
    protected $rule = [
        'com_id'   => 'require',
        'car_id' => 'require',
    ];

    protected $message = [
        'com_id.require'   => '请选择所属公司',
        'car_id.require' => '请选择所属车辆',
    ];

   

}