<?php
namespace Api\Controller;
use Think\Controller;
/**
* 课程api
*/
class CourseController extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->CourseLogic = D('Course/Course','Logic');
	}
	/**
	 * [course_list description]
	 * @return [type] [description]
	 * 课程列表
	 */
	public function course_list(){
		$page = I('page') ? $page : 1;
		$limit = I('limit') ? $limit : 10;
		$order = I('order') ? $order : 'id DESC';
		$rtn = $this->CourseLogic->course_list($page, $limit, $order);
		if($rtn===false){
			$rtn = $this->CourseLogic->getError();
		}
		$this->ajaxReturn($rtn);
	}
}