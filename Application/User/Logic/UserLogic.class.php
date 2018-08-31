<?php
namespace User\Logic;
class UserLogic{
	public function __construct(){
		$this->UserLists = M('user');
	}
	/**
	 * [line_list description]
	 * @param  [type] $sql   [description] 查询sql数组
	 * @param  [type] $page  [description] 页码
	 * @param  [type] $limit [description] 偏移量（每页的条数）
	 * @param  [type] $order [description] 查询排序
	 * @return [type]        [description]
	 */
	public function user_list($sql, $page, $limit, $order){
		// $page = $page ? $page : 1;
		// $limit = $limit ? $limit : 10;
		// $order = $order ? $order : 'sort DESC';
		$rtn = $this->UserLists->where($sql)->find();
		if(!$rtn){
			$this->error = '用户不存在';
			return false;
		}
		$result['suer'] = $rtn;
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
	public function logic_sql($sql){
		$new_sql=array();
		
		return $new_sql;
	}
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->UserLists->where($sql)->count();
	}
}