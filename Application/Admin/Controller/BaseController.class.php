<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends CommonController {
    public function base(){
    	I('title')?$condition['title'] = array('like','%'.I('title').'%'):false;
    	I('base_cloumn_id')?$condition['base_cloumn_id'] = I('base_cloumn_id'):false;
		$base = M('base')->where($condition)->page($p,'10')->order('base_id desc')->select();
		foreach($base as $k=>$v){
			$id['base_cloumn_id'] = $v['base_cloumn_id'];
			$base[$k]['name'] = M('base_cloumn')->where($id)->getField('name');
		}
		$clo = M('base_cloumn')->select();
		$num = M('base')->where($condition)->order('base_id desc')->count();
    	$Page       = new \Think\Page($num,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	//保持搜索条件分页
    	$Page->parameter   =   array("title"=>I('title'),"base_cloumn_id"=>I('base_cloumn_id'));
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);
		$this->assign('clo',$clo);
		$this->assign('base',$base);
		$this->assign('num',$num);
       	$this->view();
    }
	
	public function add_base(){
		$vi = I('vi');
    	$id = I('id');
    	if($vi==2){
    		$base = M('base')->where("base_id=$id")->find();
    		$this->assign('ba',$base);
    	}
		$ba = M('base_cloumn')->select();
		$this->assign('base',$ba);
		$this->assign('vi',$vi);
       	$this->view();
	}
	//基地添加，修改
	public function tianjiajid(){
		$vi = I('vi');
		$data['title'] = I('title');
		$data['img'] = I('img');
		$data['content'] = I('content');
		$data['base_cloumn_id'] = I('base_cloumn_id');
		$data['admin_id'] = $_SESSION['admin_id'];
		if($vi==1){
			if($data['title']==''){
				$this->error('添加失败,请填写名称！');
			}else if($data['img']==''){
				$this->error('添加失败,请选择分类图！');
			}else if($data['content']==''){
				$this->error('添加失败,请填写介绍！');
			}else if($data['base_cloumn_id']==''){
				$this->error('添加失败,请选择分类！');
			}else{
				M('base')->add($data);
		    	$this->success('添加成功', '/Admin/base/base');
			}
		}else{
			$bid['base_id'] = I('id');
			if($data['title']==''){
				$this->error('修改失败,请填写名称！');
			}else if($data['img']==''){
				$this->error('修改失败,请选择分类图！');
			}else if($data['content']==''){
				$this->error('修改失败,请填写介绍！');
			}else if($data['base_cloumn_id']==''){
				$this->error('修改失败,请选择分类！');
			}else{
				M('base')->where($bid)->save($data);
		    	$this->success('修改成功', '/Admin/base/base');
			}
		}
		
	}
	public function base_details(){
		I('name')?$condition['name'] = array('like','%'.I('name').'%'):false;
		$p=I('p') ? I('p'):1;
		$fenl = M('base_cloumn')->where($condition)->page($p,'5')->order('base_cloumn_id desc')->select();
		foreach($fenl as $k=>$v){
			$admin['admin_id'] = $v['admin_id'];
			$fenl[$k]['ad_name'] = M('admin')->where($admin)->getField('admin_name');
		}
		$num = M('base_cloumn')->where($condition)->order('base_cloumn_id desc')->count();
    	$Page       = new \Think\Page($num,5);// 实例化分页类 传入总记录数和每页显示的记录数
      	//分页跳转的时候保证查询条件
      	$Page->parameter['name']   =   I('name');

    	$show       = $Page->show();// 分页显示输出
    	$this->assign('page',$show);
    	$this->assign('num',$num);
		$this->assign('fenl',$fenl);
	    $this->view();
	}
	public function add_basefenl(){
		$bi = I('bi');
		if($bi==2){
			$id['base_cloumn_id'] = I('id');
			$ba = M('base_cloumn')->where($id)->find();
			$this->assign('ba',$ba);
		}
		$this->assign('bi',$bi);
	    $this->view();
	}
	//基地分类添加，修改
	public function tianjiafenl(){
		$bi = I('bi');
		$data['name'] = I('name');
		$data['img'] = I('img');
		$data['admin_id'] = $_SESSION['admin_id'];
		$data['describe'] = I('describe');
		if($bi==1){
			if($data['name']==''){
				$this->error('添加失败,请填写分类名称！');
			}else if($data['img']==''){
				$this->error('添加失败,请选择分类图！');
			}else if($data['describe']==''){
				$this->error('添加失败,请填写分类描述！');
			}else{
				M('base_cloumn')->add($data);
		    	$this->success('添加成功', '/Admin/base/base_details');
			}
		}else{
			$bid['base_cloumn_id'] = I('id');
			if($data['name']==''){
				$this->error('修改失败,请填写分类名称！');
			}else if($data['img']==''){
				$this->error('修改失败,请选择分类图！');
			}else if($data['describe']==''){
				$this->error('修改失败,请填写分类描述！');
			}else{
				M('base_cloumn')->where($bid)->save($data);
		    	$this->success('修改成功', '/Admin/base/base_details');
			}
		}
		
	}
	//删除基地信息
	public function shanjidi(){
		$data['base_id'] = I('id');
		$vo = M('base')->where($data)->delete();
		if($vo){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}
	//删除基地分类信息
	public function shancsp(){
		$data['base_cloumn_id'] = I('id');
		$vo = M('base_cloumn')->where($data)->delete();
		if($vo){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}
	//批量删除基地
    public function plshancjidi(){
    	$id = explode(',',I('id')); 
		foreach($id as $v){
			$vid['base_id'] = $v;
			$vi = M('base')->where($vid)->delete();
		}
		if($vi){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
    }
	//批量删除基地分类
    public function plshanc(){
    	$id = explode(',',I('id')); 
		foreach($id as $v){
			$vid['base_cloumn_id'] = $v;
			$vi = M('base_cloumn')->where($vid)->delete();
		}
		if($vi){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
    }
}