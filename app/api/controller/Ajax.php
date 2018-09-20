<?php
namespace app\api\controller;

use think\Controller;


class Ajax extends Controller
{
	public function index(){
        echo lang("wellcome", [], 'en-us');
    }
    /*
     * 获取地区
     */
    public function get_region(){
        $pid = request()->param("pid",0);
        $selected = request()->param("selected",0);
        $level = request()->param("level",2);
        switch ($level) {
        	case '1':
        		$str = '<option value="0">省份</option>';
        		break;
        	case '2':
        		$str = '<option value="0">城市</option>';
        		break;
        	default:
        		$str = '<option value="0">县/区域</option>';
        		break;
        }
                
        $data = db('sys_region')->where("pid=$pid and level=$level")->select();
        $html = '';
        if($data){
            foreach($data as $h){
            	if($h['id'] == $selected){
            		$html .= "<option value='{$h['id']}' selected>{$h['name']}</option>";
            	}else{
                    $html .= "<option value='{$h['id']}'>{$h['name']}</option>";
                }
            }
        }
        return $str.$html;
    }
    // 获取酒吧打印机列表,和酒吧的身份编号
    public function get_bprint(){
        $bid = request()->param("bid",0);
        $barno = ($bid) ? getFval("bar_bar","bar_no",$bid) : "";
        $data = get_alist("bar_brand","isdel=0 and status=1 and bar_id=".$bid,"sort asc");
        $html = '<option value="0">---打印机---</option>';
        if($data){
            foreach($data as $h){
                $html .= "<option value='{$h['id']}'>{$h['name']}</option>";
            }
        }
        return json(['barno'=>$barno,'html'=>$html]);
    }
    
}