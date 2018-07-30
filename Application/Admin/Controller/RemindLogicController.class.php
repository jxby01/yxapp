<?php
namespace Admin\Controller;
use Think\Controller;
class RemindLogicController extends CommonController {
   /**
    * 站内信息公告提醒--逻辑层控制器
    */
   public function add(){
      $_POST['start_time']=time();
      M('remind')->add($_POST);
      $this->success('发布成功',U("Remind/remind_list"),2);
   }
   /**
    * [del description]
    * @return [type] [description]
    * 单条删除
    */
   public function del(){
      echo M('remind')->delete($_POST['id']);
   }
   /**
    * [all_del description]
    * @return [type] [description]
    * 多条删除
    */
   public function all_del(){
      $whe['id']=array('in',$_POST['id']);
      echo M('remind')->where($whe)->delete();
   }
}