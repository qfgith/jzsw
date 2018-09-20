<?php
namespace app\Home\controller;

use app\common\controller\HomeBase;
use think\Db;

class Article extends HomeBase
{
    
    /*news*/
    public function news($page ='1'){
        $cate_id =  $this->request->param('cid');
        $secondnav = db('category')->where('pid=8')->order(['sort'=>'asc','id'=>'asc'])->select();
        foreach ($secondnav as $k => $v) {
            $secondnav_n[$v['id']] = $v;
        }

        $first_id = $secondnav[0]['id'];
        $cate_id = !empty($cate_id)?$cate_id: $first_id;    //默认进来的cid

        //list
        $tname = 'article';
        $wh    = 'spai=4 and status=1 and isdel=0 and cid='.$cate_id ;
        $search =[];
        $field = 'id,title,introduction,thumb,sort,create_time';
        $order = ['sort'=>'ASC','id'=>'DESC'];
        $page_size=3;
        $list = get_page_list($tname,$wh,$page,$search,$field,$order,$page_size);

       

      

        return $this->fetch('/news',[
            'this_nav_5'=>'5',
            'list'    =>$list,
            'page'    =>$list->render(),
            'pagenums'=>$list->lastpage(),
            'cate_id'  =>$cate_id,
            'base_id' =>'8',
            'secondnav'=>$secondnav,
            'site_title'=>$secondnav_n[$cate_id]['name']

        ]);
    }


    public function newsshow()
    {

        
        $newsid= request()->route('id');
        $cate_id =  $this->request->param('cid');
        $secondnav = db('category')->where('pid=8')->order(['sort'=>'asc','id'=>'asc'])->select();

        $prev_article=get_pre_next_news($newsid,'<');  //*where.= id < $newsid (上一页)
        $next_article=get_pre_next_news($newsid,'>');  //*where.= id > $newsid (下一页)
       // var_dump($newsid);
        
        $info=Db::name('article')->where(['isdel'=>0,'status'=>1,'id'=>$newsid])->find();

        $this->assign(
            [   
                'this_nav_5'=>'5',
                'cate_id'   =>$cate_id,
                'base_id' =>'8',
                'secondnav'=>$secondnav,
                'info'=> $info,
                'prev_article'=> $prev_article,
                'next_article'=> $next_article,
                'site_title'=>$info['title']
            ]
        );

        // var_dump($info);

        Db::name('article')
            ->where('id', $newsid)
            ->setInc('reading');
        return $this->fetch('/news_detail');
    }


}
