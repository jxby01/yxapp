<?php
namespace Admin\Controller;
use Think\Controller;
class CourseLogicController extends CommonController {
	/**
	 * 课程管理--逻辑层--控制器
	 */
	
	/**
	 * [course_list description]
	 * @return [type] [description]
	 * 课程列表
	 */
	public function course_list(){
		
	}

	/**
	 * [add_course description]
	 * 添加课程
	 */
	public function add_course(){

	}
	/**
	 * [eit_course description]
	 * @return [type] [description]
	 * 修改课程
	 */
	public function eit_course(){
		
	}
	/**
	 * [get_label description]
	 * @return [type] [description]
	 * 获取对应年级的标签
	 */
	public function get_label(){
		$rtn = M('label')->where($_POST)->select();
		$this->ajaxReturn($rtn);
	}
	
}