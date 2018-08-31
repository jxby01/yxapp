<?php
namespace Admin\Controller;
use Think\Controller;
class LabelLogicController extends CommonController {
    /**
     * 标签管理--逻辑层
     */
    
    /**
     * [label_add description]
     * @return [type] [description]
     * 添加标签
     */
    public function label_add(){
    	if($_POST['title']){
    		$row=M('label')->where($_POST)->find();
    		if($row){
    			alert('该标签在该年级已经存在',3000,2);
    			exit;
    		}
    		$_POST['time']=time();
    		$rtn = M('label')->add($_POST);
    		if($rtn){
    			$this->success('添加成功',U('Label/label_list'));
    		}else{
    			alert('添加失败',3000,2);
    		}
    	}else{
    		alert('请输入标签名',3000,2);
    	}
    }
    /**
     * [up_date description]
     * @return [type] [description]
     * 修改标签
     */
    public function up_date(){}
    /**
     * [del description]
     * @return [type] [description]
     * 删除标签---单删除
     */
    public function del(){
    	echo M('label')->delete($_POST['id']);
    }
    /**
     * [alldel description]
     * @return [type] [description]
     * 删除标签---多选删除
     */
    public function alldel(){
    	$all_id=$_POST['id'];
        $whe['id']=array('in',$all_id);
        $rtn=M('label')->where($whe)->delete();
        echo $rtn;
    }
}