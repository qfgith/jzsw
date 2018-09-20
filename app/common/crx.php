<?php

use think\Db;
use org\Treeclass;

// 树形结构测试
function get_auth_menu(){
    $tree=new Treeclass();
    $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
    $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
    $result=Db::name('sys_auth_rule')->where('status', 1)->order(['pid' => 'ASC','sort' => 'ASC','id'=>'ASC'])->select();
    $array = [];
    foreach($result as $r) {
        $r['parent_id']=$r['pid'];
        $array[] = $r;
    }
    $str = "#*start*#\$id###*###\$spacer\$name#*end*#";
    $tree->init($array);
    $menustr = $tree->get_tree(0, $str);
    $menustr = substr($menustr, 9);
    $menustr = substr($menustr, 0 , -7);
    $menu = explode("#*end*##*start*#",$menustr); 
    return $menu;
}
// 获得radio,checkbox,select,
function get_control($arr , $field , $value , $keys="value" , $desc="" , $type="select",$class="form-control",$fname="name",$style=""){
    $str = '';
    switch ($type) {
        case 'select':
            $str = '<select name="'.$field.'" id="'.$field.'" class="'.$class.'" '.$style.' >';
            if($desc != '') $str .= '<option value="0" >---'.$desc.'---</option>';
            foreach($arr as $k => $v){
                $select = ($v[$keys] == $value) ? " selected " : "";
                $str .= '<option value="'.$v[$keys].'"'.$select.'>'.$v[$fname].'</option>';
            }
            $str .= '</select>';
            break;
        case 'radio':
            $i=0;
            foreach($arr as $k => $v){
                $i++;
                $select = ($v[$keys] == $value) ? " checked " : "";
                $str .= '<input type="radio" class="iccontrol radio_'.$field.' '.$class.'" '.$style.' name="'.$field.'" value="'.$v[$keys].'"'.$select.' /><span class="ml10 mr30">'.$v['name'].'</span>';
                if( $i==5 ) $str.="<br>";
            }
            break; 
        case 'checkbox':
            $i=0;
            foreach($arr as $k => $v){
                $i++;
                $select = ( in_array($v[$keys],explode(",",$value)) ) ? " checked " : "";
                $str .= '<input type="checkbox" class="iccontrol '.$class.'" '.$style.' name="'.$field.'[]" value="'.$v[$keys].'"'.$select.' /><span class="ml10 mr30">'.$v[$fname].'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
                if(( ($i==5)&&($arr[$k][$fname]!='其他') )||($arr[$k+1][$fname]=='其他')) $str.="<br>";
            }
            break; 
        
    }
    
    return $str;
}
// ueditor编辑器css和js
function getUeditor($type=0){
    $root = config('cdomain')."static/pingtai/plugins";
    $s = "";
    
    $s .= '<script type="text/javascript" src="'.$root.'/ueditor/ueditor.config.js"></script>';
    if($type==0){
        $s .= '<script type="text/javascript" src="'.$root.'/ueditor/ueditor.all.js"></script>';
    }else{
        $s .= '<script type="text/javascript" src="'.$root.'/ueditor/ueditor.all_pic'.$type.'.js"></script>';
    }
    
    $s .= '<link rel="stylesheet" href="'.$root.'/ueditor/themes/default/css/ueditor.css"/>';
    $s .= '<script type="text/javascript" src="'.$root.'/style/js/remove.js"></script>';
    
    return $s;
}
// ueditor编辑器
function getHtmlEditor($field,$value,$simple=0){
    $str  = '<textarea name="'.$field.'" class="content_w" id="'.$field.'">'.$value.'</textarea>';
    $str .= '<script type="text/javascript" >';
    $str .= 'var editor = new baidu.editor.ui.Editor({';
    $str .= "initialContent: '<span></span>',";
    $str .= "initialFrameWidth:'100%',initialFrameHeight:300,minFrameHeight:300,autoFloatEnabled: false,textarea:'".$field."'";
    if($simple){
        $str .= "toolbars: [['fullscreen', 'source', '|', 'undo', 'redo', '|','bold', 'italic', 'underline', 'strikethrough', 'removeformat', 'blockquote', 'pasteplain', '|','forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','indent', '|','insertimage', 'insertvideo', 'attachment','|', 'link','horizontal', 'spechars', '|','paragraph', 'fontfamily', 'fontsize']],";
    }
    $str .= '});editor.render("'.$field.'");</script>';

    return $str;
}
// 上传多图
function getUeditorImages($field , $value="" , $max = 10){
    $btnval = "选择图片";
    $btnremove = "移除";
    $btnview = "查看";
    $msg = "最多只能上传".$max."张";
    $root = config('cdomain')."public/static/pingtai/plugins";
    $data = "";
    if($value){
        $options = explode(":::",$value);
        if(is_array($options)){
            foreach($options as  $i => $r) {
                $v = explode("|",$r);
                $k = trim($v[1]);
                $optionsarr[$k] = $v[0];
                $data .='<div id="uplistd_'.$field.'_'.$i.'"><input type="text" size="40" class="input-text" name="'.$field.'[]" value="'.$v[0].'"  /> &nbsp;<input type="text" class="input-text" name="'.$field.'_name[]" value="'.$v[1].'" size="20" /> 
                    &nbsp;<a class="btn btn-sm btn-info imghref1" target="_blank" href="'.$v[0].'">'.$btnview.'</a>
                    &nbsp;<a class="btn btn-sm btn-warning" href="javascript:remove_this(\'uplistd_'.$field.'_'.$i.'\');">'.$btnremove.'</a> ';
                $class = $v[0] ? "th1_img imgb" : "th1_img imgh";
                $data .= '&nbsp;<img src="'.config('cdomain').$v[0].'" class="'.$class.'" >';
                $data .= '</div>';
                $i++;
            }
        }
    }

    $str   = '
    <fieldset class="images_box"><div id="upload_imgs_'.$field.'" name="upload_imgs_'.$field.'" type="text/plain" style="display: none;"></div>'.
        '<div id="'.$field.'_images" class="imagesList">'.$data.
        '</div>
    </fieldset>
    <div class="c"></div>
    <input type="button" class="btn btn-primary" value="'.$btnval.'" onclick="upImage_imgs_'.$field.'()">  ';
    $str .= '<script>';
    $str .= 'var img_div = "'.$field.'";';
    $str .= 'var ll = 0;';
    $str .= 'var _editor_imgs_'.$field.' = UE.getEditor("upload_imgs_'.$field.'");';
    $str .= 'var oImg_'.$field.' = "#"+img_div+"_images";';
    $str .= 'var oDiv_'.$field.' = "#"+img_div+"_images div";';
    $str .= 'var oImg1_'.$field.' = img_div+"_images";';
    $str .= '$list_'.$field.' = $(oImg_'.$field.');';
    $str .= '_editor_imgs_'.$field.'.ready(function () {';
    $str .= '_editor_imgs_'.$field.'.hide();';
    $str .= '_editor_imgs_'.$field.'.addListener("beforeInsertImage", function (t, arg) {';
    $str .= 'var len = arg.length;';
    $str .= 'if(len>'.$max.'){';
    $str .= 'alert("'.$msg.'");';
    $str .= 'return false;';
    $str .= '}';
    $str .= 'var imgList = document.getElementById(oImg1_'.$field.');';
    $str .= 'var divNode = imgList.getElementsByTagName("div");';
    $str .= 'll = divNode.length;';
    /**/
    /*$str .= 'alert("已有"+ll+"张图片");';*/
    /**/
    $str .= 'var l2 = ll-1;';
    $str .= 'if(ll > 0){';
    $str .= 'var sname = $(oDiv_'.$field.').eq(l2).attr("id");';
    $str .= 'var upname= new Array(); ';
    $str .= 'upname=sname.split("_"); ';
    $str .= 'll = parseInt(upname[2])+1;';
    $str .= '}';
    $str .= 'var div_len = $(oDiv_'.$field.').length;';
    $str .= 'if(div_len>='.$max.'){';
    $str .= 'alert("'.$msg.'");';
    $str .= 'return false;';
    $str .= '}';
    $str .= 'var html1 = imgList.innerHTML;';
    $str .= 'for(var i=0;i<len;i++){';
    $str .= 'var jj = ll +i;';
    /**/
    /*$str .= 'alert("共"+ll);';
    $str .= 'alert("第"+jj+"张");';*/
    /**/
    $str .= 'var aaa = "uplistd_'.$field.'_"+jj;';
    $str .= 'var aaa3 = "\'uplistd_'.$field.'_"+jj+"\'";';
    $str .= 'var $li = \'<div id="\' + aaa + \'" >\' +';
    $str .= '\'<input type="text" size="40" class="input-text img1" name="'.$field.'[]" value=""> &nbsp;\' +';
    $str .= '\'<input type="text" class="input-text imgname1" name="'.$field.'_name[]" value="" size="20"> &nbsp;\'+';
    $str .= '\'<a class="btn btn-sm btn-info imghref1" target="_blank" href="">'.$btnview.'</a> &nbsp;\'+';
    $str .= '\'<a class="btn btn-sm btn-warning" href="javascript:remove_this(\'+aaa3+\');">'.$btnremove.'</a> &nbsp;\'+';
    $str .= '\'<img class="th1_img imgb" src=""> &nbsp;\' +';

    $str .= '\'</div>\';';
    $str .= 'str = $list_'.$field.'.html();';
    $str .= 'str = str + $li;';
    $str .= '$list_'.$field.'.html(str);';
    $str .= '}';
    $str .= '$.each(arg,function(n,value) {';
    $str .= 'var abc = arg[n].src;';
    $str .= 'var jj = ll +n;';
    $str .= 'var str1 = "#uplistd_'.$field.'_"+jj+" .img1--------"+n+"-----"+ll;';
    $str .= 'var abc1 = abc.split("/");';
    $str .= 'var aaa = "#uplistd_'.$field.'_"+jj+" .img1";';
    /**/
    // $str .= 'alert("图片div："+aaa+"----存储地址："+abc+"----图片名称："+abc1[5]);';
    /**/
    $str .= 'var href2 = "#uplistd_'.$field.'_"+jj+" .imghref1";';
    $str .= 'var aaa1 = "#uplistd_'.$field.'_"+jj+" .imgname1";';
    $str .= 'var thimg = "#uplistd_'.$field.'_"+jj+" .th1_img";';
    $str .= 'var abc6 = abc.substring(1);';

    $str .= '$(aaa).val(abc6);';
    $str .= '$(href2).attr("href",abc6);';
    $str .= '$(aaa1).val(abc1[5]);';
    $str .= '$(aaa).attr("aaa",abc6);';
    $str .= '$(aaa1).attr("aaa",abc1[5]);';
    $str .= '$(thimg).attr("src",abc);';
    /**/
    $str .= 'for(var jj=0;jj<ll;jj++){';
    $str .= '    var img1 = "#uplistd_'.$field.'_"+jj+" .img1";';
    $str .= '    var imgname1 = "#uplistd_'.$field.'_"+jj+" .imgname1";';
    $str .= '    if($(img1).val()==""){';
    $str .= '        var a1 = $(img1).attr("aaa");';
    $str .= '        $(img1).attr("value",a1);';
    $str .= '        $(img1).val(a1);';
    $str .= '    }';
    $str .= '    if($(imgname1).val()==""){';
    $str .= '        var a1 = $(imgname1).attr("aaa");';
    $str .= '        $(imgname1).attr("value",a1);';
    $str .= '        $(imgname1).val(a1);';
    $str .= '    }';
    $str .= '}';
    /**/
    $str .= '});';
    $str .= '});';
    $str .= '});';
    $str .= 'function upImage_imgs_'.$field.'() {';
    $str .= 'var myImage_s_img_'.$field.' = _editor_imgs_'.$field.'.getDialog("insertimage");';
    $str .= 'myImage_s_img_'.$field.'.open();';
    $str .= '}';
    $str .= '</script>';
    return $str;
}
function getUeditorFiles($field , $value="",$max=10){
    $btnval = "选择文件";
    $btnremove = "移除";
    $btndown = "下载";
    $msg = "最多只能上传".$max."个";
    $root = config('cdomain')."public/static/pingtai/plugins";
    $data = "";
    if($value){
        $options = explode(":::",$value);
        if(is_array($options)){
            foreach($options as  $i => $r) {
                $v = explode("|",$r);
                $k = trim($v[1]);
                $optionsarr[$k] = $v[0];
                $data .='<div id="uplistd_'.$field.'_'.$i.'"><input type="text" size="40" class="input-text img1" name="'.$field.'[]" value="'.$v[0].'"  /> &nbsp;<input type="text" class="input-text imgname1" name="'.$field.'_name[]" value="'.$v[1].'" size="10" /> &nbsp;<a class="btn btn-sm btn-info imghref1" target="_blank" href="'.$v[0].'">'.$btndown.'</a> &nbsp;<a class="btn btn-sm btn-warning" href="javascript:remove_this(\'uplistd_'.$field.'_'.$i.'\');">'.$btnremove.'</a> </div>';

                $i++;
            }
        }
    }

    $str   = '
    <fieldset class="files_box"><div id="upload_'.$field.'" name="upload_'.$field.'" type="text/plain" style="display: none;"></div>'.
        '<div id="'.$field.'_files" class="imagesList">'.$data.
        '</div>
    </fieldset>
    <div class="c"></div>
    <input type="button" class="btn btn-primary" value="上传文件" onclick="up_files_'.$field.'()">  ';
    $str .= '<script>';
    $str .= 'var ll_'.$field.' = 0;';

    $str .= 'var _editor_files_'.$field.' = UE.getEditor("upload_'.$field.'");';
    $str .= 'var oImg_'.$field.' = "#'.$field.'_files";';
    $str .= 'var oDiv_'.$field.' = "#'.$field.'_files div";';
    $str .= 'var oImg1_'.$field.' = "'.$field.'_files";';
    $str .= '$list_'.$field.' = $(oImg_'.$field.');';
    $str .= '_editor_files_'.$field.'.ready(function () {';
    $str .= '_editor_files_'.$field.'.hide();';
    $str .= '_editor_files_'.$field.'.addListener("afterUpfile", function (t, arg) {';
    $str .= 'var len = arg.length;';
    $str .= 'if(len>'.$max.'){';
    $str .= 'alert("'.$msg.'");';
    $str .= 'return false;';
    $str .= '}';
    $str .= 'var imgList = document.getElementById(oImg1_'.$field.');';
    $str .= 'var divNode = imgList.getElementsByTagName("div");';
    $str .= 'll_'.$field.' = divNode.length;';
    $str .= 'var l2 = ll_'.$field.'-1;';
    $str .= 'if(ll_'.$field.' > 0){';
    $str .= 'var sname = $(oDiv_'.$field.').eq(l2).attr("id");';
    $str .= 'var upname= new Array();';
    $str .= 'upname=sname.split("_");';
    $str .= 'll_'.$field.' = parseInt(upname[2])+1;';
    $str .= '}';

    $str .= 'var div_len = $(oDiv_'.$field.').length;';
    $str .= 'if(div_len>='.$max.'){';
    $str .= 'alert("'.$msg.'");return false;';
    $str .= '}';

    $str .= 'var html1 = imgList.innerHTML;';
    $str .= 'for(var i=0;i<len;i++){';
    $str .= 'var jj = ll_'.$field.' +i;';
    $str .= 'var aaa = "uplistd_'.$field.'_"+jj;';
    $str .= 'var aaa3 = "\'uplistd_'.$field.'_"+jj+"\'";';
    $str .= 'var $li = \'<div id="\' + aaa + \'" >\' +';
    $str .= '\'<input type="text" size="40" class="input-text img1" name="'.$field.'[]" value=""> &nbsp;\' +';
    $str .= '\'<input type="text" class="input-text imgname1" name="'.$field.'_name[]" value="" size="10"> &nbsp;\'+';
    $str .= '\'<a class="btn btn-sm btn-info imghref1" target="_blank" href="">'.$btndown.'</a> &nbsp;\'+';
    $str .= '\'<a class="btn btn-sm btn-warning" href="javascript:remove_this(\'+aaa3+\');">'.$btnremove.'</a></div>\';';
    $str .= 'str = $list_'.$field.'.html();str = str + $li;$list_'.$field.'.html(str);}';
    $str .= '$.each(arg,function(n,value) {';
    $str .= 'var abc = arg[n].url;var jj = ll_'.$field.' +n;';
    $str .= 'var str1 = "#uplistd_'.$field.'_"+jj+" .img1--------"+n+"-----"+ll_'.$field.';';
    $str .= 'var abc1 = abc.split("/");';
    $str .= 'var aaa = "#uplistd_'.$field.'_"+jj+" .img1";';
    $str .= 'var href2 = "#uplistd_'.$field.'_"+jj+" .imghref1";';
    $str .= 'var aaa1 = "#uplistd_'.$field.'_"+jj+" .imgname1";';
    $str .= 'var abc6 = abc.substring(1);';

    $str .= '$(aaa).val(abc6);';
    $str .= '$(href2).attr("href",abc6);';
    $str .= '$(aaa1).val(abc1[5]);';
    $str .= '$(aaa).attr("aaa",abc6);';
    $str .= '$(aaa1).attr("aaa",abc1[5]);';
    
    $str .= 'for(var jj=0;jj<ll_'.$field.';jj++){';
    $str .= 'var img1 = "#uplistd_'.$field.'_"+jj+" .img1";';
    $str .= 'var imgname1 = "#uplistd_'.$field.'_"+jj+" .imgname1";';
    $str .= 'var href1 = "#uplistd_'.$field.'"+jj+" .imghref1";';
    $str .= 'if($(img1).val()==""){';
    $str .= 'var a1 = $(img1).attr("aaa");';
    $str .= '$(img1).attr("value",a1);';
    $str .= '$(href1).attr("href",a1);';
    $str .= '$(img1).val(a1);';
    $str .= '}';
    $str .= 'if($(imgname1).val()==""){';
    $str .= 'var a1 = $(imgname1).attr("aaa");';
    $str .= '$(imgname1).attr("value",a1);';
    $str .= '$(imgname1).val(a1);';
    $str .= '}';
    $str .= '}});});';
    $str .= '});';
    $str .= 'function up_files_'.$field.'() {';
    $str .= 'var myImage_s_files_'.$field.' = _editor_files_'.$field.'.getDialog("attachment");';
    $str .= 'myImage_s_files_'.$field.'.open();';
    $str .= '}';
    $str .= '</script>';

    return $str;
}
// layui2.3.0上传多图
function get_layui_imgs($field, $value){
    $str = '<div class="layui-upload">';
    $str .= '<button type="button" class="btn btn-primary layui_upimages">多图片上传</button>';
    $str .= '<div class="layui-upload-list">';
    $data = "";
    if($value){
        $options = explode(":::",$value);
        if(is_array($options)){
            foreach($options as  $i => $r) {
                $v = explode("|",$r);
                $k = trim($v[1]);
                $optionsarr[$k] = $v[0];
                $data .='<li class="item_img"><input type="text" size="40" class="input-text img1" name="'.$field.'[]" value="'.$v[0].'"  /> &nbsp;<input type="text" size="20" class="input-text imgname1" name="'.$field.'_name[]" value="'.$v[1].'" /> 
                    &nbsp;<a class="btn btn-sm btn-info imghref1" target="_blank" href="'.$v[0].'">查看</a>
                    &nbsp;<a class="btn btn-sm btn-warning upclose1">移除</a> ';
                $class = $v[0] ? "th1_img imgb" : "th1_img imgh";
                $data .= '&nbsp;<img src="'.config('cdomain').$v[0].'" class="'.$class.'" >';
                $data .= '</li>';
                $i++;
            }
        }
    }

    $str .= $data;
    $str .= '</div>';
    return $str;
}
            
