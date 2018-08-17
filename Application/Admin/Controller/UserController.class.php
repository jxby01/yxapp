<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
	/**
	 * 用户-控制器
	 */
	
	/**
	 * [user_list description]
	 * @return [type] [description]
	 * 用户列表
	 */
	public function user_list(){
		$row=M('user')->select();
		$count=M('user')->count();
		$school=M('school')->select();
		$this->assign('school',$school);
		$this->assign('count',$count);
		$this->assign('row',$row);
		$this->view();
	}
	/**
	 * [user_add description]
	 * @return [type] [description]
	 * 添加用户
	 */
	public function user_add(){
		$school=M('school')->select();
		$this->assign('school',$school);
		$this->view();
	}
	/**
	 * [search description]
	 * @return [type] [description]
	 * 筛选搜索
	 */
	public function search(){
		$role=$_POST['role'];
		$school=$_POST['school'];
		$content=$_POST['content'];
		$t=$_POST['t'];

		if($t==1){ //筛选按钮
			if($role==4 || $role==6){
				$row=M('user')->where(array('role'=>$role))->select();
				$count=M('user')->where(array('role'=>$role))->count();
			}else if($role==-1 && $school){
				$row=M('user')->where(array('school'=>$school))->select();
				$count=M('user')->where(array('school'=>$school))->count();
			}else if($role==-1 && !$school){
				$row=M('user')->select();
				$count=M('user')->count();
			}else if($school && $role!=-1){
				$row=M('user')->where(array('role'=>$role,'school'=>$school))->select();
				$count=M('user')->where(array('role'=>$role,'school'=>$school))->count();
			}else if(($role!=4 || $role!=6) && $role != -1 && !$school){
				$row=M('user')->where(array('role'=>$role))->select();
				$count=M('user')->where(array('role'=>$role))->count();
			}
		}
		if($t==2){ //搜索按钮
			$row=M('user')->where("username like '%".$content."%' or tel like '%".$content."%'")->select();
			$count=M('user')->where("username like '%".$content."%' or tel like '%".$content."%'")->count();
		}
		$school=M('school')->select();
		$this->assign('school',$school);
		$this->assign('count',$count);
		$this->assign('row',$row);
		$this->view('user_list');
	}
	/**
	 * [examine_list description]
	 * @return [type] [description]
	 * 审核列表
	 */
	public function examine_list(){
		$row=M('user')->where("examine != 0")->select();
		$count=count($row);
		$this->assign('row',$row);
		$this->assign('count',$count);
		$this->view();
	}
}