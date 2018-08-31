<?php
namespace Admin\Controller;
use Think\Controller;
class CourseController extends CommonController {
	/**
	 * 课程管理 --控制器
	 */
	
	/**
	 * [course_list description]
	 * @return [type] [description]
	 * 课程列表
	 */
	public function course_list(){
		$row=M('curriculum')->select();
		foreach ($row as $key => $value) {
			$cloumn=M('curriculum_theme')->find($value['line_cloumn_id']);
			$row[$key]['line_cloumn']=$cloumn['title'];
			$user=M('user')->find($value['user_id']);
			$row[$key]['user']=$user['username'];
		}
		$count=count($row);
		$curriculum=M('curriculum_theme')->select();
		$this->assign('curriculum',$curriculum);
		$this->assign('row',$row);
		$this->assign('count',$count);
		$this->view();
	}
	/**
	 * [add_course description]
	 * 添加课程
	 */
	public function add_course(){
		$cloumn=M('curriculum_theme')->select();
		$expert=M('user')->where(array('role'=>6,'state'=>1))->select();
		$this->assign('expert',$expert);
		$this->assign('cloumn',$cloumn);
		$this->view();
	}
	/**
	 * [eit_course description]
	 * @return [type] [description]
	 * 修改课程
	 */
	public function eit_course(){
		$row=M('curriculum')->find($_GET['id']);
		$row['label']=json_decode($row['label']);
		$row['banner']=json_decode($row['banner']);
		$row['arrange']=json_decode($row['arrange'],true);
		$cloumn=M('curriculum_theme')->select();
		$expert=M('user')->where(array('role'=>6,'state'=>1))->select();
		$this->assign('expert',$expert);
		$this->assign('cloumn',$cloumn);
		$this->assign('row',$row);
		$this->view();
	}
	
}