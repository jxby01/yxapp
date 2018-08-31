<?php
namespace Api\Controller;
use Think\Controller;
/**
* 辅导员 简历 api
*/
class ResumeController extends Controller
{
	function __construct()
	{
		parent::__construct();
        $this->ResumeLogic = D('Resume/Resume','Logic');
	}
	/**
	 * [resume_list description]
	 * @return [type] [description]
	 * 辅导员简历
	 */
	public function resume_list(){
		$sql['id'] = I('id');
		$rtn = $this->ResumeLogic->resume_list($sql);
		if($rtn === false){
			$rtn = $this->ResumeLogic->getError();
		}
		$this->ajaxReturn($rtn);
	}
}