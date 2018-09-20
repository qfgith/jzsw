<?php
namespace app\admin\controller;

use app\common\model\AlonePage as AlonePageModel;
use app\common\model\Article as ArticleModel;
use app\common\model\Category as CategoryModel;
use app\common\controller\AdminBase;
use think\Db;

/**
 * 文章管理
 * Class Article
 * @package app\admin\controller
 */
class Article extends AdminBase
{
    protected $alone_page_model;
    protected $article_model;
    protected $category_model;


    protected function _initialize()
    {
        parent::_initialize();
        // $spai_value=['spai'=>4];
        $this->alone_page_model  = new AlonePageModel();

        $this->article_model  = new ArticleModel();
        $this->category_model = new CategoryModel();

        $category_level_list = $this->category_model->getLevelList(4);
        // dump($category_level_list);
        $this->assign('category_level_list', $category_level_list);
    }

    /**
     * 文章管理
     * @param int    $cid     分类ID
     * @param string $keyword 关键词
     * @param int    $page
     * @return mixed
     */
    public function index($cid = 0, $keyword = '', $page = 1)
    {
        $map   = [];
        $map['isdel'] = 0;
        $map['spai'] = ['eq', $this->spai];
        $field = 'id,title,cid,author,reading,status,publish_time,sort,thumb,isdel,create_time';

        if ($cid > 0) {
            $category_children_ids = $this->category_model->where(['path' => ['like', "%,{$cid},%"]])->column('id');
            $category_children_ids = (!empty($category_children_ids) && is_array($category_children_ids)) ? implode(',', $category_children_ids) . ',' . $cid : $cid;
            $map['cid']            = ['IN', $category_children_ids];
        }

        if (!empty($keyword)) {
            $map['title'] = ['like', "%{$keyword}%"];
        }
        $article_list  = $this->article_model->field($field)->where($map)->order(['id' => 'DESC'])->paginate(15, false, ['page' => $page]);

        $category_list = $this->category_model->column('name', 'id');
 
        return $this->fetch('index', ['article_list' => $article_list, 'category_list' => $category_list, 'cid' => $cid, 'keyword' => $keyword]);
    }


    /**
     * 文章管理 （右侧管理）
     * @param int    $cid     分类ID
     * @param string $keyword 关键词
     * @param int    $page
     * @return mixed
     */
    public function right($cid = 0, $keyword = '', $page = 1)
    {
        $map   = [];
        $map['isdel'] = 0;
        $map['spai'] = ['eq', $this->spai];
        $map['is_right'] = 1;
        $field = 'id,title,cid,author,reading,status,publish_time,sort,thumb,isdel,create_time,sort2';

        if ($cid > 0) {
            $category_children_ids = $this->category_model->where(['path' => ['like', "%,{$cid},%"]])->column('id');
            $category_children_ids = (!empty($category_children_ids) && is_array($category_children_ids)) ? implode(',', $category_children_ids) . ',' . $cid : $cid;
            $map['cid']            = ['IN', $category_children_ids];
        }

        $article_list  = $this->article_model->field($field)->where($map)->order(['id' => 'DESC'])->paginate(15, false, ['page' => $page]);
        // dump($article_list);
        $category_list = $this->category_model->column('name', 'id');
 
        return $this->fetch('right', ['article_list' => $article_list, 'category_list' => $category_list, 'cid' => $cid, 'keyword' => $keyword]);
    }

     /*
     *排序
     */
    public function listorder(){
        $ids = $this->request->param()['sort'];
        
        foreach($ids as $key=>$r) {
            $data['id'] = $key;
            $data['sort']=$r;
            $list[] = $data;
        }
       $this->article_model->saveall($list);
       $this->success('操作成功');
        
    }

     /*
     *右侧文章排序
     */
    public function listorderright(){
        $ids = $this->request->param()['sort2'];
        
        foreach($ids as $key=>$r) {
            $data['id'] = $key;
            $data['sort2']=$r;
            $list[] = $data;
        }
        // dump($list);
       $this->article_model->saveall($list);
       $this->success('操作成功');
        
    }

    

    /**
     * 添加文章
     * @return mixed
     */
    public function add()
    {   
        $info1['ueditor'] = getUeditor();
        $info1['ucontent'] = getHtmlEditor("content","");
        $info1['uphoto'] = getUeditorImages("photo","");
        return $this->fetch('',['info1'=>$info1]);
    }


    /**
     * 保存文章
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'Article');

            $data['spai']=$this->spai;

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if(isset($data['photo'])){
                    $data['photo'] = picarr2str($data['photo'],$data['photo_name']);
                 }

                if ($this->article_model->allowField(true)->save($data)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑文章
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {   
        $article = $this->article_model->find($id);
        // dump($article->toArray());
        $info1['ueditor'] = getUeditor();
        $info1['ucontent'] = getHtmlEditor("content",$article['content']);
        $info1['uphoto'] = getUeditorImages("photo",$article['photo']);
        

        return $this->fetch('edit', ['article' => $article,'info1'=>$info1]);
    }

    /**
     * 更新文章
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'Article');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if(isset($data['photo'])){
                    $data['photo'] = picarr2str($data['photo'],$data['photo_name']);
                 }
                if ($this->article_model->allowField(true)->save($data, $id) !== false) {
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }


    /**
     * 删除文章
     * @param int   $id
     * @param array $ids
     */
    public function delete($id = 0)
    {
        $save['isdel'] = 1;
        $save['publish_time'] = time();
        $map['id'] = $id;
        if ($id) {
            if ($this->article_model->where($map)->update($save)) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        } else {
            $this->error('请选择需要删除的文章');
        }
    }

    /**
     * 移除右边文章
     * @param int   $id
     * @param array $ids
     */
    public function removeright($id = 0)
    {
        $save['is_right'] = 0;
        $save['sort2'] = 0;
        $save['publish_time'] = time();
        $map['id'] = $id;
        if ($id) {
            if ($this->article_model->where($map)->update($save)) {
                $this->success('移除成功');
            } else {
                $this->error('移除失败');
            }
        } else {
            $this->error('请选择需要移除的文章');
        }
    }


   


}