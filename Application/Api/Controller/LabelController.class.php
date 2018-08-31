<?php
namespace Api\Controller;
use Think\Controller;
/**
* 标签api
*/
class LabelController extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->LabelLogic = D('Label/Label','Logic');
	}
	/**
	 * [label_list description]
	 * @return [type] [description]
	 * 新闻列表
	 */
	public function label_list(){
		$sql['grade'] = I('grade');
		$rtn = $this->LabelLogic->label_list($sql);
		if($rtn===false){
			$rtn = $this->LabelLogic->getError();
		}
		$this->ajaxReturn($rtn);
	}
}