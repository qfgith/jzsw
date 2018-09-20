<?php
namespace app\common\controller;

use think\Cache;
use think\Controller;
use think\Cookie;
use think\Db;

class HomeBase extends Controller
{

    protected function _initialize()
    {
        parent::_initialize();
        $request =  request();
        /*微信登录*/
        // $wx_loginurl = $request->domain().url("Home/Index/getCode");
        // // dump($wx_loginurl);
        // $login_url ="https://open.weixin.qq.com/connect/qrconnect?appid=wx95bd5b626bb9927d&redirect_uri=".urlEncode($wx_loginurl)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        // dump($login_url);
        // header("location:".$login_url);
         // dump($login_url);exit;

        $curl = $request->domain().$request->url();
        // 去除分页页码的url
        $ccurl = $curl;
        $cc_wz = strpos($ccurl,"?page");
        $search_ss = substr($ccurl,$cc_wz);
        $ccurl = str_replace($search_ss, "", $ccurl);

        $this->getSystem();
        $this->getLinkWeb();
        $this->assign('keyword', '');
        if (!Cookie::has('uid')) {
            $uinfo = ['id' => 0 , 'username' => ''];
        }else{
            $uinfo = db('user')->where('id',intval(cookie('uid')))->find();
        }
        

        /*单页 表*/
        $pagenav = db('page')->select();
        foreach ($pagenav as $k => $v) {
            $pagenavs[$v['id']] = $v;
        }
        /*category*/
        $categorynav = db('category')->select();
        foreach ($categorynav as $k => $v) {
            $categorynavs[$v['id']] = $v;
        }
        
        /*底部公共*/
        $about = getPidTNavs('page','46'); //关于我们
        $service = getPidTNavs('page','58');//成功案例
        $news = getPidTNavs('category','8');//新闻资讯
        $contacts = getPidTNavs('page','63');//新闻资讯

        

        //this->assign(['uinfo' => $uinfo,'curl' => base64_encode($curl) , 'ccurl'=>$ccurl,'pagenavs'=>$pagenavs,'categorynavs'=>$categorynavs,'about'=>$about,'service'=>$service,'news'=>$news,'contacts'=>$contacts]);
    }

    /**
     * 获取站点信息
     */
    protected function getSystem()
    {
        $webset = db("sys_config")->select();

        $this->assign(['webset' => sort_info2($webset)]);
    }
    /*
     * 搜索框友情链接
     */
    protected function getLinkWeb(){
        $search_link = db('link')->where(['cid'=>'4','status'=>1])->select();
        $this->assign(['search_link'=>$search_link]);
    }

    /**
     * 获取前端轮播图
     */
    protected function getSlide()
    {
        if (Cache::has('slide')) {
            $slide = Cache::get('slide');
        } else {
            $slide = Db::name('slide')->where(['status' => 1, 'cid' => 1])->order(['sort' => 'ASC'])->select();
            if (!empty($slide)) {
                Cache::set('slide', $slide);
            }
        }


        /*
         * 底部友情链接
         */
        if (Cache::has('link')) {
            $link = Cache::get('link');
        } else {
            $link = Db::name('link')->where(['status' => 1])->order(['sort' => 'ASC'])->select();
            if (!empty($link)) {
                Cache::set('link', $link);
            }
        }


        $this->assign('slide', $slide);
        $this->assign('link', $link);
    }
}