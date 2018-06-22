<?php
namespace Admin\Controller;
use Think\Controller;
class DiaryController extends CommonController {
    public function diary(){
    	I('diary_title')?$condition['diary_title'] = array('like','%'.I('diary_title').'%'):false;
    	I('username')?$condition['username'] = array('like','%'.I('username').'%'):false;
    	I('home_page')?$condition['home_page'] = I('home_page'):false;
    	$condition['recommend'] = 2;
    	$p=I('p') ? I('p'):1;
    	$diary = M('diary')->where($condition)->page($p,'10')->order('zan desc')->select();
    	foreach($diary as $k=>$v){
    		if($v['home_page']==1){
    			$diary[$k]['shouye'] = '推荐首页';
    		}else{
    			$diary[$k]['shouye'] = '取消推荐';
    		}
    	}
    	$zan_time = M('diary_zan')->where("id=1")->find();
    	$zan_time['start_time'] = date('Y-m-d',$zan_time['start_time']);
    	$zan_time['end_time'] = date('Y-m-d',$zan_time['end_time']);
    	
    	$num = M('diary')->where($condition)->order('zan desc')->count();
    	$Page       = new \Think\Page($num,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	//保持搜索条件分页
    	$Page->parameter   =   array("diary_title"=>I('diary_title'),"username"=>I('username'),"home_page"=>I('home_page'),"recommend"=>"2");
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);
    	$this->assign('diary',$diary);
    	$this->assign('num',$num);
    	$this->assign('zan_time',$zan_time);
       	$this->view();
    }
    //推荐首页修改
    public function syxiugai(){
    	$did['id'] = I('did');
    	$ho = I('ho');
    	if($ho==1){
    		$data['home_page'] = 2;
    		$data['hp_time'] = time();
    		$res = M('diary')->where($did)->save($data);
    	}else{
    		$data['home_page'] = 1;
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
    	if($ex==1){
    		$data['excellent'] = 2;
    		$res = M('diary')->where($did)->save($data);
    	}else{
    		$data['excellent'] = 1;
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
    	if($di['recommend']==1){
    		$di['recommend'] = '否';
    	}else{
    		$di['recommend'] = '是';
    	}
    	if($di['home_page']==1){
    		$di['home_page'] = '否';
    	}else{
    		$di['home_page'] = '是';
    	}
    	if($di['excellent']==1){
    		$di['excellent'] = '否';
    	}else{
    		$di['excellent'] = '是';
    	}
    	$this->assign('di',$di);
    	$this->view();
    }
    public function time_diary(){
    	$data['start_time'] = strtotime(I('start_time'));
    	$data['end_time'] = strtotime(I('end_time'));
    	if($data['start_time']==''){
    		$this->error('设置失败,请选择开始时间！');
    	}else if($data['end_time']==''){
    		$this->error('设置失败,请选择结束时间！');
    	}else if($data['start_time']>$data['end_time']){
    		$this->error('设置失败,开始时间不能大于结束时间！');
    	}else{
    		$zan = M('diary_zan')->where("id=1")->save($data);
    		if($zan){
    			$this->success('设置成功', '/Admin/Diary/diary');
    		}else{
    			$this->error('设置失败！');
    		}
    		
    	}
    }
}