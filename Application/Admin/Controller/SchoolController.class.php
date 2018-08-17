<?php
namespace Admin\Controller;
use Think\Controller;
class SchoolController extends CommonController {
	/**
	 * 学校-控制器
	 */
	
	/**
	 * [school_list description]
	 * @return [type] [description]
	 * 学校列表
	 */
	public function school_list(){
		$row=M('school')->select();
		$count=count($row);
		$this->assign('count',$count);
		$this->assign('row',$row);
		$this->view();
	}
	/**
	 * [add description]
	 * 增加学校
	 */
	public function add(){
		$this->view();
	}
	/**
	 * [add_date description]
	 * 添加数据入库
	 */
	public function add_date(){
		$rtn=M('school')->add($_POST);
		if($rtn){
			$this->success('添加成功',U("School/add"),2);
		}else{
			$this->error('添加失败');
		}
	}
	/**
	 * [edit description]
	 * @return [type] [description]
	 * 修改学校
	 */
	public function edit(){
		$row=M('school')->find($_GET['id']);
		$this->assign('row',$row);
		$this->view();
	}
	/**
	 * [up_date description]
	 * @return [type] [description]
	 * 修改数据入库
	 */
	public function up_date(){
		$rtn=M('school')->where(array('id'=>$_POST['id']))->save(array('name'=>$_POST['name']));
		if($rtn){
			$this->success('修改成功',U('School/school_list'),2);
		}else{
			$this->error('修改失败');
		}
	}
	/**
	 * [del description]
	 * @return [type] [description]
	 * 单个删除
	 */
	public function del(){
		$id=$_POST['id'];
		echo M('school')->delete($id);
	}
	/**
	 * [all_del description]
	 * @return [type] [description]
	 * 多选删除
	 */
	public function all_del(){
		$all_id=$_POST['id'];
        $whe['id']=array('in',$all_id);
        $rtn=M('school')->where($whe)->delete();
        echo $rtn;
	}
}