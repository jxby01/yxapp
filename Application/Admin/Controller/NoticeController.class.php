<?php
namespace Admin\Controller;
use Think\Controller;
class NoticeController extends CommonController {
    /**
     * 提醒通知--控制器
     */
    
    /**
     * [student description]
     * @return [type] [description]
     * 学生--出行提醒
     */
    public function student(){
    	$row=M('notice')->find(1);
    	$this->assign('row',$row);
    	$this->view();
    }
    /**
     * [instructor description]
     * @return [type] [description]
     * 辅导员--出行提醒
     */
    public function instructor(){
		$row=M('notice')->find(2);
    	$this->assign('row',$row);
    	$this->view();
    }
    /**
     * [birthday description]
     * @return [type] [description]
     * 生日提醒
     */
    public function birthday(){
    	$row=M('notice')->find(3);
    	$this->assign('row',$row);
    	$this->view();
    }

}