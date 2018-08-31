<?php
namespace Resume\Logic;
class ResumeLogic{
	public function __construct(){
		$this->ResumeLists = M('resume');
	}
	/**
	 * [resume_list description]
	 * @param  [type] $sql   [description] 查询sql数组
	 * @return [type]        [description]
	 */
	public function resume_list($sql){
		$rtn = $this->ResumeLists->where($this->logic_sql($sql))->find();
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
		if($sql){
			$new_sql['id'] = $sql['id'];
		}
		return $new_sql;
	}
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->ResumeLists->where($sql)->count();
	}
}