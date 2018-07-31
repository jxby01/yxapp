<?php
namespace Admin\Controller;
use Think\Controller;
class LineController extends CommonController {
	//线路列表
    public function line(){
    	I('name')?$condition['name'] = array('like','%'.I('name').'%'):false;
    	I('set_time')?$condition['set_time'] = strtotime(I('set_time')):false;
    	I('resume_id')?$condition['resume_id'] = I('resume_id'):false;
    	I('line_cloumn_id')?$condition['line_cloumn_id'] = I('line_cloumn_id'):false;
    	$p=I('p') ? I('p'):1;
		$line = M('line')->where($condition)->page($p,'5')->order('id desc')->select();
		foreach($line as $k=>$v){
			$line[$k]['set_time'] = date('Y-m-d H:i:s',$v['set_time']);
			$resume_id['id'] = $v['resume_id'];
			$line[$k]['resume_id'] = M('user')->where($resume_id)->getField('username');
			$line_cloumn_id['id'] = $v['line_cloumn_id'];
			$line[$k]['title'] = M('line_cloumn')->where($line_cloumn_id)->getField('title');
		}
		$num = M('line')->where($condition)->order('id desc')->count();
    	$Page       = new \Think\Page($num,5);// 实例化分页类 传入总记录数和每页显示的记录数
    	//保持搜索条件分页
    	$Page->parameter   =   array("name"=>I('name'),"set_time"=>strtotime(I('set_time')),"resume_id"=>I('resume_id'),"line_cloumn_id"=>I('line_cloumn_id'));
    	
    	$show       = $Page->show();// 分页显示输出
    	$ba = M('line_cloumn')->select();
		$user = M('user')->where("role=4")->select();
		$this->assign('base',$ba);
		$this->assign('user',$user);
    	
    	$this->assign('page',$show);
    	$this->assign('num',$num);
		$this->assign('line',$line);
		$this->view();
	}
	//线路主题列表
	public function line_details(){
		$p=I('p') ? I('p'):1;
		$fenl = M('line_cloumn')->page($p,'5')->order('id desc')->select();
		$num = M('line_cloumn')->order('id desc')->count();
    	$Page       = new \Think\Page($num,5);// 实例化分页类 传入总记录数和每页显示的记录数
		
    	$show       = $Page->show();// 分页显示输出
    	$this->assign('page',$show);
    	$this->assign('num',$num);
		$this->assign('fenl',$fenl);
	    $this->view();
	}
	//添加线路
	public function add_line(){
		$vi = I('vi');
    	$id = I('id');
    	if($vi==2){
    		$news = M('line')->where("id=$id")->find();
    		$news['set_time'] = date('Y-m-d H:i:s',$news['set_time']);
    		$this->assign('news',$news);
    	}
		$ba = M('line_cloumn')->select();
		$user = M('user')->where("role=4")->select();
		$this->assign('base',$ba);
		$this->assign('user',$user);
		$this->assign('vi',$vi);
       	$this->view();
	}
	//添加线路主题
	public function add_linedetails(){
		$bi = I('bi');
		if($bi==2){
			$id['id'] = I('id');
			$ba = M('line_cloumn')->where($id)->find();
			$this->assign('ba',$ba);
		}
		$this->assign('bi',$bi);
	    $this->view();
	}
	public function addzhuti(){
		$bi = I('bi');
		$data['title'] = I('title');
		$data['content'] = I('content');
		if($bi==1){
			if($data['title']==''){
				$this->error('添加失败,请填写主题名称！');
			}else if($data['content']==''){
				$this->error('添加失败,请填写主题介绍！');
			}else{
				M('line_cloumn')->add($data);
		    	$this->success('添加成功', '/Admin/line/line_details');
			}
		}else{
			$bid['id'] = I('id');
			if($data['title']==''){
				$this->error('修改失败,请填写主题名称！');
			}else if($data['content']==''){
				$this->error('修改失败,请填写主题介绍！');
			}else{
				M('line_cloumn')->where($bid)->save($data);
		    	$this->success('修改成功', '/Admin/line/line_details');
			}
		}
	}
	//线路主题删除
	public function shancsp(){
		$data['id'] = I('id');
		$vo = M('line_cloumn')->where($data)->delete();
		if($vo){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}
	
	//批量删除线路主题
    public function plshanc(){
    	$id = explode(',',I('id')); 
		foreach($id as $v){
			$vid['id'] = $v;
			$vi = M('line_cloumn')->where($vid)->delete();
		}
		if($vi){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
    }
    //线路删除
	public function shanxianlu(){
		$data['id'] = I('id');
		$vo = M('line')->where($data)->delete();
		if($vo){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}
	//批量删除线路
	public function plshancxianlu(){
		$id = explode(',',I('id')); 
		foreach($id as $v){
			$vid['id'] = $v;
			$vi = M('line')->where($vid)->delete();
		}
		if($vi){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}
    public function addline(){
    	$vi = I('vi');
		$data['name'] = I('name');
		$data['set_address'] = I('set_address');
		$data['mud_address'] = I('mud_address');
		$data['set_time'] = strtotime(I('set_time'));
		$data['this_time'] = I('this_time');
		$data['line_cloumn_id'] = I('line_cloumn_id');
		$data['resume_id'] = I('resume_id');
		$data['img'] = I('img');
		$data['courses_provide'] = $_POST['courses_provide'];
		$data['courses_item'] = $_POST['courses_item'];
		$data['courses_plan'] = $_POST['courses_plan'];
		if($vi==1){
			if($data['name']==''){
				$this->error('添加失败,请输入线路名称！');
			}else if($data['set_address']==''){
				$this->error('添加失败,请输入出发地！');
			}else if($data['mud_address']==''){
				$this->error('添加失败,请输入目的地！');
			}else if($data['set_time']==''){
				$this->error('添加失败,请选择出发时间！');
			}else if($data['this_time']==''){
				$this->error('添加失败,请输入项目时间！');
			}else if($data['line_cloumn_id']==''){
				$this->error('添加失败,请选择线路主题！');
			}else if($data['resume_id']==''){
				$this->error('添加失败,请选择辅导员！');
			}else if($data['img']==''){
				$this->error('添加失败,请上传线路图！');
			}else if($data['courses_provide']==''){
				$this->error('添加失败,请填写课程简介！');
			}else if($data['courses_item']==''){
				$this->error('添加失败,请填写课程特色！');
			}else if($data['courses_plan']==''){
				$this->error('添加失败,请填写课程安排！');
			}else{
				M('line')->add($data);
		    	$this->success('添加成功', '/Admin/line/line');
			}
		}else{
			$bid['id'] = I('id');
			if($data['name']==''){
				$this->error('添加失败,请输入线路名称！');
			}else if($data['set_address']==''){
				$this->error('添加失败,请输入出发地！');
			}else if($data['mud_address']==''){
				$this->error('添加失败,请输入目的地！');
			}else if($data['set_time']==''){
				$this->error('添加失败,请选择出发时间！');
			}else if($data['this_time']==''){
				$this->error('添加失败,请输入项目时间！');
			}else if($data['line_cloumn_id']==''){
				$this->error('添加失败,请选择线路主题！');
			}else if($data['resume_id']==''){
				$this->error('添加失败,请选择辅导员！');
			}else if($data['img']==''){
				$this->error('添加失败,请上传线路图！');
			}else if($data['courses_provide']==''){
				$this->error('添加失败,请填写课程简介！');
			}else if($data['courses_item']==''){
				$this->error('添加失败,请填写课程特色！');
			}else if($data['courses_plan']==''){
				$this->error('添加失败,请填写课程安排！');
			}else{
				M('line')->where($bid)->save($data);
		    	$this->success('修改成功', '/Admin/line/line');
			}
		}
    }
}