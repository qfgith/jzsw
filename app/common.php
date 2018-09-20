<?php

use think\Db;
use think\Config;
use org\Treeclass;

/**
 * 获取分类所有子分类
 * @param int $cid 分类ID
 * @return array|bool
 */
function get_category_children($cid)
{
    if (empty($cid)) {
        return false;
    }

    $children = Db::name('category')->where('FIND_IN_SET('.$cid.',path)')->select();

    return array2tree($children);
}


/**
 * 构建层级（树状）数组
 * @param array  $array          要进行处理的一维数组，经过该函数处理后，该数组自动转为树状数组
 * @param string $pid_name       父级ID的字段名
 * @param string $child_key_name 子元素键名
 * @return array|bool
 */
function array2tree(&$array, $pid_name = 'pid', $child_key_name = 'children')
{
    $counter = array_children_count($array, $pid_name);
    if (!isset($counter[0]) || $counter[0] == 0) {
        return $array;
    }
    $tree = [];
    while (isset($counter[0]) && $counter[0] > 0) {
        $temp = array_shift($array);
        if (isset($counter[$temp['id']]) && $counter[$temp['id']] > 0) {
            array_push($array, $temp);
        } else {
            if ($temp[$pid_name] == 0) {
                $tree[] = $temp;
            } else {
                $array = array_child_append($array, $temp[$pid_name], $temp, $child_key_name);
            }
        }
        $counter = array_children_count($array, $pid_name);
    }

    return $tree;
}
/**
 * 子元素计数器
 * @param array $array
 * @param int   $pid
 * @return array
 */
function array_children_count($array, $pid)
{
    $counter = [];
    foreach ($array as $item) {
        $count = isset($counter[$item[$pid]]) ? $counter[$item[$pid]] : 0;
        $count++;
        $counter[$item[$pid]] = $count;
    }

    return $counter;
}


/**
 * 数组层级缩进转换
 * @param array $array 源数组
 * @param int   $pid
 * @param int   $level
 * @return array
 */
function array2level($array, $pid = 0, $level = 1)
{
    static $list = [];
    foreach ($array as $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = $level;
            $list[]     = $v;
            array2level($array, $v['id'], $level + 1);
        }
    }

    return $list;
}

/**
 * 循环删除目录和文件
 * @param string $dir_name
 * @return bool
 */
function delete_dir_file($dir_name)
{
    $result = false;
    if (is_dir($dir_name)) {
        if ($handle = opendir($dir_name)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir_name . DS . $item)) {
                        delete_dir_file($dir_name . DS . $item);
                    } else {
                        unlink($dir_name . DS . $item);
                    }
                }
            }
            closedir($handle);
            if (rmdir($dir_name)) {
                $result = true;
            }
        }
    }

    return $result;
}
// 清楚缓存
function clear_cache()
{
    if (delete_dir_file(CACHE_PATH) || delete_dir_file(TEMP_PATH)) {
        return 1;
    } else {
        return 0;
    }
}

/**
 * 手机号格式检查
 * @param string $mobile
 * @return bool
 */
function check_mobile_number($mobile)
{
    if (!is_numeric($mobile)) {
        return false;
    }
    $reg = '#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#';

    return preg_match($reg, $mobile) ? true : false;
}

//字符串截取
function str_cut($sourcestr,$cutlength,$suffix='...')
{
    $str_length = strlen($sourcestr);
    if($str_length <= $cutlength) {
        return $sourcestr;
    }
    $returnstr='';
    $n = $i = $noc = 0;
    while($n < $str_length) {
        $t = ord($sourcestr[$n]);
        if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $i = 1; $n++; $noc++;
        } elseif(194 <= $t && $t <= 223) {
            $i = 2; $n += 2; $noc += 2;
        } elseif(224 <= $t && $t <= 239) {
            $i = 3; $n += 3; $noc += 2;
        } elseif(240 <= $t && $t <= 247) {
            $i = 4; $n += 4; $noc += 2;
        } elseif(248 <= $t && $t <= 251) {
            $i = 5; $n += 5; $noc += 2;
        } elseif($t == 252 || $t == 253) {
            $i = 6; $n += 6; $noc += 2;
        } else {
            $n++;
        }
        if($noc >= $cutlength) {
            break;
        }
    }
    if($noc > $cutlength) {
        $n -= $i;
    }
    $returnstr = substr($sourcestr, 0, $n);


    if ( substr($sourcestr, $n, 6)){
        $returnstr = $returnstr . $suffix;//超过长度时在尾处加上省略号
    }
    return $returnstr;
}

