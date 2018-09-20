<?php
namespace org;


/**
* 修改后的权限验证类
*/
class Sauth {
	 
	protected $role_id = 1;
	protected $type = 1;
	/**
	* 构造函数，初始化类
	* type代表后台类型，1为平台后台权限，2为酒吧后台权限
	*/
	public function init($role_id=1,$type=1){
		$this->role_id = $role_id;
       	$this->type = $type;
	}
	/*检查权限*/
	public function check($urlname){
		$act_list = db("sys_auth_group")->field("rules")->where("id=".$this->role_id)->find();
		$act_list = $act_list["rules"];
		if($this->role_id == 1){
			$wh = "type=".$this->type;
		}else{
			$wh = "id in (".$act_list.") and type=".$this->type;
		}

		$right = db("sys_auth_rule")->field('name')->where($wh)->select();
		foreach ($right as $k => $val){
			$role_right[$k] = url($val['name']);
		}
		$curl = url($urlname);
		if(in_array($curl , $role_right)){
			return 1;
		}else{
			return 0;
		}

	}
	/*根据角色权限过滤菜单*/
	public function get_menu_by_auth(){
		$menu_list = $this->get_all_menu();
		$act_list = db("sys_auth_group")->field("rules")->where("id=".$this->role_id)->find();
		if($this->role_id == 1){
			$act_list = "all";
		}else{
			$act_list = $act_list['rules'];
		}
		
		if($act_list != 'all'){
			$right = db("sys_auth_rule")->field('name')->where("id in ($act_list) and type=".$this->type)->select();
			foreach ($right as $k => $val){
				$role_right[$k] = $val['name'];
			}
			foreach($menu_list as $k=>$mrr){
				if( !empty($mrr['sub_menu']) ){
					foreach ($mrr['sub_menu'] as $j=>$v){
						if(!in_array($v['name'], $role_right)){
							unset($menu_list[$k]['sub_menu'][$j]);//过滤菜单
						}else{
							// 过滤第三级菜单
							foreach($v['son'] as $sj=>$sv){
								if(!in_array($sv['name'], $role_right)){
									unset($menu_list[$k]['sub_menu'][$j]['son'][$sj]);//过滤菜单
								}
							}
						}
					}
					// 菜单无法点击，且无下级子菜单
					if( count($menu_list[$k]['sub_menu'])==0 && (strstr($mrr['name'] , "/default")) ){
						unset($menu_list[$k]);
					}
				}
					
			}
		}
		return $menu_list;
	}
	/*得到菜单-总树形结构菜单*/
	public function get_all_menu(){
		$list = db("sys_auth_rule")->where("pid=0 and status=1 and type=".$this->type)->order("sort asc,id asc")->select();
		$arr = [];
		foreach($list as $k => $v){
			$lower = db("sys_auth_rule")->where("status=1 and pid=".$v['id']." and type=".$this->type)->order("sort asc,id asc")->select();
			$arr[$v['group']] = $v;
			$arr[$v['group']]['sub_menu'] = [];
			if(!empty($lower)){
				$arr[$v['group']]['sub_menu'] = $lower;
				
				foreach($lower as $sk => $sv){
					$lower2 = db("sys_auth_rule")->where("status=1 and pid=".$sv['id']." and type=".$this->type)->order("sort asc,id asc")->select();
					$arr[$v['group']]['sub_menu'][$sk]['son'] = [];
					if(!empty($lower2)){
						$arr[$v['group']]['sub_menu'][$sk]['son'] = $lower2;
					}
				}
			}
		}
		return $arr;
	}

}