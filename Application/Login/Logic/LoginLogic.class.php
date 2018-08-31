<?php
namespace Login\Logic;
class LoginLogic{
	public function __construct(){
		$this->UserLogin = M('user');
	}
	/**
	 * [logic_login description]
	 * @return [type] [description]
	 * 验证登录
	 * $sql 查询sql语句数组(登录手机号，密码)
	 */
	public function logic_login($sql){
		$rtn = $this->UserLogin->where($this->logic_sql($sql))->find();
		if(!$rtn){
			$this->error = '用户不存在';
			return false;
		}
		$result['row']=$rtn;
		$result['code']=1;
		$result['mags']='登录成功';
		$result['row_len']=$this->count($this->logic_sql($sql));
		return $result;
	}
	/**
	 * [register description]
	 * @param  [type] $add_user [description] 用户信息
	 * @return [type]           [description]
	 * 注册用户
	 */
	public function register($add_user){
		$rtn = $this->UserLogin->add($add_user);
		if(!$rtn){
			$this->error='注册失败';
			return false;
		}
		$result['user']=$rtn;
		$result['code']=1;
		$result['mags']='注册成功';
		return $result;
	}
	/**
	 * [logic_sql description]
	 * @param  [type] $sql [description] sql条件数组
	 * @return [type]      [description]
	 * sql条件重组
	 */
	public function logic_sql($sql){
		$new_sql=array();
		if($sql['tel']){
			$new_sql['tel'] = $sql['tel'];
		}
		if($sql['pass']){
			$new_sql['password'] = $sql['pass'];
		}
		return $new_sql;
	}
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->UserLogin->where($sql)->count();
	}
	/*//获取充值记录列表
	public function recharge_lists($sql,$page,$limit,$order){
		$page = $page ? $page : 1;
		$limit = $limit ? $limit : 10;
		$order = $order ? $order : 'addtime DESC';
		$row = $this->MembersChongzhilogModel->where($this->regroup_sql($sql))->order($order)->page($page)->limit($limit)->select();
		if(!$row){
			$this->error = '没有相关会员数据';
			return false;
		}
		$result['row'] = $row;
		$result['row_len'] = $this->count($this->regroup_sql($sql));
		return $result;
	}
	// 重组sql条件
	public function regroup_sql($sql){
		$new_sql = array();
		if($sql['comid']){
			$new_sql['comid'] = $sql['comid'];
		}
		if($sql['servicecomid']===0 || $sql['servicecomid']){
			$new_sql['servicecomid'] = $sql['servicecomid'];
		}
		if($sql['memid']){
			$new_sql['memid'] = $sql['memid'];
		}
		return $new_sql;
	}
	public function getError(){
		return $this->error;
	}
	public function count($sql){
		return (int)$this->MembersChongzhilogModel->where($sql)->count();
	}*/
}