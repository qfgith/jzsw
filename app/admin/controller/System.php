<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Cache;
use think\Db;
use think\Session;

/**
 * 系统配置
 * Class System
 * @package app\admin\controller
 */
class System extends AdminBase
{
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 站点配置
     */
    public function siteconfig()
    {
        $list = db("sys_config")->where("meta_id=1")->select();
        if(request()->isPost()){
            $data = request()->post();
            foreach($data as $k=>$v){
                $map['meta_key'] = $k;
                $save['meta_value'] = $v;
                $res = db("sys_config")->where($map)->update($save);
            }
            $this->success('站点信息修改成功',url('admin/System/siteconfig'));
        }
        $this->assign("list",$list);
        $this->display();

        return $this->fetch('siteconfig', ['list' => $list]);
    }

    /**
     * 操作日志
     */
    public function loglist($page=1)
    {
        $table1 = "sys_actionlog";
        $table2 = "shop_admin";
        $ons = "t1.admin_id = t2.id";

        $wh = "t1.type=1";
        $search = [];
        $field = "t1.*,t2.name as uname";
        $order = ['t1.id' => 'DESC'];
        $pnum = 10;
        
        // 分页列表
        $list = get_page_list2($field, $wh, $table1, $table2, $ons,$page, $search, $order, $pnum);
        // 获取分页显示
        $pages = $list->render();
        return $this->fetch('loglist', ['list' => $list , 'pages' => $pages]);
    }

    /**
     * 语言包列表
     */
    public function langlst($page=1)
    {
        $list = get_page_list('sys_language',[],$page,[],"*","id asc",10);
        // 获取分页显示
        $pages = $list->render();
        $llist = get_alist("sys_param","isdel=0 and type=5","sort asc");
        return $this->fetch('langlst', ['list' => $list, 'pages' => $pages, 'llist' => $llist]);
    }

    // 添加语言包key
    public function addlk()
    {
        $info1 = ['id'=>0,'meta_key'=>'','meta_value'=>''];
        $llist = get_alist("sys_param","isdel=0 and type=5","sort asc");
        $rnum = count($llist)+1;
        if (request()->isPost()) {
            $info = request()->post();

            $has = db("sys_language")->where("meta_key='".$info['meta_key']."'")->find();
            if($has){
                $this->error("此标识已存在，请更换");
            }else{
                $data['meta_key'] = $info['meta_key'];
                unset($info['meta_key']);
                $data['meta_value'] = encode_json($info);
                $res = db("sys_language")->insert($data);
                // 保存语言文件
                foreach($info as $k => $v){
                    $myfile = fopen(APP_PATH.'lang/'.$k.'.php', "w");
                    $contents = get_lang_file($k);
                    fwrite($myfile, $contents);
                    fclose($myfile);
                }
                clear_cache();
                $this->success('操作成功');
            }

                
        }
        return $this->fetch("editlk",['info' => $info1 ,'rnum'=>$rnum , 'llist' => $llist]);
    }
    // 修改语言文件信息
    public function editlk($id){
        $info1 = db("sys_language")->where("id=".$id)->find();
        $llist = get_alist("sys_param","isdel=0 and type=5","sort asc");
        $rnum = count($llist)+1;

        if (request()->isPost()) {
            $info = request()->post();
            $has = db("sys_language")->where("meta_key='".$info['meta_key']."' and id !=".$info['id'])->find();
            if($has){
                $this->error("此标识已存在，请更换");
            }else{
                $map = "id=".$info['id'];
                $data['meta_key'] = $info['meta_key'];
                unset($info['id']);
                unset($info['meta_key']);
                $data['meta_value'] = encode_json($info);
                $res = db("sys_language")->where($map)->update($data);
                $contents = [];
                // 保存语言文件
                foreach($info as $k => $v){
                    $myfile = fopen(APP_PATH.'lang/'.$k.'.php', "w");
                    $contents = get_lang_file($k);
                    fwrite($myfile, $contents);
                    fclose($myfile);
                }

                $this->success('操作成功',url('admin/system/langlst'));
            }
        }
        
        return $this->fetch("editlk",['info' => $info1 , 'rnum'=>$rnum , 'llist' => $llist]);
    }
    // 删除语言key
    public function dellk($id){
        $map['id'] = $id;
        if ( db("sys_param")->where($map)->delete() ) {
            $llist = get_alist("sys_param","isdel=0 and type=5","sort asc");
            // 保存语言文件
            foreach($llist as $k => $v){
                $myfile = fopen(APP_PATH.'lang/'.$v['val2'].'.php', "w");
                $contents = get_lang_file($v['val2']);
                fwrite($myfile, $contents);
                fclose($myfile);
            }
            clear_cache();
            add_admin_log('删除语言标识');
            $this->success('删除成功',url('admin/system/langlst'));
        } else {
            $this->error('删除失败');
        }
    }
    // 商城首页轮换图
    public function sslide($page=1){
        $list = get_page_list('shop_img',"isdel=0 and shop_id = 0",$page,[],"*","sort asc",10);
        // 获取分页显示
        $pages = $list->render();
        return $this->fetch('sslide', ['list' => $list, 'pages' => $pages]);
    }
    // 添加商城轮换图
    public function addss(){
        $info1 = ['id'=>0,'status'=>1,'name'=>'','img'=>'','link'=>''];
        if (request()->isPost()) {
            $info = request()->post();
            $info['addtime'] = $info['modtime'] = time();
            $res = db("shop_img")->insert($info);
            clear_cache();
            add_admin_log('添加商城轮换图');
            $this->success('添加成功',url('admin/system/sslide'));
        }
        return $this->fetch('editss', ['info' => $info1]);
    }
    // 编辑商城轮换图
    public function editss($id){
        $info1 = db("shop_img")->where("id=".$id)->find();
        if (request()->isPost()) {
            $info = request()->post();
            $info['modtime'] = time();
            $res = db("shop_img")->where("id=".$info['id'])->update($info);
            clear_cache();
            add_admin_log('编辑商城轮换图');
            $this->success('更新成功',url('admin/system/sslide'));
        }
        return $this->fetch('editss', ['info' => $info1]);
    }
    // 删除商城轮换图
    public function delss($id){
        $map['id'] = $id;
        $save = ['isdel' => 1,'modtime'=>time()];
        if ( db("shop_img")->where($map)->update($save) ) {
            clear_cache();
            add_admin_log('删除商城轮换图');
            $this->success('删除成功',url('admin/system/sslide'));
        } else {
            $this->error('删除失败');
        }
    }
}