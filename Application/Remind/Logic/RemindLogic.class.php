<?php
namespace Remind\Logic;
class RemindLogic{
	public function __construct(){
		$this->RemindLists = M('remind');
	}
	/**
	 * [remind_list description]
	 * @param  [type] $sql   [description] 查询sql数组
	 * @return [type]        [description] 
	 */
	public function remind_list($sql, $page, $limit, $order){
		$rtn = $this->RemindLists->where($this->logic_sql($sql))->page($page)->limit($limit)->order($order)->select();
		if(!$rtn){
			$this->error = '没有更多的数据';
			return false;
		}else{
			foreach ($rtn as $key => $value) {
				if(in_array($sql['id'],$value['read'])){
					$rtn[$key]['read_to'] = -1; //已读
				}else{
					$rtn[$key]['read_to'] = 1; //未读
				}
			}
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
		$new_sql['user_id'] = 'all';
		if($sql['id']){
			$new_sql['user_id'] = array(array('eq','all'),array('eq',$sql['id']),'or');
		}
		return $new_sql;
	}
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->RemindLists->where($sql)->count();
	}
}