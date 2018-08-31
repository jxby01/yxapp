<?php
namespace Admin\Controller;
use Think\Controller;
class UserLogicController extends CommonController {
	/**
	 * 用户-控制器-逻辑
	 */
	
	/**
	 * [del description]
	 * @return [type] [description]
	 * 单个用户删除
	 */
	public function del(){
		$id=$_POST['id'];
		echo M('user')->delete($id);
	}
	/**
	 * [add description]
	 * 增加用户
	 */
	public function add(){
		if(!$_POST['username']){
			alert('请输入用户名','3000',2);
			exit;
		}
		if(!$_POST['tel']){
			alert('请输入登录手机号','3000',2);
			exit;
		}
		if(!$_POST['password']){
			alert('请输入登录密码','3000',2);
			exit;
		}
		$rtn = M('user')->add($_POST);
		if($rtn){
			$this->success('添加成功',U('User/user_list'),2);
		}else{
			alert('添加失败','3000',2);
		}
	}
	/**
	 * [alldel description]
	 * @return [type] [description]
	 * 多选删除
	 */
	public function alldel(){
		$all_id=$_POST['id'];
        $whe['id']=array('in',$all_id);
        $rtn=M('user')->where($whe)->delete();
        echo $rtn;
	}
	/**
	 * [approved description]
	 * @return [type] [description]
	 * 通过审核
	 */
	public function approved(){
		$id=$_POST['id'];
		$examine=$_POST['examine'];
		echo M('user')->where(array('id'=>$id))->save(array('role'=>$examine,'examine'=>0,'state'=>1));
	}
	/**
	 * [import description]
	 * @return [type] [description]
	 * 导入用户
	 */
	public function import(){
		$rtn = $this->excel($_FILES['excel']['tmp_name'], $_FILES['excel']['name']);
		include_once('./excel.php');
        $excel_to_array = new \Excel();
        $arrays = $excel_to_array->excels($rtn);
        unset($arrays[0]);
        foreach($arrays as $key=>$value){
        	foreach($value as $k=>$val){
        	 	$add['school'] = $val[0];
        	 	if($val[1]=='校长'){
        	 		$add['role'] = 1;
        	 	}else if($val[1]=='年级主任'){
        	 		$add['role'] = 2;
        	 	}else if($val[1]=='老师'){
        	 		$add['role'] = 3;
        	 	}else if($val[1]=='辅导员'){
        	 		$add['role'] = 4;
        	 	}else if($val[1]=='学生'){
        	 		$add['role'] = 5;
        	 	}else if($val[1]=='专家'){
        	 		$add['role'] = 6;
        	 	}else{
        	 		$add['role'] = 0;
        	 	}
        	 	$add['username'] = $val[2];
        	 	$add['tel'] = $val[3];
        	 	$add['grade'] = $val[4];
        	 	$add['ban'] = $val[5];
        	 	$add['course'] = $val[6];
        	 	$add['birthday'] = $val[7];
        	 	$add['age'] = $val[8];
        	 	if($val[9]=='男'){
        	 		$add['sex'] = 1;
        	 	}else if($val[9]=='女'){
        	 		$add['sex'] = 2;
        	 	}else{
        	 		$add['sex'] = 0;
        	 	}
        	 	$add['password'] = 123456;
        	 	$rn = M('user')->where(array('tel'=>$val[3]))->find();
        	 	if($rn){
        	 		$num++;
        	 	}else{
        	 		$user = M('user')->add($add);
        	 		if($user){
        	 			$succ++;
        	 		}
        	 	}
        	}
        }
        if(!$num){
        	$num = 0;
        }
        if(!$succ){
        	$succ = 0;
        }
        $this->ajaxReturn(array('code'=>1,'success'=>$succ,'error'=>$num,'mags'=>'读取导入完成'));
	}
	/**
	 * [upload description]
	 * @return [type] [description]
	 * 上传导入.xls表格
	 */
	public function excel($tmp_name,$name){
        //创建添加的文件夹和权限
        $fl=date("Ymd",time());
        mkdir('./Public/upload/excel/'.$fl);
        chmod('./Public/upload/excel/'.$fl,0777);
        //创建的文件夹路径
        $file_path='./Public/upload/excel/'.$fl.'/'.time();
        $rtn = $this->upload($tmp_name,$file_path,$name);
        return $rtn;
	}
}