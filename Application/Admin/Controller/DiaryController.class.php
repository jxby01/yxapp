<?php
namespace Admin\Controller;
use Think\Controller;
class DiaryController extends CommonController {
    public function diary(){
//  	I('title')?$condition['title'] = array('like','%'.I('title').'%'):false;
//  	I('classify')?$condition['classify'] = array('like','%'.I('classify').'%'):false;
    	$diary = M('diary')->page($p,'10')->order('id desc')->select();
    	foreach($diary as $k=>$v){
    		if($v['recommend']==0){
    			$diary[$k]['laoshi'] = '否';
    		}else{
    			$diary[$k]['laoshi'] = '是';
    		}
    		if($v['home_page']==0){
    			$diary[$k]['shouye'] = '推荐首页';
    		}else{
    			$diary[$k]['shouye'] = '取消推荐';
    		}
    	}
    	$num = M('diary')->order('id desc')->count();
    	$Page       = new \Think\Page($num,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);
    	$this->assign('diary',$diary);
    	$this->assign('num',$num);
       	$this->view();
    }
    //推荐首页修改
    public function syxiugai(){
    	$did['id'] = I('did');
    	$ho = I('ho');
    	if($ho==0){
    		$data['home_page'] = 1;
    		$data['hp_time'] = time();
    		$res = M('diary')->where($did)->save($data);
    	}else{
    		$data['home_page'] = 0;
    		$data['hp_time'] = '';
    		$res = M('diary')->where($did)->save($data);
    	}
    	if($res){
    		$this->ajaxReturn(1);
    	}else{
    		$this->ajaxReturn(2);
    	}
    }
    //优秀日记修改
    public function yxxiugai(){
    	$did['id'] = I('did');
    	$ex = I('ex');
    	if($ex==0){
    		$data['excellent'] = 1;
    		$res = M('diary')->where($did)->save($data);
    	}else{
    		$data['excellent'] = 0;
    		$res = M('diary')->where($did)->save($data);
    	}
    	if($res){
    		$this->ajaxReturn(1);
    	}else{
    		$this->ajaxReturn(2);
    	}
    }
    //删除日记
    public function shancsp(){
    	$id['id'] = I('id');
    	$vo = M('diary')->where($id)->delete();
		if($vo){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
    }
    //批量删除
    public function plshanc(){
    	$id = explode(',',I('id')); 
		foreach($id as $v){
			$vid['id'] = $v;
			$vi = M('diary')->where($vid)->delete();
		}
		if($vi){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
    }
    public function diary_details(){
    	$did['id'] = I("did");
    	$di = M('diary')->where($did)->find();
    	$di['add_time'] = date('Y-m-d H:i',$div['add_time']);
    	if($di['recommend']==0){
    		$di['recommend'] = '否';
    	}else{
    		$di['recommend'] = '是';
    	}
    	if($di['home_page']==0){
    		$di['home_page'] = '否';
    	}else{
    		$di['home_page'] = '是';
    	}
    	if($di['excellent']==0){
    		$di['excellent'] = '否';
    	}else{
    		$di['excellent'] = '是';
    	}
    	$this->assign('di',$di);
    	$this->view();
    }
}