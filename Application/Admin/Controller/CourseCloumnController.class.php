<?php
namespace Admin\Controller;
use Think\Controller;
class CourseCloumnController extends CommonController {
	/**
	 * 课程分类--控制器
	 */
	
	/**
	 * [cloumn_list description]
	 * @return [type] [description]
	 * 分类列表
	 */
	public function cloumn_list(){
		$row=M('curriculum_theme')->select();
		$count=count($row);
		$this->assign('row',$row);
		$this->assign('count',$count);
		$this->view();
	}
	/**
	 * [add_cloumn description]
	 * 增加分类
	 */
	public function add_cloumn(){
		$this->view();
	}
	/**
	 * [up_date description]
	 * @return [type] [description]
	 * 修改
	 */
	public function up_date(){
		$row=M('curriculum_theme')->find($_GET['id']);
		$this->assign('row',$row);
		$this->view();
	}
}