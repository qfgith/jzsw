<?php
namespace app\api\controller;

use think\Controller;
use think\Session;

/**
 * 通用上传接口
 * Class Upload
 * @package app\api\controller
 */
class Upload extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();
        if (!Session::has('admin_id')) {
            $result = [
                'error'   => 1,
                'message' => '未登录'
            ];

            return json($result);
        }
    }

    /**
     * 通用图片上传接口
     * @return \think\response\Json
     */
    public function upimgs($type="image")
    {
        $config = [
            'size' => 3145728,
            'ext'  => 'jpg,jpeg,gif,png,bmp,txt,pdf,doc,docx,xls,rar,zip'
        ];

        $file = $this->request->file('file');
        if(in_array($type , ['image','file'])){
            $upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads/'.$type.'/'.date("Ymd"));
            $sname = date("Hi").rand(100000,999999);//文件名
            $save_path   = 'uploads/'.$type.'/'.date("Ymd").'/';
        }else{
            $upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads/'.$type);
            $sname = date("ymdHi!").rand(100,999);//文件名
            $save_path   = 'uploads/'.$type.'/';
        }

        $info        = $file->validate($config)->move($upload_path,$sname);
        // $info        = $file->validate($config)->move($upload_path);

        if ($info) {
            $result = [
                'error' => 0,
                'name'  => $info->getFilename(),
                'url'   => str_replace('\\', '/', $save_path . $info->getSaveName())
            ];
        } else {
            $result = [
                'error'   => 1,
                'message' => $file->getError()
            ];
        }
        return json($result);
    }




    /**
     * 通用图片上传接口
     * @return \think\response\Json
     */
    public function upload()
    {
        $config = [
            'size' => 3145728,
            'ext'  => 'jpg,gif,png,bmp'
        ];

        $file = $this->request->file('file');

        $upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads');

        $save_path   = '/uploads/';
        $info        = $file->validate($config)->move($upload_path);

        if ($info) {
            $result = [
                'error' => 0,
                'url'   => str_replace('\\', '/', $save_path . $info->getSaveName())
            ];
        } else {
            $result = [
                'error'   => 1,
                'message' => $file->getError()
            ];
        }

        return json($result);
    }

    
}