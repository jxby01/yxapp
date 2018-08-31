<?php
namespace Admin\Controller;
use Think\Controller;
class CourseLogicController extends CommonController {
	/**
	 * 课程管理--逻辑层--控制器
	 */


	/**
	 * [add_course description]
	 * 添加课程
	 */
	public function add_course(){
		if(IS_AJAX){
			foreach($_FILES as $k=>$v){
				if($k=='img'){
					$fl=date("Ymd",time());
					mkdir('./Public/upload/course/'.$fl);
                    chmod('./Public/upload/course/'.$fl,0777);
                    //创建的文件夹路径
                    $file_path='./Public/upload/course/'.$fl.'/'.time();
                    $rtn = $this->upload($v['tmp_name'],$file_path,$v['name']);
                    if($rtn==-1){
                    	echo '图片上传失败，暂时只支持jpg,jpeg,gif,png';
                    	exit;
                    }else{
                    	$_POST['img']=$rtn;
                    }
				}else{
					$fl=date("Ymd",time());
					mkdir('./Public/upload/course/banner/'.$fl);
                    chmod('./Public/upload/course/banner/'.$fl,0777);
                    //创建的文件夹路径
                    $file_path='./Public/upload/course/banner/'.$fl.'/'.time().$k;
                    $rtn = $this->upload($v['tmp_name'],$file_path,$v['name']);
                    if($rtn==-1){
                    	echo '图片上传失败，暂时只支持jpg,jpeg,gif,png';
                    	exit;
                    }else{
                    	$banner[]=$rtn;
                    }
				}
			}
			$_POST['add_time']=time();
			$_POST['banner']=json_encode($banner);
			$result = M('curriculum')->add($_POST);
			if($result){
				echo '添加成功';
			}else{
				echo '添加失败，请重试';
			}
		}
	}
	/**
	 * [eit_course description]
	 * @return [type] [description]
	 * 修改课程
	 */
	public function eit_course(){
		if(IS_AJAX){
			foreach($_FILES as $k=>$v){
				if($k=='img'){
					$fl=date("Ymd",time());
					mkdir('./Public/upload/course/'.$fl);
                    chmod('./Public/upload/course/'.$fl,0777);
                    //创建的文件夹路径
                    $file_path='./Public/upload/course/'.$fl.'/'.time();
                    $rtn = $this->upload($v['tmp_name'],$file_path,$v['name']);
                    if($rtn==-1){
                    	echo '图片上传失败，暂时只支持jpg,jpeg,gif,png';
                    	exit;
                    }else{
                    	$_POST['img']=$rtn;
                    }
				}else{
					$fl=date("Ymd",time());
					mkdir('./Public/upload/course/banner/'.$fl);
                    chmod('./Public/upload/course/banner/'.$fl,0777);
                    //创建的文件夹路径
                    $file_path='./Public/upload/course/banner/'.$fl.'/'.time().$k;
                    $rtn = $this->upload($v['tmp_name'],$file_path,$v['name']);
                    if($rtn==-1){
                    	echo '图片上传失败，暂时只支持jpg,jpeg,gif,png';
                    	exit;
                    }else{
                    	$banner[]=$rtn;
                    	$_POST['banner']=json_encode($banner);
                    }
				}
			}
			$_POST['add_time']=time();
			$result = M('curriculum')->where(array('id'=>$_GET['id']))->save($_POST);
			if($result){
				echo '修改成功';
			}else{
				echo '修改失败，请重试';
			}
		}
	}
	/**
	 * [get_label description]
	 * @return [type] [description]
	 * 获取对应年级的标签
	 */
	public function get_label(){
		$rtn = M('label')->where($_POST)->select();
		$this->ajaxReturn($rtn);
	}
	/**
	 * [course_screen description]
	 * @return [type] [description]
	 * 列表筛选
	 */
	public function course_screen(){
		if($_POST['line_cloumn_id']){
			$whe['line_cloumn_id']=$_POST['line_cloumn_id'];
		}
		if($_POST['grade']){
			$whe['grade']=$_POST['grade'];
		}
		$row=M('curriculum')->where($whe)->select();
		foreach ($row as $key => $value) {
			$cloumn=M('curriculum_theme')->find($value['line_cloumn_id']);
			$row[$key]['line_cloumn']=$cloumn['title'];
			$user=M('user')->find($value['user_id']);
			$row[$key]['user']=$user['username'];
		}
		$count=count($row);
		$curriculum=M('curriculum_theme')->select();
		$this->assign('curriculum',$curriculum);
		$this->assign('row',$row);
		$this->assign('count',$count);
		$this->view('course_list');
	}
	/**
	 * [course_search description]
	 * @return [type] [description]
	 * 课程名称和地区搜索
	 */
	public function course_search(){
		if($_POST){
			$row=M('curriculum')->where("name like '%".$_POST['content']."%' or address like '%".$_POST['content']."%'")->select();
			foreach ($row as $key => $value) {
				$cloumn=M('curriculum_theme')->find($value['line_cloumn_id']);
				$row[$key]['line_cloumn']=$cloumn['title'];
				$user=M('user')->find($value['user_id']);
				$row[$key]['user']=$user['username'];
			}
			$count=count($row);
			$curriculum=M('curriculum_theme')->select();
			$this->assign('curriculum',$curriculum);
			$this->assign('row',$row);
			$this->assign('count',$count);
			$this->view('course_list');
		}else{
			alert('请输入搜索内容','3000',2);
		}
	}
	/**
	 * [del description]
	 * @return [type] [description]
	 * 单条删除
	 */
	public function del(){
		$rtn = M('curriculum')->delete($_POST['id']);
		if($rtn){
			echo '删除成功！';
		}else{
			echo '删除失败！';
		}
	}
	/**
	 * [alldel description]
	 * @return [type] [description]
	 * 批量删除
	 */
	public function alldel(){
		$all_id=$_POST['id'];
        $whe['id']=array('in',$all_id);
        $rtn=M('curriculum')->where($whe)->delete();
        echo $rtn;
	}
}