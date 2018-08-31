<?php
namespace Comment\Logic;
class CommentLogic{
	public function __construct(){
		$this->Comment = M('line_evaluate');
		$this->User = M('user');
	}
	/**
	 * [comment_list description]
	 * @param  [type] $sql   [description] 查询sql
	 * @param  [type] $page  [description] 第几页
	 * @param  [type] $limit [description] 每页多少条
	 * @param  [type] $order [description] 排序方式
	 * @return [type]        [description]
	 * 查询评论对应路线
	 */
	public function comment_list($sql, $page, $limit, $order){
		$order = $order ? $order : 'a.id DESC';
		$rtn = $this->Comment->alias('a')->join('__USER__ u ON u.id = a.user_id')->where($sql)->field('a.*,u.username,u.img')->order($order)->page($page)->limit($limit)->select();
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
		
		return $new_sql;
	}
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->Comment->where($sql)->count();
	}
}