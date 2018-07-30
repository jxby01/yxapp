<?php
namespace Admin\Controller;
use Think\Controller;
class LineController extends CommonController {
	//线路列表
    public function line(){
    	
		$this->view();
	}
	//线路主题列表
	public function line_details(){
		
		$this->view();
	}
	//添加线路
	public function add_line(){
		
		$this->view();
	}
	//添加线路主题
	public function add_linedetails(){
		
		$this->view();
	}
}