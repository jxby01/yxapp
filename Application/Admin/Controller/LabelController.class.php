<?php
namespace Admin\Controller;
use Think\Controller;
class LabelController extends CommonController {
    /**
     * 标签管理--控制器
     */
    
    /**
     * [label_list description]
     * @return [type] [description]
     * 标签列表
     */
    public function label_list(){
    	if(IS_POST){
    		if($_POST['grade']==-1||!$_POST['grade']){
    		}else{
    			if($sql){
    				$sql .= " and grade='".$_POST['grade']."'";
    			}else{
    				$sql .= "grade='".$_POST['grade']."'";
    			}
    		}
    		if($_POST['content']){
    			$sql="title like '%".$_POST['content']."%'";
    		}
    	}
    	$school=M('school')->select();
    	$row=M('label')->where($sql)->select();
    	$count=count($row);
    	$this->assign('row',$row);
    	$this->assign('school',$school);
    	$this->assign('count',$count);
    	$this->view();
    }
    /**
     * [label_add description]
     * @return [type] [description]
     * 添加标签
     */
    public function label_add(){
    	$school=M('school')->select();
    	$this->assign('school',$school);
    	$this->view();
    }
    /**
     * [up_date description]
     * @return [type] [description]
     * 修改标签
     */
    public function up_date(){
    	$row=M('label')->find($_GET['id']);
    	$this->assign('row',$row);
    	$this->view();
    }
}