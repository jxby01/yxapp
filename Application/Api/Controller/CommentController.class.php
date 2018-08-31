<?php
namespace Api\Controller;
use Think\Controller;
/**
* 用户api
*/
class CommentController extends Controller
{
	function __construct()
	{
		parent::__construct();
        $this->CommentLogic = D('Comment/Comment','Logic');
	}
	/**
	 * [comment_list description]
	 * @return [type] [description]
	 * 评论列表
	 */
	public function comment_list(){
		$page = I('page') ? I('page') : 1;
		$limit = I('limit') ? I('limit') : 10;
		$sql['line_id'] = 1;
		$rtn = $this->CommentLogic->comment_list($sql, $page, $limit, $order);
		var_dump($rtn);
	}
}