<?php
namespace app\home\controller;

use think\Controller;
use think\Db;
use think\Lang;
use app\common\controller\HomeBase;

/**
 * 前台首页
 * Class Index
 * @package app\home\controller
 */
class Index extends HomeBase
{   
    
	public function index(){
		
         parent::_initialize();
        $ishome = 1;
        //banner
        $slide_index = Db::name('slide')->where(['status' => 1, 'cid' => 3])->order(['id' => 'asc'])->select();
      
        /*关于我们*/
        $aboutintro = getFval('page','introduction','46');
        
        /*团队*/
        $pos_team = db('article')->where('status=1 and isdel=0 and is_pos=1 and spai=1')->order(['sort'=>'asc','id'=>'desc'])->limit(4)->select();
        /*案例*/
        $anli_nav = db('category')->field('id,name')->where('spai=2 and pid=2')->order(['sort'=>'asc','id'=>'asc'])->select();
        $db_article = db('article');
        foreach ($anli_nav as $k => $v) {
            $anli_nav[$k]['list'] = $db_article->field('id,title,introduction')
                                            ->where('status=1 and isdel=0 and is_pos=1 and cid='.$v['id'])
                                            ->order(['sort'=>'asc','id'=>'desc'])->select();
        }
        
        //新闻资讯
        $arrid = db('category')->where('pid=8')->column('id');
        $ids = implode(',',$arrid);
        $pos_news = db('article')->where('status=1 and isdel=0 and spai=4 and is_pos=1')->order(['sort'=>'asc','id'=>'desc'])->select();
       
        return $this->fetch('/index',['cdomain' => config('cdomain'),'ishome'=>$ishome,'slide_index'=>$slide_index,'aboutintro'=>$aboutintro,'pos_team'=>$pos_team,'anli_nav'=>$anli_nav,'pos_news'=>$pos_news,'site_title'=>'首页']);
    }

    //关于我们
    public function about(){
        $cate_id = $this->request->param('cid');
        $secondnav = db('page')->where('pid=46')->order(['sort'=>'asc','id'=>'asc'])->select();
        foreach ($secondnav as $k => $v) {
            $secondnav_n[$v['id']] = $v;
        }

        $first_id = $secondnav[0]['id'];
        $cate_id =  !empty($cate_id) ? $cate_id : $first_id;
        $info = Db::name('page')->where('id='.$cate_id)->find();
        return $this->fetch('/aboutus',[
            'this_nav_1'=>'1',
            'info'=>$info,
            'cate_id'=>$cate_id,
            'base_id'=>'46',
            'secondnav'=>$secondnav,
            'site_title'=>$secondnav_n[$cate_id]['name']
        ]);
    }

    //专业服务
    public function service(){
        $cate_id = $this->request->param('cid');
        $secondnav = db('page')->where('pid=58')->order(['sort'=>'asc','id'=>'asc'])->select();
        foreach ($secondnav as $k => $v) {
            $secondnav_n[$v['id']] = $v;
        }

        $first_id = $secondnav[0]['id'];
        $cate_id =  !empty($cate_id) ? $cate_id : $first_id;
        $info = Db::name('page')->where('id='.$cate_id)->find();
        return $this->fetch('/service',[
            'this_nav_2'=>'2',
            'info'=>$info,
            'cate_id'=>$cate_id,
            'base_id'=>'58',
            'secondnav'=>$secondnav,
            'site_title'=>$secondnav_n[$cate_id]['name']
        ]);
    }

    //专业团队
    public function team(){
        $pagenavs = db('category')->where('spai=1 and id=1')->find();
        $list = db('article')->where('status=1 and isdel=0 and spai=1 and cid=1')->order(['sort'=>'asc','id'=>'desc'])->select();
   
        $list1 = array_chunk($list,2);
        foreach ($list1 as $k => $v) {
            $list2[$k]['pseron1'] = $v; 
        }
//         dump($list2);
        return $this->fetch('/team',[
            'this_nav_3'=>'3',
            'base_id'=>'1',
            'cate_id'=>'1',
            'pagenavs'=>$pagenavs,
            'list'  =>$list2,
            'site_title'=>$pagenavs['name'],
        ]);
    }