// 将图册数组装换为字符串存储
function picarr2str($pic,$name){
    $str = "";
    $arr = array();
    foreach($pic as $k => $v){
        $arr[$k] = $pic[$k]."|".$name[$k];
    }
    $str = implode(":::",$arr);
    return $str;
}
// 图册string转array
function picstr2arr($value){
    $arr = array();
    if($value){
        if(strstr($value,":::")){
            $options = explode(":::",$value);
            if(is_array($options)){
                foreach($options as  $s => $r) {
                    $v = explode("|",$r);
                    $k = trim($v[1]);
                    $arr[$s]['k'] = $s;
                    $arr[$s]['name'] = $v[0];
                    $arr[$s]['val'] = $v[1];
                }
            }
        }else{
            if(strstr($value,"|")){
                $v = explode("|",$value);
                $arr[0]['name'] = $v[0];
                $arr[0]['val'] = $v[1];
            }else{
                $options = explode("/", $value);
                $count = count($options) - 1;
                $arr[0]['name'] = $value;
                $arr[0]['val'] = $options[$count];
            }
            
        }
    }
    return $arr;
}
// 导入excel文件
function import_excel($file_name){
    // 引入PHPExcel
    import('phpexcel.PHPExcel', EXTEND_PATH);
    // 实例化PHPExcel对象
    $objPHPExcel = new \PHPExcel();
    // 读取格式
    $objReader =\PHPExcel_IOFactory::createReader('Excel5');
    //加载文件内容,编码utf-8  
    $obj_PHPExcel =$objReader->load($file_name, $encode = 'utf-8');
    // 读取工作表0
    $sheet = $obj_PHPExcel->getSheet(0); 
    // 取得总行数 
    $highestRow = $sheet->getHighestRow();     
    // 取得总列数      
    $highestColumn = $sheet->getHighestColumn(); 
    //总列数转换成数字
    $numHighestColum = PHPExcel_Cell::columnIndexFromString("$highestColumn");
    //循环读取excel文件,读取一条,插入一条
    $data=array();
    //从第一行开始读取数据
    for($j=1;$j<=$highestRow;$j++){
        //从A列读取数据
        for($k=0;$k<=$numHighestColum;$k++){
            //数字列转换成字母
            $columnIndex = PHPExcel_Cell::stringFromColumnIndex($k);
            // 读取单元格
            $cellValue = $obj_PHPExcel->getActiveSheet()->getCell("$columnIndex$j")->getValue();

            if($cellValue instanceof PHPExcel_RichText){   //富文本转换字符串
                $cellValue = $cellValue->__toString();
            }
            $data[$j][] = $cellValue;
        } 
    }  

    //删除第一个数组(标题);  
    array_shift($data);
    $excel_array = [];  
    $i=0;  
    $flst = get_alist("sys_param","isdel=0 and type=4","sort asc");
    foreach($data as $k=>$v) {
        foreach($flst as $sk => $sv){
            $excel_array[$k][$sv['val2']] = strval($v[$sv['value']]);
        }
        $i++;
    }

    return ['num' => $i , 'data' => $excel_array];
}
