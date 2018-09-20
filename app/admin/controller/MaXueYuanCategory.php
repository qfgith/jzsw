<?php
/**
 * Created by PhpStorm.
 * User: mayn
 * Date: 2018/9/20
 * Time: 11:36
 */

namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\model\Article as ArticleModel;
use app\common\model\Category as CategoryModel;
use app\common\model\Page as PageModel;
use think\Request;
use think\Db;

class MaXueYuanCategory extends AdminBase
{
    //构建方法，有用到这个类里面的东西，肯定优先调用
    protected function _initialize()
    {
        parent::_initialize();
        $request = Request::instance();
        $this->category_model = new CategoryModel();
        $this->article_model  = new ArticleModel();
        $this->page_model  = new PageModel();
        $res = db('page')->where(['spai'=>3])->select();
        $category_level_list = array2level($res);
        $this->assign('category_level_list', $category_level_list);
    }

    //麻学院栏目首页
    public function index(){
        return $this->fetch();
    }

    //添加麻学院栏目
    public function add(){
        return $this->fetch();
    }

    /**
     * 保存栏目
     */

    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();

            $validate_result = $this->validate($data, 'Category');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $dataa['spai'] = 3;
                $dataa['name'] = $data['name'];
                $dataa['alias'] = isset($data['alias'])?$data['alias']:'';
                $dataa['introduction'] = isset($data['introduction'])?$data['introduction']:'';
                $dataa['pid']  = $data['pid'];
                $dataa['create_time'] = time();
                if (db('page')->insert($dataa)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }
    }
}