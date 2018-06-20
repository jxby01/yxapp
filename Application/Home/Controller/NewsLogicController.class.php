<?php
namespace Home\Controller;
use Think\Controller;
class NewsLogicController extends Controller {
    /**
     * 新闻资讯逻辑处理层
     * 新闻留言评论，查看次数，点赞
     */
    
    /**
     * [news_view description]
     * @return [type] [description]
     * 方法名：新闻浏览次数
     *   过程：
     *   	   1、post接收新闻id
     *   	   2、修改增加对应新闻浏览次数
     *   	   3、返回处理结果
     */
    public function news_view(){
    	$news=M('news')->find($_POST['news_id']);
    	echo M('news')->where(array('news_id'=>$_POST['news_id']))->save(array('view'=>$news['view']+1));
    }
    /**
     * [news_comment description]
     * @return [type] [description]
     * 方法名：用户评论回复新闻资讯
     * 	 过程：
     * 	 	   1、接收用户评论内容及用户id，回复的评论id和回复评论的用户id
     * 	 	   2、保存用户评论信息
     * 	 	   3、返回处理结果
     */
    public function news_comment(){
    	$content=$_POST['content'];//评论及回复的内容
    	$user_id=$_POST['user_id'];//评论用户的id
    	$news_id=$_POST['news_id'];//该条新闻的id
    	if($_POST['comment_id']){
    		//当前这条评论的id
    		
    	}
    	echo M('news_comment')->add($_POST);
    }
}