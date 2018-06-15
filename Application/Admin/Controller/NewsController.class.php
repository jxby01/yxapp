<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends CommonController {
    /**
     * 新闻管理视图层控制器
     * 渲染所有新闻视图层
     */

    /**
     * [news_list description]
     * @return [type] [description]
     * 方法名：新闻列表视图层
     *   过程：1、查询新闻表数据库
     *         2、获取新闻列表数据
     *         3、传值，渲染视图模板
     */
    public function news_list(){
        $count      = M('news')->where('state=1')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $news = M('news')->where('state=1')->order('sort desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($news as $k=>$val){
            $admin=M('admin')->find($val['admin_id']);
            $news[$k]['admin_name']=$admin['admin_name'];
        }
        $this->assign('count',$count);
        $this->assign('news',$news);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->view('news_list');
    }
    /**
     * [news_add description]
     * @return [type] [description]
     * 方法名：添加新闻
     *   过程：
     *         1、渲染添加新闻页面
     *         2、用户输入发表内容
     */
    public function news_add(){
        $cloumn=M('news_cloumn')->where(array('state'=>1))->select();
        $this->assign('cloumn',$cloumn);
        $this->view('news_add');
    }
    /**
     * [mews_eitd description]
     * @return [type] [description]
     * 方法名：新闻修改页面
     *   过程：
     *         1、get获取当期修改新闻id
     *         2、根据id查询当期新闻信息
     *         3、传值、渲染当前新闻信息在视图
     *         4、用户修改需要修改内容
     */
    public function news_eitd(){
        $news_id=$_GET['news_id'];
        $news=M('news')->find($news_id);
        $first_cloumn=M('news_cloumn')->find($news['news_cloumn_id']);
        $news['news_cloumn_name']=$first_cloumn['name'];
        $cloumn=M('news_cloumn')->where(array('state'=>1))->select();
        $this->assign('cloumn',$cloumn);
        $this->assign('news',$news);
        $this->view('news_eitd');
    }
}