    //成功案例
    public function cases(){
        $pagenavs = db('category')->where('spai=2 and id=2')->find();
        $second_nav = db('category')->where('pid=2')->order(['sort'=>'asc','id'=>"asc"])->select();
        $db_article = db('article');
        foreach ($second_nav as $k => $v) {
            $second_nav[$k]['list'] = $db_article->where('status=1 and isdel=0 and cid='.$v['id'])->order(['sort'=>'asc','id'=>'asc'])->select();
        }

        return $this->fetch('/cases',[
            'this_nav_4'=>'4',
            'base_id'=>'2',
            'cate_id'=>'2',
            'pagenavs'=>$pagenavs,
            'secondnav'=>$second_nav,
            'site_title'=>$pagenavs['name'],
        ]);
    }

    //成功案例详情
    public function casesshow(){
        $pagenavs = db('category')->where('spai=2 and id=2')->find();
        $second_nav = db('category')->where('pid=2')->order(['sort'=>'asc','id'=>"asc"])->select();
        $id = $this->request->param('id');
        $info = db('article')->where('id='.$id)->find();
        $prev_article=get_pre_next_news($id,'<');  //*where.= id < $id (上一页)
        $next_article=get_pre_next_news($id,'>');  //*where.= id > $id (下一页)
        return $this->fetch('/cases_detail',[
            'this_nav_4'=>'4',
            'base_id'=>'2',
            'cate_id'=>'2',
            'pagenavs'=>$pagenavs,
            'info'=>$info,
            'prev_article'=>$prev_article,
            'next_article'=>$next_article
        ]);
    }


   //联系我们
   public function contact(){
        $cate_id = $this->request->param('cid');
        $secondnav = db('page')->where('pid=63')->order(['sort'=>'asc','id'=>'asc'])->select();
        foreach ($secondnav as $k => $v) {
            $secondnav_n[$v['id']] = $v;
        }

        $first_id = $secondnav[0]['id'];
        $cate_id =  !empty($cate_id) ? $cate_id : $first_id;
        $info = Db::name('page')->where('id='.$cate_id)->find();

        if($cate_id=='64'){
            $url = '/contact_map';
        }else{
            $url = '/contact';
        }

        return $this->fetch($url,[
            'this_nav_6'=>1,
            'info'  =>$info,
            'cate_id'=>$cate_id,
            'base_id'=>'63',
            'secondnav'=>$secondnav,
            'site_title'=>$secondnav_n[$cate_id]['name']
        ]);
   }


   //留言
   public function insert(){
        $arr = explode("###",$_POST['info']);
        
        $map['uname']=$arr[0];
        $map['mobile']=$arr[1];
        $map['content']=$arr[2];
        $map['typeid'] = 1;
        
            $zxly = '在线信息预留';
        
        $map['type']=$zxly."-".$map['uname'];
        $map['addtime']=time();
        $map['ip'] = get_client_ip();
        
        $res=db("feedback")->insert($map);
            
        
        if($res){
            $data['status']=1;
            $data['info']='已提交成功';
        }
        else{
            $data['status']=0;
            $data['info']='提交失敗';
            
        }
        
        return json($data);
    }



   

    //search 搜索框
    public function search($page='1'){
        // dump(request()->param('like'));
        if(request()->param('like')){
            $tname = 'article';
            $wh = "isdel=0 and status=1 and spai=1 and title like('%".request()->param('like')."%')";
            $search = ["like"=>request()->param('like')];
            $field = "*";
            $order = ['sort'=>'ASC','id'=>'DESC'];
            $page_size = 18;
            $list = get_page_list($tname,$wh,$page,$search,$field,$order,$page_size);
            // $list = $list->toArray()['data'];
            $db_category = db('category');
            foreach ($list as $k => $v) {
                $list_new[$k]['first_nav'] = $db_category->where('id='.$v['cid'])->column('pid')[0];
                $list_new[$k]['id'] = $v['id'];
            }
            if(isset($list_new)){
                $this->assign('list_n',$list_new);
            }
            //热门车型
            $right_car =getRightTopCar();
            //推荐经销商
            $right_com = getRightTopCompany();
            //快讯
            $right_article = getRightTopArticle();

        }else{
            $this->error('没有找到结果');
        }
        $this->assign('site_title','搜索');

        return $this->fetch('/search',[
            'list'  =>$list,
            'page'  =>$list->render(),
            'pagenums'=>$list->lastPage(),

            'right_car' =>$right_car,
            'right_com' =>$right_com,
            'right_article'=>$right_article,
            'search_val'   =>request()->param('like'),
        ]);
    }


}