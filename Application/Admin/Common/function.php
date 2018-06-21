<?php
	/**
	 * [alert description]
	 * @return [type] [description]
	 * 方法名：封装alert弹框($content提示内容，$t执行时间1s=1000，$icon提示图标->1成功-2失败)
	 */
	function alert($content,$t,$icon){
		header('Content-Type: text/html; charset=utf-8');
		echo "<script type='text/javascript' src='/Public/Admin/assetsl/js/jquery-2.1.0.js' ></script><script type='text/javascript' src='/Public/Admin/assetsl/js/layer/layer.js' ></script><script>layer.msg('".$content."', {icon: ".$icon."});setTimeout(shuax,".$t."); function shuax(){ window.history.back();}</script>";
	}

	/**
     * 日志文件
     */
 function write_log($data){
    $years = date('Y-m');
    //设置路径目录信息
    $url = './public/log/txlog/'.$years.'/'.date('Ymd').'_request_log.txt';
    $dir_name=dirname($url);
    //目录不存在就创建
    if(!file_exists($dir_name))
    {
        //iconv防止中文名乱码
        $res = mkdir(iconv("UTF-8", "GBK", $dir_name),0777,true);
    }
    $fp = fopen($url,"a");//打开文件资源通道 不存在则自动创建
    fwrite($fp,var_export($data,true)."\r\n");//写入文件
    fclose($fp);//关闭资源通道
}
?>