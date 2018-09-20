<?php
use think\Db;
use think\Config;
use org\Treeclass;

// 酒吧信息-相关选项
function get_bar_con($info1){
	$info1['utype'] = get_control(get_alist("sys_param","isdel=0 and type=3","sort asc") , "type" , $info1['type'] , "value" , "" , "radio");
    $info1['utarget'] = get_control(get_alist("sys_param","isdel=0 and type=1","sort asc") , "rule_target" , $info1['rule_target'] , "value" , "" , "radio");
    $info1['ueditor'] = getUeditor();
    $info1['uimgs'] = get_layui_imgs("imgs",$info1['imgs']);
    $rlist['province'] = get_alist("sys_region","pid=0 and level=1","id asc");
    $rlist['city'] = get_alist("sys_region","level=2 and pid=".$info1['province'],"id asc");
    $rlist['area'] = get_alist("sys_region","level=3 and pid=".$info1['city'],"id asc");

    $info1['rlist'] = $rlist;

    return $info1;
}
// 酒吧商品信息-相关选项
function get_bgoods_con($info1){
	$info1['ubar'] = get_control(get_alist("bar_bar","isdel=0 and status=1","sort asc") , "bar_id" , $info1['bar_id'] , "id" , "酒吧" , "select","w320 form-control","name","onchange='get_bprint(this)'");
	$info1['ucatid'] = get_control(get_alist("bar_category","isdel=0 and status=1","sort asc") , "cate_id" , $info1['cate_id'] , "id" , "商品分类" , "select","w320 form-control");
	$info1['ubrandid'] = get_control(get_alist("bar_brand","isdel=0 and status=1","sort asc") , "brand_id" , $info1['brand_id'] , "id" , "商品品牌" , "select","w320 form-control");
	$info1['gplist'] = get_alist("bar_brand","isdel=0 and status=1 and bar_id=".$info1['bar_id'],"sort asc");

    return $info1;
}
// 如果商品的图片地址和酒吧的身份编码不匹配则移动图片
function judge_imgpath_move($bar_id,$thumb){
    $thumb = "./".$thumb;
    $img = explode("/", $thumb);
    $savedir = "./public/uploads/".$img[3]."/";
    $bardir = "./public/uploads/".getFval("bar_bar","bar_no",$bar_id)."/";
    if($savedir==$bardir){
        return substr($thumb,2);
    }else{
        // 移动图片
        if(!file_exists($bardir)){
            mkdir ($bardir,0777,true);
        }
        $res = rename($thumb, $bardir.$img[4]);
        return substr($bardir.$img[4],2);
    }
}

  
