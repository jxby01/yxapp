<?php
namespace Course\Logic;
class CourseLogic{
	public function __construct(){
		$this->CourseLists = M('curriculum');
	}
	/**
	 * [news_list description]
	 * @param  [type] $sql   [description] 查询sql数组
	 * @param  [type] $page  [description] 页码
	 * @param  [type] $limit [description] 偏移量（每页的条数）
	 * @param  [type] $order [description] 查询排序
	 * @return [type]        [description]
	 */
	public function course_list($page, $limit, $order){
		// $page = $page ? $page : 1;
		// $limit = $limit ? $limit : 10;
		// $order = $order ? $order : 'sort DESC';
		$rtn = $this->CourseLists->order($order)->page($page)->limit($limit)->select();
		if(!$rtn){
			$this->error = '没有更多数据';
			return false;
		}
		$result['lists'] = $rtn;
		$result['code']  = 1;
		$result['mags']  = '读取成功';
		return $result;
	}
	/**
	 * [logic_sql description]
	 * @param  [type] $sql [description] sql条件数组
	 * @return [type]      [description]
	 * sql条件重组
	 */
	/*public function logic_sql($sql){
		$new_sql=array();
		if($sql['tel']){
			$new_sql['tel'] = $sql['tel'];
		}
		if($sql['pass']){
			$new_sql['password'] = $sql['pass'];
		}
		return $new_sql;
	}*/
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->CourseLists->where($sql)->count();
	}
}