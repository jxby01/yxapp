<?php
namespace Admin\Controller;
use Think\Controller;
class NewsCloumnController extends CommonController {
    /**
     * 新闻分类栏目管理视图层控制器
     * 渲染所有新闻分类栏目视图层
     */
    
    /**
     * [cloumn_list description]
     * @return [type] [description]
     * 方法名：新闻分类栏目列表
     *   过程：
     *         1、根据权重查询所有栏目列表数据
     *         2、返回查询结果
     *         3、传值、渲染列表视图层
     */
    public function cloumn_list(){
        $cloumn      = new NewsCloumnLogicController();
        $row = $cloumn->cloumn_list();
        $this->assign('count',$row['count']);
        $this->assign('page',$row['show']);
        $this->assign('cloumn_list',$row['cloumn']);
        $this->view('cloumn_list');
    }
    /**
     * [cloumn_add description]
     * @return [type] [description]
     * 方法名：添加新闻分类栏目
     *   过程：
     *         1、渲染添加新闻分类栏目视图成页面
     */
    public function cloumn_add(){
        $this->view('cloumn_add');
    }
    /**
     * [cloumn_eitd description]
     * @return [type] [description]
     * 方法名：修改新闻分类栏目
     *   过程：
     *         1、get接收管理员需要修改的新闻分类栏目的id
     *         2、根据id查询当前新闻分类栏目的信息
     *         3、传值，渲染视图层信息
     */
    public function cloumn_eitd(){
        $row=M('news_cloumn')->find($_GET['news_cloumn_id']);
        $this->assign('row',$row);
        $this->view('cloumn_eitd');
    }
}