//字符串截取2(城市)
function str_cut_2($sourcestr,$cutlength,$suffix='...')
{
    $str_length = strlen($sourcestr);
    if($str_length <= $cutlength) {
        return $sourcestr;
    }
    $returnstr='';
    $n = $i = $noc = 0;
    while($n < $str_length) {
        $t = ord($sourcestr[$n]);
        if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $i = 1; $n++; $noc++;
        } elseif(194 <= $t && $t <= 223) {
            $i = 2; $n += 2; $noc += 2;
        } elseif(224 <= $t && $t <= 239) {
            $i = 3; $n += 3; $noc += 2;
        } elseif(240 <= $t && $t <= 247) {
            $i = 4; $n += 4; $noc += 2;
        } elseif(248 <= $t && $t <= 251) {
            $i = 5; $n += 5; $noc += 2;
        } elseif($t == 252 || $t == 253) {
            $i = 6; $n += 6; $noc += 2;
        } else {
            $n++;
        }
        if($noc >= $cutlength) {
            break;
        }
    }
    if($noc > $cutlength) {
        $n -= $i;
    }
    $returnstr = substr($sourcestr, 0, $n);


    if ( substr($sourcestr, $n, 6)){
        $returnstr = $returnstr;//超过长度时在尾处加上省略号
    }
    return $returnstr;
}


/*cathy 2018-07-19*/
/**
 * 面包屑导航  用于后台管理
 * 根据当前的控制器名称 和 action 方法
 */
function navigate_admin()
{
    $group = config('agroup');
    $control = request()->controller();
    $act = request()->action();
    $arr = [];
    if((strtolower($control)=='index')&&($act=='index')){
        $arr1 = array("后台首页" => url('admin/index/index'));
        $arr['active'] = 'index';
    }else{
        $where = "lower(name) = 'admin/".strtolower($control)."/".strtolower($act)."'";

        $info = Db::name("sys_auth_rule")->where($where)->find();
        $arr1 = [
            "后台首页" => url('admin/index/index'),
            "sql" => Db::name("sys_auth_rule")->getLastSql(),
        ];
        if(!empty($info)){
            $arr['active'] = $info['group'];
            $arr1 = [
                "后台首页" => url('admin/index/index'),
                $group[$info['group']] => 'javascript:void();',
                $info['title'] => url($info['name']),
            ];
        }else{
            $arr['active'] = strtolower($control);
        }
    }
    $arr['list'] = $arr1;
    return $arr;
}
// 添加后台操作日志
function add_admin_log($log_info,$type=1){
    $control = request()->controller();
    $act = request()->action();
    $lurl = "admin/".$control."".$act;

    $add['log_time'] = time();
    $add['type'] = $type;
    $add['admin_id'] = session('admin_id');
    $add['log_info'] = $log_info;
    $add['log_url'] = url($lurl);
    $add['log_ip'] = request()->ip();
    db('sys_actionlog')->insert($add);
}
// 获取某个表的某个字段值
function getFval($tname,$fname,$id){
    $info = db($tname)->field($fname)->where("id=".$id)->find();
    return $info[$fname];
}
function getFval2($tname,$fname,$wh){
    $info = db($tname)->field($fname)->where($wh)->find();
    return $info[$fname];
}
// 将二维数组转换为一维数组
function sort_info2($arr,$keys="meta_key",$field="meta_value"){
    $arr0 = array();
    foreach($arr as $k => $v){
        $arr0[$v[$keys]] = $v[$field];
    }
    return $arr0;
}
// 用户的权限组
function get_ainfo($admin_id,$tname="sys_admin",$tname2="sys_auth_group"){
    $prefix = Config::get('database.prefix');

    $admin_info = Db::table($prefix.$tname)->alias('a')
                            ->field('a.*,g.rules,g.title as role_name')
                            ->join($prefix.$tname2.' g','g.id = a.group_id')
                            ->where("a.id=".$admin_id)
                            ->find();
    return $admin_info;
}
// alert
function alertinfo($msg,$url=''){
    if($url==''){
        echo "<script>alert('".$msg."');javascript:history.go(-1);</script>";
    }else{
        echo "<script>alert('".$msg."');
             window.location.href='".$url."';</script>";
    }
    exit;
}
function get_alist($tname,$where,$order="id desc"){

    $list = db($tname)  ->where($where)
                        ->order($order)
                        ->select();

    return $list;
}

function get_alistlimit($tname,$where,$limit,$order="id desc"){

    $list = db($tname)  ->where($where)
                        ->order($order)
                        ->limit($limit)
                        ->select();

    return $list;
}
// 获取分页列表
function get_page_list($tname , $where,$page=1, $search, $field = "*", $order = ['id' => 'DESC'], $page_size = 15)
{

    $list = Db::name($tname)->where($where)
                            ->field($field)
                            ->order($order)
                            ->paginate($page_size, false, ['page' => $page,'query'=>$search]);
                            // ->paginate($page_size);

    return $list;
}



