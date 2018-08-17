<?php
namespace Admin\Controller;
use Think\Controller;
class UserLogicController extends CommonController {
	/**
	 * 用户-控制器-逻辑
	 */
	
	/**
	 * [del description]
	 * @return [type] [description]
	 * 单个用户删除
	 */
	public function del(){
		$id=$_POST['id'];
		echo M('user')->delete($id);
	}
	/**
	 * [add description]
	 * 增加用户
	 */
	public function add(){
		if(!$_POST['username']){
			alert('请输入用户名','3000',2);
			exit;
		}
		if(!$_POST['tel']){
			alert('请输入登录手机号','3000',2);
			exit;
		}
		if(!$_POST['password']){
			alert('请输入登录密码','3000',2);
			exit;
		}
		$rtn = M('user')->add($_POST);
		if($rtn){
			$this->success('添加成功',U('User/user_list'),2);
		}else{
			alert('添加失败','3000',2);
		}
	}
	/**
	 * [alldel description]
	 * @return [type] [description]
	 * 多选删除
	 */
	public function alldel(){
		$all_id=$_POST['id'];
        $whe['id']=array('in',$all_id);
        $rtn=M('user')->where($whe)->delete();
        echo $rtn;
	}
	/**
	 * [approved description]
	 * @return [type] [description]
	 * 通过审核
	 */
	public function approved(){
		$id=$_POST['id'];
		$examine=$_POST['examine'];
		echo M('user')->where(array('id'=>$id))->save(array('role'=>$examine,'examine'=>0));
	}
}