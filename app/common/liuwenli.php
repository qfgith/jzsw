<?php

use think\Db;
use think\Config;

/* 获取当前登录的商城管理员信息
 * $admin_id 为登录存的session_id
*/
function get_shop_ainfo($admin_id){
    $prefix = Config::get('database.prefix');
    
    $shop_admin_info = Db::table($prefix.'shop_admin')
                            ->where("id=".$admin_id)
                            ->find();
    return $shop_admin_info;
}


/*
 * 根据商城id 查询该商城下的分类栏目
 * $shop_id 商城id
 */
function getCategorysByShopid($shop_id){
    $res = db('shop_category')->field('id,name,pid')->where(['shop_id'=>$shop_id,'status'=>1,'isdel'=>0])->select();
    $res1 = array2level2($res);
    return json($res1,200);
}

/**
 * 数组层级缩进转换
 * @param array $array 源数组
 * @param int   $pid
 * @param int   $level
 * @return array
 */
function array2level2($array, $pid = 0, $level = 1)
{
    static $list = [];
    foreach ($array as $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = $level;
            $list[]     = $v;
            array2level2($array, $v['id'], $level + 1);
        }
    }

    return $list;
}
