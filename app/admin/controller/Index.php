<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Db;


/**
 * 后台首页
 * Class Index
 * @package app\admin\controller
 */
class Index extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        $version = Db::query('SELECT VERSION() AS ver');
        $config  = [
            'url'             => $_SERVER['HTTP_HOST'],
            'document_root'   => $_SERVER['DOCUMENT_ROOT'],
            'server_os'       => PHP_OS,
            'server_port'     => $_SERVER['SERVER_PORT'],
            'server_soft'     => $_SERVER['SERVER_SOFTWARE'],
            'php_version'     => PHP_VERSION,
            'mysql_version'   => $version[0]['ver'],
            'max_upload_size' => ini_get('upload_max_filesize')
        ];
        return $this->fetch('index', ['config' => $config]);
    }
    /**
     * 清除缓存
     */
    public function clear()
    {

        if (delete_dir_file(CACHE_PATH) || delete_dir_file(TEMP_PATH)) {
            $this->success('清除缓存成功');
        } else {
            $this->error('清除缓存失败');
        }
    }
    
    public function test(){
        $info1['ueditor'] = getUeditor();
        $info1['ucontent'] = getHtmlEditor("content","");
        $info1['uimgs'] = getUeditorImages("imgs","");

        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['imgs'] = picarr2str($data['imgs'],$data['imgs_name']);
            unset($data['upload_imgs_imgs']);
            unset($data['imgs_name']);

            exit;
            // $this->error('保存失败');
        }
        return $this->fetch('test2',['info'=>$info1]);
    }
    public function test2(){
        $this->error('保存失败');
    }
    public function test3(){
        if ($this->request->isPost()) {
            $this->error('保存失败');
        }
        return $this->fetch('test3');
    }

    
    
}