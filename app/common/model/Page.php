<?php
namespace app\common\model;

use think\Db;
use think\Model;

class Page extends Model
{
    protected $insert = ['create_time'];


  

    /**
     * 反转义HTML实体标签
     * @param $value
     * @return string
     */
    protected function setContentAttr($value)
    {
        return htmlspecialchars_decode($value);
    }

    /**
     * 自动生成时间
     * @return bool|string
     */
    protected function setCreateTimeAttr()
    {
        return time();
    }

    /**
     * 获取特定层级缩进列表数据
     * $strSpai  栏目标识
     * @return array
     */
    public function getLevelList($strSpai="0")
    {

        $category_level = $this->where(['spai'=>$strSpai])->order(['sort' => 'asc'])->select();
        return array2level($category_level);
    }


    /**
     * 获取所有层级缩进列表数据
     * @return array
     */
    public function getLevelAllList($spai='0')
    {

        $category_level = $this->where('spai='.$spai)->order(['sort' => 'asc'])->select();

        return array2level($category_level);
    }
}