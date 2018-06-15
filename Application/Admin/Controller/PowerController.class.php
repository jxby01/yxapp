<?php
namespace Admin\Controller;
use Think\Controller;
class PowerController extends CommonController{
    public function power_list(){//权限列表
		$leavl = M('leavl'); // 实例化User对象
		$count = $leavl->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $leavl->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//rint_r($list);
		$this->assign('count',$count);
		$this->assign('row',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->view('power/power_list');
    }
	
	public function power_add(){//添加权限
		if(!empty($_POST)){
			$data['name']=$_POST['name'];
			$data['leavls'] = json_encode($_POST['leavls']);
			$data['cre_time'] = time();
			if(M('leavl')->add($data)){
				echo 1;
			}else{
				echo 2;
			}
		}else{
			$this->view('power/power_add');
		}
	}
	
	public function power_del(){//删除权限
		if(!empty($_POST)){
			$id = $_POST['id'];
			if(M('leavl')->where(array('id'=>$id))->delete()){
				echo 1;
			}
		}
	}
	
	public function power_edit(){//权限修改
		if(!empty($_POST)){
			$id = $_POST['id'];
			$data['name']=$_POST['name'];
			$data['leavls'] = json_encode($_POST['leavls']);
			$data['cre_time'] = time();
			if(M('leavl')->where(array('id'=>$id))->save($data)){
				echo 1;
			}else{
				echo 2;
			}
		}else{
			$id = $_GET['id'];
			$row = M('leavl')->where(array('id'=>$id))->find();
			$this->assign('row',$row);
			$this->assign('cow',json_decode($row['leavls']));
			$this->view('power/power_edit');
		}
	}
	
	public function admin_list(){//管理员列表
		$admin = M('admin'); // 实例化User对象
		$count = $admin->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $admin->join('zd_leavl ON zd_leavl.id = zd_admin.level_id')->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//rint_r($list);
		$this->assign('count',$count);
		$this->assign('row',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->view('power/admin_list');
	}
	
	public function admin_add(){//管理员添加
		if(!empty($_POST)){
				$data['admin_name']=$_POST['admin'];
				$data['admin_password']=sha1($_POST['password']);
				$data['level_id']=$_POST['leavl'];
				$data['create_time']=time();
				if(M('admin')->add($data)){
					echo 1;
				}
		}else{
			$powers = M("leavl")->select();
			$this->assign('powers',$powers);
			$this->view('power/admin_add');
		}
	}
	/**
     * 判断管理员是否重名
     */
	public function if_admin_be(){
        if(!empty($_POST)){
            $admin = $_POST['admin'];
            if(M('admin')->where(array('admin_name'=>$admin))->find()){
                echo 1;
            }
        }
    }

    /**
     * 管理员删除
     */
    public function admin_del(){
        if(!empty($_POST)){
            $id = $_POST['id'];
            if(M('admin')->where(array('admin_id'=>$id))->delete()){
                echo 1;
            }
        }
    }

    /**
     * 管理员修改
     */
    public function admin_edit(){
        if(!empty($_POST)){
            $id = $_POST['id'];
            $data['level_id']=$_POST['leavl'];
            $data['cre_time'] = time();
            if(M('admin')->where(array('admin_id'=>$id))->save($data)){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            $id = $_GET['id'];
            $powers = M("leavl")->select();
            $row = M('admin')->where(array('admin_id'=>$id))->find();
            $this->assign('powers',$powers);
            $this->assign('row',$row);
            $this->view('power/admin_edit');
        }
    }

    /**
     * 修改个人信息，密码
     */
    public function eidt_profile(){
        if(!empty($_POST)){
            $data['admin_password']= sha1($_POST['password']);
            $data['headerimg'] = $_POST['headerimg'];
            $id = $_POST['id'];
            if(M('admin')->where(array('admin_id'=>$id))->save($data)){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $adminname = $_GET['name'];
            $row = M('admin')->where(array('admin_name'=>$adminname))->find();
            $this->assign('row',$row);
            $this->view('power/eidt_Profile');
        }
    }
}

?>