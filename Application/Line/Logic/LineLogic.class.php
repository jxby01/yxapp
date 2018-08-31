<?php
namespace Line\Logic;
class LineLogic{
	public function __construct(){
		$this->LineLists = M('line');
	}
	/**
	 * [line_list description]
	 * @param  [type] $sql   [description] 查询sql数组
	 * @param  [type] $page  [description] 页码
	 * @param  [type] $limit [description] 偏移量（每页的条数）
	 * @param  [type] $order [description] 查询排序
	 * @return [type]        [description]
	 */
	public function line_list($sql, $page, $limit, $order){
		// $page = $page ? $page : 1;
		// $limit = $limit ? $limit : 10;
		// $order = $order ? $order : 'sort DESC';
		$rtn = $this->LineLists->where($this->logic_sql($sql))->order($order)->page($page)->limit($limit)->select();
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
	public function logic_sql($sql){
		$new_sql=array();
		if($sql['state']==1){ //正在进行的路线
			$new_sql['star_time'] = array('lt',time());
			$new_sql['end_time'] = array('gt',time());
		}
		if($sql['state']==2){ //即将进行的路线
			$new_sql['star_time'] = array('gt',time());
		}
		if($sql['state']==3){ //已经结束的路线
			$new_sql['end_time'] = array('lt',time());
		}
		return $new_sql;
	}
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->LineLists->where($sql)->count();
	}
}