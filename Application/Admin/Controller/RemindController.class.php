<?php
namespace Admin\Controller;
use Think\Controller;
class RemindController extends CommonController {
   /**
    * 站内信息公告提醒--控制器
    */
   /**
    * [remind_list description]
    * @return [type] [description]
    * 公告发布列表
    */
   public function remind_list(){
        $row=M('remind')->select();
        $count=M('remind')->count();
        $this->assign('count',$count);
        $this->assign('row',$row);
        $this->view();
   }
   /***/
   public function remind_add(){
    $this->view();
   }
}