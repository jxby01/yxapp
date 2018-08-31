<?php
namespace Admin\Controller;
use Think\Controller;
class CourseCloumnLogicController extends CommonController {
	/**
	 * 课程分类--逻辑层
	 */
	
	/**
	 * [add_cloumn description]
	 * 增加分类
	 */
	public function add_cloumn(){
		if($_POST['title']){
			if($_POST['content']){
				$rtn = M('curriculum_theme')->where(array('title'=>$_POST['title']))->find();
				if($rtn){
					alert('该主题以及存在',3000,2);
				}else{
					$row=M('curriculum_theme')->add($_POST);
					if($row){
						$this->success('添加成功',U('CourseCloumn/cloumn_list'));
					}else{
						alert('添加失败',3000,2);
					}
				}
			}else{
				alert('请输入主题内容',3000,2);
			}
		}else{
			alert('请输入主题名称',3000,2);
		}
	}
	/**
	 * [eit_cloumn description]
	 * @return [type] [description]
	 * 修改分类
	 */
	public function eit_cloumn(){
		$rtn = M('curriculum_theme')->where(array('id'=>$_GET['id']))->save($_POST);
		if($rtn){
			$this->success('修改成功',U('CourseCloumn/cloumn_list'));
		}else{
			alert('修改失败',3000,2);
		}
	}
	/**
	 * [del description]
	 * @return [type] [description]
	 * 单条删除
	 */
	public function del(){
		echo M('curriculum_theme')->delete($_POST['id']);
	}
	/**
	 * [alldel description]
	 * @return [type] [description]
	 * 多选删除
	 */
	public function alldel(){
		$all_id=$_POST['id'];
        $whe['id']=array('in',$all_id);
        $rtn=M('curriculum_theme')->where($whe)->delete();
        echo $rtn;
	}
	
}