// 多表查询分页列表
function get_page_list2($fields, $where, $table1, $table2, $ons,$page=1, $search=[], $order = ['t1.id' => 'DESC'], $page_size = 15)
{
    $prefix = config('database.prefix');
    $list = Db::table($prefix.$table1)->alias('t1')
                                ->field($fields)
                                ->join($prefix.$table2." t2" , $ons , "LEFT")
                                ->where($where)
                                ->order($order)
                                ->cache(true)
                                ->paginate($page_size, false, ['page' => $page,'query'=>$search]);

    return $list;
}
// 多表查询分页列表
function get_page_list3($fields, $where, $table1, $table2, $ons2, $table3, $ons3,$page=1, $search=[], $order = ['t1.id' => 'DESC'], $page_size = 15)
{
    $prefix = config('database.prefix');
    $list = Db::table($prefix.$table1)->alias('t1')
                                ->field($fields)
                                ->join($prefix.$table2." t2" , $ons2 , "LEFT")
                                ->join($prefix.$table3." t3" , $ons3 , "LEFT")
                                ->where($where)
                                ->order($order)
                                ->cache(true)
                                ->paginate($page_size, false, ['page' => $page,'query'=>$search]);

    return $list;
}
// 添加资金变动日志
function add_account_log($param_id , $type , $order_id , $money , $ptype = "", $desc = ""){
    $mtype = config("sysparam.MTYPE");
    $t_model = db($mtype[$type]['tname']);
    $oinfo = $t_model->where("id=".$order_id)->find();
    $desc = ($desc=='') ? $mtype[$type]['desc'] : $desc;
    $ptype = ($ptype=='') ? $mtype[$type]['ptype'] : $ptype;
    $data = [
        $mtype[$type]['lead'] => $param_id,
        'type'=>$type ,
        'order_id'=>$order_id ,
        'order_sn'=>$oinfo['order_sn'] ,
        'order_user_id'=>$oinfo['user_id'] ,
        'money'=>$money ,
        'ptype'=>$ptype,
        'desc'=>$desc ,
        'addtime'=>time() ,
    ];
    $res = db("sys_money_log")->insert($data);
    return $res;
}
/**
 *  使用url_encode()对字符串进行编码
 *  @param string/array $str 需要编码的数据
 *  @return string/array $str 返回编码后的字符串
 */
function url_encode($str) {
    if(is_array($str)) {
        foreach($str as $key=>$value) {
            $str[urlencode($key)] = url_encode($value);
        }
    } else {
        $str = urlencode($str);
    }

    return $str;
}

/**
* 输出json数据，不解析中文
* @param string/array $str 需要进行json编码的数据
* @return string  输出json数据
*/
function encode_json($str) {
    $result = urldecode(json_encode(url_encode($str)));
    return $result;
}
// 取出json数据对应的元素
function get_kval_by_json($value,$keys){
    if(empty($value)){
        return "";
    }else{
        $arr = json_decode($value);
        return $arr->{$keys};
    }
}
// 数组返回php数据文件
function get_lang_file($lang){
    $llist = get_alist("sys_language","id > 0","id asc");
    $str="<?php \n"."return [\n";
    foreach ($llist as $k => $v) {
        $arr = json_decode($v['meta_value']);
        $val = $arr->{$lang};
        $str .= "\t'".$v['meta_key']."'=>'".$val."',\n";
    }
    $str.="\n];\n?>\n";
    return $str;
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function get_client_ip($type = 0) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = ip2long($ip);
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/*
 * 获取当前文章上下文章
 */
function get_pre_next_news($newsid,$strstr='>'){

    if($newsid) {
        $cid = Db::name('article')->where(['id' => $newsid])->value('cid');

        $fileds = ['id', 'cid', 'title'];
        $map    = ['cid' => $cid, 'status' => 1,'id'=>[$strstr,$newsid]];
        $sort   = ['is_top' => 'DESC', 'sort' => 'DESC', 'publish_time' => 'DESC'];
        $listinfo = Db::name('article')->where($map)->field($fileds)->order($sort)->limit(1)->find();
    }
    return $listinfo;
}


/*底部栏目*/
/*
 * $cname  表名
 * $id     id
 */
function getPidTNavs($cname,$id){
    $service = db($cname)->field('id,name')->where('id='.$id)->find();
    $aboutchild = db($cname)->field('id,name')->where('pid='.$id)->select();
    $service['child'] = $aboutchild;
    return $service;
}


