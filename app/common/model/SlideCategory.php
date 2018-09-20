<?php
namespace app\common\model;

use think\Db;
use think\Model;

class SlideCategory extends Model
{
    /**
     * 获取轮播图分类列表
     * @return false|static[]
     */
    public function getSlideCategoryList()
    {
        $slide_category_list = self::all();

        return $slide_category_list;
    }


    public function comments(){
		return $this->hasMany('Slide','cid','id');
	}
	public function getdat(){
		$r = SlideCategory::find('3');
		$res = $r->comments();
		return $res; 
	}

}