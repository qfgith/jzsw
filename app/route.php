<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
// 注册路由
//路由地址的解析规则从后往前解析，先解析操作，然后解析控制器，最后解析模块

// Route::rule(':controller/:action','home/:controller/:action');

Route::rule('book/[:cid]/[:id]$','home/Book/index');
Route::get('book/show','home/Book/show',[],[ 'id' => '[0-9]+' ]);

Route::rule('reg','home/User/reg');
Route::rule('login','home/User/login');
Route::rule('logout','home/User/logout');



/*新能源车*/
Route::get('energy','Car/nengyuan_list',[],['id'=>'[0-9]+']);
Route::get('energy_detail','Car/nengyuan_show',[],['id'=>'[0-9]+']);

/*传统汽车*/
// Route::rule('tradition','Car/chuantong_list');
// Route::get('tradition_detail','Car/chuantong_show',[],['id'=>'[0-9]+']);

/*以租代购
Route::rule('rent','Car/zudaigou');
Route::get('rent_list','Car/zudaigou_list',[],['id'=>'[0-9]+']);
Route::get('rent_detail','Car/zudaigou_show',[],['id'=>'[0-9]+']);


Route::rule('sold','Article/sold_list');
Route::get('sold_detail','Article/sold_show',[],['[0-9]+']);


Route::rule('company','Company/company_list');
Route::get('company_detail','Company/company_show',[],['id'=>'[0-9]+']);
Route::get('company_detailfa','Company/company_show2',[],['id'=>'[0-9]+']);

Route::get('strategy','Article/yueche_gl_list',[],['id'=>'[0-9]+']);
Route::get('strategy_detail','Article/yueche_gl_show',[],['id'=>'[0-9]+']);
Route::rule('problem','Article/problem');
Route::get('problem_detail','Article/problem_show',[],['id'=>'[0-9]+']);

Route::rule('contact','Index/contact'); //联系我们
Route::rule('aboutus','Index/aboutus'); //商会介绍 （关于我们）
Route::get('aboutcompany','Index/about_company',[],['cid'=>'[0-9]+']); //关于我们

Route::rule('search','Index/search');
*/

/*工信*/

Route::get('about','Index/about',[],['cid'=>'[0-9]+']); //关于我们
Route::get('service','Index/service',[],['cid'=>'[0-9]+']);//专业服务
Route::rule('team','Index/team'); 	//专业团队

Route::rule('cases','Index/cases'); 	//成功案例list
Route::get('casesshow','Index/casesshow',[],['id'=>'[0-9]+']); 	//成功案例show

Route::get('news','Article/news',[],['cid'=>'[0-9]+']); 	//新闻list
Route::get('newsshow','Article/newsshow',[],['cid'=>'[0-9]+'],['id'=>'[0-9]+']); 	//新闻show

Route::get('contact','Index/contact',[],['cid'=>'[0-9]+']); //联系我们