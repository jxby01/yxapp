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
        echo M('news')->delete($_POST['news_id']);
    }
    /**
     * [news_alldel description]
     * @return [type] [description]
     * 方法名：删除所有选中的id数据
     *   过程：
     *         1、post接收选中的id
     *         2、删除选中的id数据
     *         3、返回处理结果
     */
    public function news_alldel(){
        $all_id=$_POST['id'];
        $whe['news_id']=array('in',$all_id);
        $rtn=M('news')->where($whe)->delete();
        echo $rtn;
    }
    /**
     * [news_sort description]
     * @return [type] [description]
     * 方法名：权重排序
     *   过程：
     *         1、post获取组装的关联数组data
     *         2、修改所有数据的权重
     *         3、返回处理结果
     */
    public function news_sort(){
        $sort=$_POST['data'];
        foreach ($sort as $key => $value) {
            M('news')->where(array('news_id'=>$key))->save(array('sort'=>$value));
        }
        echo '操作成功';
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
        if(!$_POST['content']){
            alert('请输入搜索内容',2500,2);
            exit;
        }
        $content=$_POST['content'];
        $count      = M('news')->where("state=1 and title like '%".$content."%'")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $news = M('news')->where("state=1 and title like '%".$content."%'")->order('sort desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($news as $k=>$val){
            $admin=M('admin')->find($val['admin_id']);
            $news[$k]['admin_name']=$admin['admin_name'];
            $cloumn=M('news_cloumn')->find($val['news_cloumn_id']);
            $news[$k]['cloumn']=$cloumn['name'];
        }
        $cloumn=M('news_cloumn')->where(array('state'=>1))->order('news_cloumn_id desc')->select();
        $this->assign('cloumn',$cloumn);
        $this->assign('count',$count);
        $this->assign('news',$news);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->view('news_list_search');
       
    }
    /**
     * [news_screen description]
     * @return [type] [description]
     * 方法名：新闻列表筛选
     *   过程：
     *         1、post接收筛选条件
     *         2、查询满足筛选条件的所有数据
     *         3、对数据进行分页
     *         4、返回处理结果
     *         5、传值、渲染筛选列表
     */
    public function news_screen(){
        if(!$_POST['start'] && !$_POST['end'] && !$_POST['news_cloumn_id']){
            alert('请选择筛选条件',2500,2);
            exit;
        }
        if($_POST['start']){
            $starttime=strtotime($_POST['start']);
            $tmp['start_time']=array('EGT',$starttime);
        }
        if($_POST['end']){
            $endtime=strtotime($_POST['end'])+24*3600-1;//结束时间的23:59
            $tmp['start_time']=array('ELT',$endtime);
        }
        if($_POST['news_cloumn_id']){
            $tmp['news_cloumn_id']=$_POST['news_cloumn_id'];
        }
        $count      = M('news')->where($tmp)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $news = M('news')->where($tmp)->order('sort desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($news as $k=>$val){
            $admin=M('admin')->find($val['admin_id']);
            $news[$k]['admin_name']=$admin['admin_name'];
            $cloumn=M('news_cloumn')->find($val['news_cloumn_id']);
            $news[$k]['cloumn']=$cloumn['name'];
        }
        $cloumn=M('news_cloumn')->where(array('state'=>1))->order('news_cloumn_id desc')->select();
        $this->assign('cloumn',$cloumn);
        $this->assign('count',$count);
        $this->assign('news',$news);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->view('news_list_screen');
    }
}