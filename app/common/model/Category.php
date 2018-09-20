<?php
namespace app\common\model;

use think\Db;
use think\Model;

class Category extends Model
{
    protected $insert = ['create_time'];


    protected static function init()
    {
        parent::init();
        
        self::event('after_insert', function ($category) {
            $pid = $category->pid;
            // dump($category->pid);
            if ($pid > 0) {
                $parent         = self::get($pid);
                $category->path = $parent->path . $pid . ',';
            } else {
                $category->path = 0 . ',';
            }

            $category->save();
        });

        self::event('after_update', function ($category) {
            $id   = $category->id;
            $pid  = $category->pid;
            $data = [];

            if ($pid == 0) {
                $data['path'] = 0 . ',';
            } else {
                $parent       = self::get($pid);
                $data['path'] = $parent->path . $pid . ',';
            }

            if ($category->where('id', $id)->update($data) !== false) {
                $children = self::all(['path' => ['like', "%{$id},%"]]);
                foreach ($children as $value) {
                    $value->path = $data['path'] . $id . ',';
                    $value->save();
                }
            }
        });
    }

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
        return date('Y-m-d H:i:s');
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