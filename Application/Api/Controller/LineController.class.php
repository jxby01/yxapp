<?php
namespace Api\Controller;
use Think\Controller;
/**
* 路线api
*/
class LineController extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->LineLogic = D('Line/Line','Logic');
	}
	/**
	 * [line_list description]
	 * @return [type] [description]
	 * 新闻列表
	 */
	public function line_list(){
		$page = I('page') ? I('page') : 1;
		$limit = I('limit') ? I('limit') : 10;
		$order = I('order') ? I('order') : 'sort DESC';
		$sql['state'] = I('state') ? I('state') : 1;
		$rtn = $this->LineLogic->line_list($sql, $page, $limit, $order);
		if($rtn===false){
			$rtn = $this->LineLogic->getError();
		}
		$this->ajaxReturn($rtn);
	}
}