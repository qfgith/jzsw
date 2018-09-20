<?php
namespace app\common\model;

use think\Model;

/**
 * 管理员模型
 * Class SysAdmin
 * @package app\common\model
 */
class SysAdmin extends Model
{
    protected $insert = ['addtime'];

    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreateTimeAttr()
    {
        return time();
    }
}