<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){//加载页面
		$this->display('login/login');
  }
  //退出登录
  public function logout(){
		// session_unset();
		session_destroy();
		$this->redirect('Login/login',array(),2,'<meta charset="utf-8"/>安全退出中...');
	}
	//检验验证码
	public function check_code(){
		if(!empty($_POST)){
			$verify = new \Think\Verify();
			$code = $_POST['code'];
			$cs = $verify->check($code);
			if($cs == 1){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	//检验登录是否正确
	public function check_passw(){
		if(!empty($_POST)){
			$adminname = $_POST['name'];
			$password = sha1($_POST['password']);
			$admin = M('admin');
			$ruselt = $admin->where(['admin_name'=>$adminname,'admin_password'=>$password])->find();
			if(!empty($ruselt)){
				$_SESSION['admin_name'] = $adminname;
				$_SESSION['admin_id'] = $ruselt['admin_id'];
				$_SESSION['headerimg'] = $ruselt['headerimg'];
				$level = M('leavl')->where(array('id'=>$ruselt['level_id']))->find();
				if($level['leavls'] == '*'){
                    $_SESSION['leavls'] = $level['leavls'];
                }else{
                    $_SESSION['leavls'] = json_decode($level['leavls']);
                }

				echo 1;//检验成功
			}else{
				echo 0;//未检验到数据库结果
			}
			
		}
	}
	//生成验证码
	public function verify(){
		$Verify =     new \Think\Verify();
		$Verify->fontSize = 18;
		$Verify->length   = 4;
		$Verify->useNoise = false;
		$Verify->entry();
		
	}
	//是否重名
	public function checkname(){
		$username = $_POST['username'];
		$sql = M('admin')->where(array('username'=>$username))->select();
		if(!empty($sql)){
			echo 1;
		}else{
			echo 0;
		}
	}
}