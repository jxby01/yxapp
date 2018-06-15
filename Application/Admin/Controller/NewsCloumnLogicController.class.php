<?php
namespace Admin\Controller;
use Think\Controller;
class NewsCloumnLogicController extends CommonController {
    /**
     * 新闻分类栏目逻辑处理管理层控制器
     * 处理所有数据交换逻辑层
     */
    
    /**
     * [cloumn_list description]
     * @return [type] [description]
     * 方法名：新闻分类栏目
     *   过程：
     *         1、查询所有新闻分类栏目
     *         2、返回所有查询数据
     */
    public function cloumn_list(){
        $rtn['count'] = M('news_cloumn')->where(array('state'=>1))->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $rtn['show'] = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $rtn['cloumn']=M('news_cloumn')->where(array('state'=>1))->order('sort desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($rtn['cloumn'] as $key => $value) {
            $admin=M('admin')->find($value['admin_id']);
            $rtn['cloumn'][$key]['admin_name']=$admin['admin_name'];
        }
        return $rtn;
    }
    /**
     * [cloumn_add description]
     * @return [type] [description]
     * 方法名：添加新闻分类栏目
     *   过程：
     *         1、post接收管理员输入内容数据
     *         2、处理接收数据，判断数据是否合法
     *         3、数据入库
     *         4、返回处理结果
     */
    public function cloumn_add(){
        $file = $_FILES['img'];
        $date['name']=I('name');
        if($date['name']){
            $date['starttime']=time();
            //创建添加的文件夹和权限
            $fl=date("Ymd",time());
            mkdir('./Public/upload/news/'.$fl);
            chmod('./Public/upload/news/'.$fl,0777);
            //创建的文件夹路径
            $file_path='./Public/upload/news/'.$fl.'/'.time();
            $rtn = $this->upload($file['tmp_name'],$file_path,$file['name']);
            $date['img']=$rtn;
            $date['admin_id']=$_SESSION['admin_id'];
            M('news_cloumn')->add($date);
            $this->success('添加成功',U("NewsCloumn/cloumn_add"),2);
        }else{
            $this->error('请输入栏目名称');
        }
            
    }
    /**
     * [cloumn_eitd description]
     * @return [type] [description]
     * 方法名：修改新闻分类栏目
     *   过程：
     *         1、接收管理员修改数据信息
     *         2、处理接收数据，判断数据是否合法
     *         3、数据入库
     *         4、返回处理结果
     */
    public function cloumn_eitd(){
        $news_cloumn_id=$_POST['news_cloumn_id'];
        $date['name']=I('name');
        if($date['name']){
            $date['starttime']=time();
            if($_FILES['img']['tmp_name']){
                //创建添加的文件夹和权限
                $fl=date("Ymd",time());
                mkdir('./Public/upload/news/'.$fl);
                chmod('./Public/upload/news/'.$fl,0777);
                //创建的文件夹路径
                $file_path='./Public/upload/news/'.$fl.'/'.time();
                $rtn = $this->upload($file['tmp_name'],$file_path,$file['name']);
                $date['img']=$rtn;
            }
            $date['admin_id']=$_SESSION['admin_id'];
            M('news_cloumn')->where(array('news_cloumn_id'=>$news_cloumn_id))->save($date);
            $this->success('修改成功',U("NewsCloumn/cloumn_list"),2);
        }else{
            $this->error('请输入栏目名称');
        }
    }
    /**
     * [cloumn_del description]
     * @return [type] [description]
     * 方法名：删除新闻分类栏目
     *   过程：
     *         1、get接收删除的id
     *         2、删除该id对应的数据
     *         3、返回处理结果
     */
    public function cloumn_del(){
        echo M('news_cloumn')->delete($_POST['news_cloumn_id']);
    }
    /**
     * [cloumn_alldel description]
     * @return [type] [description]
     * 方法名：删除多条信息
     *   过程：
     *         1、获取选择的新闻栏目id
     *         2、删除所有的选择的栏目
     *         3、返回处理结果
     */
    public function cloumn_alldel(){
        $all_id=$_POST['id'];
        $whe['news_cloumn_id']=array('in',$all_id);
        $rtn=M('news_cloumn')->where($whe)->deleteete();
        echo $rtn;
    }
    /**
     * [cloumn_sort description]
     * @return [type] [description]
     * 方法名：权重排序
     *   过程：
     */
    public function cloumn_sort(){
        $sort=$_POST['data'];
        foreach ($sort as $key => $value) {
            M('news_cloumn')->where(array('news_cloumn_id'=>$key))->save(array('sort'=>$value));
        }
        echo '操作成功';
    }
}