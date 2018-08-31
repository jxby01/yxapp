<?php
namespace Api\Controller;
use Think\Controller;
/**
* 登录api
*/
class LoginController extends Controller {
	
	function __construct()
	{
		parent::__construct();
        $this->LoginLogic = D('Login/Login','Logic');
	}
	/**
	 * [login description]
	 * @return [type] [description]
	 * 用户登录
	 */
	public function login(){
		$login['tel']=I('tel');
		$login['pass']=I('password');
		if(in_array('',$login)){
			$result['code']=-1;
			$result['mags']='登录失败，请完善登录信息！';
			$this->ajaxReturn($result);
		}
		// $login['tel']='13594126444';
		// $login['pass']='1234';
		$rtn = $this->LoginLogic->logic_login($login);
		$this->ajaxReturn($rtn);
	}
	/**
	 * [register description]
	 * @return [type] [description]
	 * 用户注册
	 */
	public function register(){
		$data['username'] = I('username');
		$data['tel'] = I('tel');
		$data['password'] = I('password');
		$data['role'] = 0;
		$data['sex'] = I('sex');
		$data['age'] = I('age');
		$data['examine'] = I('examine');
		$data['state'] = -1;
		if(in_array('',$data)){
			$result['code']=-1;
			$result['mags']='注册失败，请完善完善信息！';
			$this->ajaxReturn($result);
		}
		$rtn = $this->LoginLogic->register($data);
	}
}