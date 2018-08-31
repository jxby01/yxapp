<?php
namespace Api\Controller;
use Think\Controller;
/**
* 用户api
*/
class UserController extends Controller
{
	function __construct()
	{
		parent::__construct();
        $this->UserLogic = D('User/User','Logic');
	}
	/**
	 * [news_list description]
	 * @return [type] [description]
	 * 新闻列表
	 */
	public function user_list(){
		$sql['id'] = I('id');
		// $sql['openid'] = I('openid');
		$rtn = $this->UserLogic->user_list($sql, $page, $limit, $order);
		if($rtn===false){
			$rtn = $this->UserLogic->getError();
		}
		$this->ajaxReturn($rtn);
	}
}