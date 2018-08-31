<?php
namespace Api\Controller;
use Think\Controller;
/**
* 站内消息通知 api
*/
class RemindController extends Controller
{
	function __construct()
	{
		parent::__construct();
        $this->RemindLogic = D('Remind/Remind','Logic');
	}
	/**
	 * [Remind_list description]
	 * @return [type] [description]
	 * 站内信息列表
	 */
	public function remind_list(){
		$sql['id'] = 1;
		$page = I('page') ? $page : 1;
		$limit = I('limit') ? $limit : 10;
		$order = I('order') ? $order : 'id DESC';
		$rtn = $this->RemindLogic->remind_list($sql, $page, $limit, $order);
		if($rtn === false){
			$rtn = $this->RemindLogic->getError();
		}
		$this->ajaxReturn($rtn);
	}
}