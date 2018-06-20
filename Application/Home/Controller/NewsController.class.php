<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    /**
     * 新闻中心控制器
     * 接口层，供前段交互数据层
     */
    
    /**
     * [news_list description]
     * @return [type] [description]
     * 方法名：新闻列表
     *   过程：
     *   	   1、查询获取所有有效新闻列表数据
     *   	   2、返回接口结果
     */
    public function news_list(){
    	$news=M('news')->where(array('state'=>1))->order('sort desc')->select();
    	$this->ajaxReturn($news);
    }
    /**
     * [news_details description]
     * @return [type] [description]
     * 方法名：新闻详情
     *   过程：
     *   	   1、获取新闻id
     *   	   2、查询新闻详情
     *   	   3、返回数据接口结果
     */
    public function news_details(){
    	$news_details=M('news')->find($_POST['news_id']);
    	$this->ajaxReturn($news_details);
    }
    /**
     * [comment description]
     * @return [type] [description]
     * 方法名：新闻评论信息
     * 	 过程：
     * 	 	   1、获取新闻id
     * 	 	   2、查询新闻相关的评论信息
     * 	 	   3、返回数据接口结果
     */
    public function news_comment(){
    	$comment=M('news_comment')->where(array('news_id'=>$_POST['news_id']))->select();
    	$this->ajaxReturn($comment);
    }
    /***/
    public function news_banner(){}
}