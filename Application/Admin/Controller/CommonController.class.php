<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->CheckLogin();
	}
	
	public function CheckLogin(){
		if(empty($_SESSION['admin_name'])){
			$this->error('未登录',U('Admin/Login/login'),2);
		}
	}
	
    public function view($view){
		$menu = simplexml_load_file('Public/Admin/data/menu.xml');
		//print_r($menu);exit;
		$getU = CONTROLLER_NAME.'/'.ACTION_NAME;
		$this->assign('menu',$menu);
		$this->assign('getU',$getU);
		$this->display('public/header');
		$this->display($view);
		$this->display('public/footer');
	}
	/**
	 * 方法名：图片上传
	 * 	 流程：
	 * 	 		1、接收文件上传临时路径、保存到文件路径、文件名
	 * 	 		2、匹配上传格式，判断是否是允许上传文件格式类似
	 * 	 		3、处理文件，保存到指定文件夹
	 */
	function upload($path, $file_path, $file_name){
		// $file=$_FILES['file'];
		// $name=$file['name'];
		$type = strtolower(substr($file_name,strrpos($file_name,'.')+1)); //得到文件类型，并且都转化成小写
		$allow_type = array('jpg','jpeg','gif','png'); 
		//判断文件类型是否被允许上传
		if(!in_array($type, $allow_type)){
		//如果不被允许，则直接停止程序运行
			return -1;//返回失败码
		}else{
			//创建的文件夹路径
			$file_path=$file_path.'.'.$type;
			//保存图片
			move_uploaded_file($path,$file_path);
			return $file_path;//返回保存路径
			// return 'success';//返回成功(二选一)
		}
	}

    /**
     * layui上传图片请求接口
     */
    public function add_imgs(){

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  = './Public/upload/'; // 设置附件上传根目录
        $upload->savePath  = 'header/'; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        $imgs = 'Public/upload/'.$info['file']['savepath'].$info['file']['savename'];
        exit(json_encode(array("code"=>0,"msg"=>'上传成功','src'=>$imgs)));//返回到JS中进行处理
    }
	
}
?>