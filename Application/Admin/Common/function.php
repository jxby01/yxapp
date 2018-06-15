<?php
	/**
	 * [alert description]
	 * @return [type] [description]
	 * 方法名：封装alert弹框($content提示内容，$t执行时间1s=1000，$icon提示图标->1成功-2失败)
	 */
	function alert($content,$t,$icon){
		echo "<script type='text/javascript' src='/Public/Admin/assetsl/js/jquery-2.1.0.js' ></script><script type='text/javascript' src='/Public/Admin/assetsl/js/layer/layer.js' ></script><script>layer.msg('".$content."', {icon: ".$icon."});setTimeout(shuax,".$t."); function shuax(){ window.history.back();}</script>";
	}
?>