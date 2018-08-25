<?php
namespace Admin\Controller;
use Think\Controller;
class LineController extends CommonController {
	//线路列表
    public function line(){
    	$row=M('line')->select();
    	foreach ($row as $key => $value) {
    		$director=M('user')->find($value['user_id']);
    		$row[$key]['director']=$director['username'];
    		$guide=M('user')->find($value['guide']);
    		$row[$key]['guide']=$guide['username'];
    		$curriculum=M('curriculum')->find($value['curriculum_id']);
    		$row[$key]['curriculum']=$curriculum['name'];
    	}
    	$school = M('school')->select();
    	$curriculum=M('curriculum')->select();
    	$guide = M('user')->where(array('role'=>'4','state'=>1))->select();
    	$num=count($row);
    	$this->assign('school',$school);
    	$this->assign('guide',$guide);
    	$this->assign('curriculum',$curriculum);
    	$this->assign('row',$row);
    	$this->assign('num',$num);
		$this->view();
	}
	/**
	 * [screen description]
	 * @return [type] [description]
	 * 筛选
	 */
	public function screen(){
		if($_POST['star_time']){
			$where['star_time']=$_POST['star_time'];
		}
		if($_POST['guide']){
			$where['guide']=$_POST['guide'];
		}
		if($_POST['grade']){
			$where['grade']=$_POST['grade'];
		}
		if($_POST['school']){
			$where['school']=$_POST['school'];
		}
		if($_POST['curriculum_id']){
			$where['curriculum_id']=$_POST['curriculum_id'];
		}
		$row=M('line')->where($where)->select();
		foreach ($row as $key => $value) {
    		$director=M('user')->find($value['user_id']);
    		$row[$key]['director']=$director['username'];
    		$guide=M('user')->find($value['guide']);
    		$row[$key]['guide']=$guide['username'];
    		$curriculum=M('curriculum')->find($value['curriculum_id']);
    		$row[$key]['curriculum']=$curriculum['name'];
    	}
    	$school = M('school')->select();
    	$curriculum=M('curriculum')->select();
    	$guide = M('user')->where(array('role'=>'4','state'=>1))->select();
    	$num=count($row);
    	$this->assign('school',$school);
    	$this->assign('guide',$guide);
    	$this->assign('curriculum',$curriculum);
    	$this->assign('num',$num);
    	$this->assign('row',$row);
		$this->view('line');
	}
	/**
	 * [search description]
	 * @return [type] [description]
	 * 搜索
	 */
	public function search(){
		if(!$_POST['content']){
			alert('请输入搜索线路名称',2000,2);exit;
		}
		$row=M('line')->where("name title like '%".$_POST['content']."%'")->select();
		foreach ($row as $key => $value) {
    		$director=M('user')->find($value['user_id']);
    		$row[$key]['director']=$director['username'];
    		$guide=M('user')->find($value['guide']);
    		$row[$key]['guide']=$guide['username'];
    		$curriculum=M('curriculum')->find($value['curriculum_id']);
    		$row[$key]['curriculum']=$curriculum['name'];
    	}
    	$school = M('school')->select();
    	$curriculum=M('curriculum')->select();
    	$guide = M('user')->where(array('role'=>'4','state'=>1))->select();
    	$num=count($row);
    	$this->assign('school',$school);
    	$this->assign('guide',$guide);
    	$this->assign('curriculum',$curriculum);
    	$this->assign('num',$num);
    	$this->assign('row',$row);
		$this->view('line');
	}
	//添加线路
	public function add_line(){
		$curriculum=M('curriculum')->select();
		$guide = M('user')->where(array('role'=>'4','state'=>1))->select();
		$school = M('school')->select();
		$this->assign('school',$school);
		$this->assign('guide',$guide);
		$this->assign('curriculum',$curriculum);
       	$this->view();
	}
	/**
	 * [update_line description]
	 * @return [type] [description]
	 * 修改路线
	 */
	public function update_line(){
		$row=M('line')->find($_GET['id']);
		$curriculum=M('curriculum')->select();
		$guide = M('user')->where(array('role'=>'4','state'=>1))->select();
		$school = M('school')->select();
		$this->assign('school',$school);
		$this->assign('guide',$guide);
		$this->assign('curriculum',$curriculum);
		$this->assign('row',$row);
		$this->view();
	}
	//线路删除
	public function del(){
		$data['id'] = I('id');
		$vo = M('line')->where($data)->delete();
		if($vo){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}
	//批量删除线路
    public function all_del(){
    	$id = explode(',',I('id'));
    	$whe['id']=array('in',$id);
		$vi = M('line')->where($whe)->delete();
		if($vi){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
    }
    //生成添加线路
    public function addline(){
    	$_POST['add_time']=time();
    	if(!$_POST['name']){
    		alert('请输入线路名称','3000',2);
    		exit;
    	}
    	if(!$_POST['set_address']){
    		alert('请输入出发地','3000',2);
    		exit;
    	}
    	if(!$_POST['address']){
    		alert('请输入目的地','3000',2);
    		exit;
    	}
    	if(!$_POST['star_time']){
    		alert('请输入出发时间','3000',2);
    		exit;
    	}
    	if(!$_POST['this_time']){
    		alert('请输入项目时间','3000',2);
    		exit;
    	}
    	if(!$_POST['curriculum_id']){
    		alert('请选择课程','3000',2);
    		exit;
    	}
    	if(!$_POST['tote']){
    		alert('请输入路线团队人数','3000',2);
    		exit;
    	}
    	if(!$_POST['img']){
    		alert('请选择路线图','3000',2);
    		exit;
    	}
    	$rtn = M('line')->add($_POST);
    	if($rtn){
    		$this->success('生成路线成功',U('Line/line'));
    	}else{
    		alert('生成路线失败','3000',2);
    	}
    }
    /**
     * [up_date description]
     * @return [type] [description]
     * 修改
     */
    public function up_date(){
    	$_POST['add_time']=time();
    	if(!$_POST['name']){
    		alert('请输入线路名称','3000',2);
    		exit;
    	}
    	if(!$_POST['set_address']){
    		alert('请输入出发地','3000',2);
    		exit;
    	}
    	if(!$_POST['address']){
    		alert('请输入目的地','3000',2);
    		exit;
    	}
    	if(!$_POST['star_time']){
    		alert('请输入出发时间','3000',2);
    		exit;
    	}
    	if(!$_POST['this_time']){
    		alert('请输入项目时间','3000',2);
    		exit;
    	}
    	if(!$_POST['curriculum_id']){
    		alert('请选择课程','3000',2);
    		exit;
    	}
    	if(!$_POST['tote']){
    		alert('请输入路线团队人数','3000',2);
    		exit;
    	}
    	if(!$_POST['img']){
    		alert('请选择路线图','3000',2);
    		exit;
    	}
    	$rtn = M('line')->where(array('id'=>$_GET['id']))->save($_POST);
    	if($rtn){
    		$this->success('修改路线成功',U('Line/line'));
    	}else{
    		alert('修改路线失败','3000',2);
    	}
    }
}