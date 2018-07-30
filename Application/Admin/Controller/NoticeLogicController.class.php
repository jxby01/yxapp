<?php
namespace Admin\Controller;
use Think\Controller;
class NoticeLogicController extends CommonController {
    /**
     * 提醒通知--逻辑控制器
     */
    
    /**
     * [student description]
     * @return [type] [description]
     * 学生--出行提醒
     */
    public function student(){
        M('notice')->where(array('id'=>1))->save($_POST);
        $this->success('修改成功',U("Notice/student"),2);
    }
    /**
     * [instructor description]
     * @return [type] [description]
     * 辅导员--出行提醒
     */
    public function instructor(){
        M('notice')->where(array('id'=>2))->save($_POST);
        $this->success('修改成功',U("Notice/instructor"),2);
    }
    /**
     * [birthday description]
     * @return [type] [description]
     * 生日提醒
     */
    public function birthday(){
        M('notice')->where(array('id'=>3))->save($_POST);
        $this->success('修改成功',U("Notice/birthday"),2);
    }
    
}