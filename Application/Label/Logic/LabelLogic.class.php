<?php
namespace Label\Logic;
class LabelLogic{
	public function __construct(){
		$this->LabelLists = M('label');
	}
	/**
	 * [line_list description]
	 * @param  [type] $sql   [description] 查询sql数组
	 * @return [type]        [description]
	 */
	public function label_list($sql){
		// $order = $order ? $order : 'sort DESC';
		$rtn = $this->LabelLists->where($sql)->select();
		if(!$rtn){
			$this->error = '读取失败，数据不存在';
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
		
		return $new_sql;
	}
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->LabelLists->where($sql)->count();
	}
}