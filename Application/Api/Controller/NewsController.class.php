<?php
namespace Api\Controller;
use Think\Controller;
/**
* 新闻中心api
*/
class NewsController extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->NewsLogic = D('News/News','Logic');
	}
	/**
	 * [news_list description]
	 * @return [type] [description]
	 * 新闻列表
	 */
	public function news_list(){
		$page = I('page') ? $page : 1;
		$limit = I('limit') ? $limit : 10;
		$order = I('order') ? $order : 'sort DESC';
		$rtn = $this->NewsLogic->news_list($page, $limit, $order);
		if($rtn===false){
			$rtn = $this->NewsLogic->getError();
		}
		$this->ajaxReturn($rtn);
	}
}