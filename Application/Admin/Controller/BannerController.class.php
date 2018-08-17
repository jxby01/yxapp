<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends CommonController {
    /**
     * banner管理--控制器
     */
    
    /**
     * [banner_list description]
     * @return [type] [description]
     * banner列表 
     */
    public function banner_list(){
    	$row=M('banner')->order('sort asc')->select();
    	$count=count($row);
    	$this->assign('count',$count);
    	$this->assign('row',$row);
    	$this->view();
    }
    /**
     * [set_link description]
     * 修改跳转路径
     */
    public function set_link(){
    	echo M('banner')->where(array('id'=>$_POST['id']))->save(array('link_to'=>$_POST['link_to'],'start_time'=>time(),'admin_name'=>$_SESSION['admin_name']));
    }
    /**
     * [update description]
     * @return [type] [description]
     * 修改图片
     */
    
    public function update(){
    	$file=$_FILES['file'];
		$id=I('id');
		$file_path='banner/'.time();
		$type = strtolower(substr($file['name'],strrpos($file['name'],'.')+1)); //得到文件类型，并且都转化成小写
		$allow_type = array('jpg','jpeg','gif','png'); 
		//判断文件类型是否被允许上传
		if(!in_array($type, $allow_type)){
		//如果不被允许，则直接停止程序运行
			echo -1;//返回失败码
		}else{
			$new_path=$file_path.'.'.$type;
			//创建的文件夹路径
			$new_file_path='./Public/'.$new_path;
			//保存图片
			move_uploaded_file($file['tmp_name'],$new_file_path);
			echo M('banner')->where(array('id'=>$id))->save(array('img'=>$new_path,'start_time'=>time(),'admin_name'=>$_SESSION['admin_name']));
		}
    }
    /**
     * [sort description]
     * @return [type] [description]
     * 排序
     */
    public function sort(){
    	 $sort=$_POST['data'];
        foreach ($sort as $key => $value) {
            M('banner')->where(array('id'=>$key))->save(array('sort'=>$value));
        }
        echo '操作成功';
    }
    /**
     * [see description]
     * @return [type] [description]
     * 显示和不显示
     */
    public function see(){
    	$id=$_POST['id'];
    	if($_POST['state']==1){
    		$state=0;
    	}else{
    		$state=1;
    	}
    	echo M('banner')->where(array('id'=>$id))->save(array('state'=>$state,'admin_name'=>$_SESSION['admin_name'],'start_time'=>time()));
    }
}