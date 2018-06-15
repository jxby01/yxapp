<?php
namespace Admin\Controller;
use Think\Controller;
class NewsLogicController extends CommonController {
    /**
     * 新闻管理逻辑层控制器
     * 处理所有的新闻的逻辑
     */
    
    /**
     * [news_add description]
     * @return [type] [description]
     * 方法名：添加新闻
     *   过程：
     *         1、POST接收新闻添加数据
     *         2、处理接收数据，判读数据是否合法
     *         3、数据入库
     *         4、返回处理结果
     */
    public function news_add(){
        header('Content-Type: text/html; charset=utf-8');
        $data['title']=$_POST['title'];
        $data['news_cloumn_id']=$_POST['news_cloumn_id'];
        $data['content']=$_POST['content'];
        $file = $_FILES['img'];
        if($data['title']){
            if($data['content']){
                if($file['tmp_name']){
                    $data['start_time']=time();
                    //创建添加的文件夹和权限
                    $fl=date("Ymd",time());
                    mkdir('./Public/upload/news/'.$fl);
                    chmod('./Public/upload/news/'.$fl,0777);
                    //创建的文件夹路径
                    $file_path='./Public/upload/news/'.$fl.'/'.time();
                    $rtn = $this->upload($file['tmp_name'],$file_path,$file['name']);
                    $data['img']=$rtn;
                    $data['admin_id']=$_SESSION['admin_id'];
                    M('news')->add($data);
                    $this->success('添加成功',U("News/news_list"),2);
                }else{
                    alert('请上传新闻图片','3000',2);
                }
            }else{
                alert('请输入新闻详情','3000',2);
            }
        }else{
            alert('请输入新闻标题','3000',2);
        }
    }
    /**
     * [news_eitd description]
     * @return [type] [description]
     * 方法名：修改新闻内容
     *   过程：
     *         1、post接收修改内容数据
     *         2、处理接收数据，判断数据是否合法
     *         3、数据入库
     *         4、返回处理结果
     */
    public function news_eitd(){
        header('Content-Type: text/html; charset=utf-8');
        $news_id=$_POST['news_id'];
        $data['title']=$_POST['title'];
        $data['news_cloumn_id']=$_POST['news_cloumn_id'];
        $data['content']=$_POST['content'];
        $file = $_FILES['img'];
        if($data['title']){
            if($data['content']){
                if($file['tmp_name']){
                    //创建添加的文件夹和权限
                    $fl=date("Ymd",time());
                    mkdir('./Public/upload/news/'.$fl);
                    chmod('./Public/upload/news/'.$fl,0777);
                    //创建的文件夹路径
                    $file_path='./Public/upload/news/'.$fl.'/'.time();
                    $rtn = $this->upload($file['tmp_name'],$file_path,$file['name']);
                    $data['img']=$rtn;
                } 
                $data['start_time']=time();
                $data['admin_id']=$_SESSION['admin_id'];
                M('news')->where(array('news_id'=>$news_id))->save($data);
                $this->success('修改成功',U("News/news_list"),2);
            }else{
                alert('请输入新闻详情','3000',2);
            }
        }else{
            alert('请输入新闻标题','3000',2);
        }
    }
    /**
     * [news_del description]
     * @return [type] [description]
     * 方法名：删除新闻
     *   过程：
     *         1、接收新闻id
     *         2、删除该id对应的数据
     *         3、返回处理结果
     */
    public function news_del(){

    }
    /**
     * [news_search description]
     * @return [type] [description]
     * 方法名：搜索新闻列表
     *   过程：
     *         1、post接收搜索内容
     *         2、根据接收数据模糊查询数据库
     *         3、返回查询结果
     *         4、传值，渲染搜索列表
     */
    public function news_search(){

    }
}