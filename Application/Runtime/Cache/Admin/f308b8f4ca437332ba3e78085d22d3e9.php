<?php if (!defined('THINK_PATH')) exit();?>	<!--	<div class="am-g">-->
		<!-- ============================================================== -->
		<!-- Start right Content here -->
		<div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="am-g">
					<!-- Row start -->
						<div class="am-u-sm-12">
								<form class="am-form" data-am-validator>
									<div class="am-u-md-6">
										<div class="card-box">
											<h4 class="header-title m-t-0 m-b-30">修改资料</h4>
											<form class="am-form">
                                                <div class="layui-upload">

                                                    <div class="layui-upload-list">
                                                        <img style="width: 84px;height: 84px;margin-bottom: 12px;" class="layui-upload-img" src="<?php if($row['headerimg'] == null || $row['headerimg'] == ''){echo '/Public/Admin/assetsl/img/headerimg.png';}else{echo '/'.$row['headerimg'].'';}?>" id="demo1">
                                                        <p></p>
                                                        <button style="font-size: 12px;height: 30px;line-height: 30px;" type="button" class="layui-btn" id="test1">选择图片</button>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?php echo ($row["admin_id"]); ?>" id="ids">
												<div class="am-form-group">
													<label for="doc-ipt-pwd-2">设置密码</label>
													<input type="password" class="am-radius" id="doc-ipt-pwd-2" placeholder="设置个密码吧">
												</div>
												<div class="am-form-group">
													<label for="doc-ipt-pwd-2">确认密码</label>
													<input type="password" class="am-radius" id="doc-ipt-pwd-3" placeholder="确认密码">
												</div>
                                                <div class="am-form-group">
                                                    <label style="font-size: 12px;color: #BABABA;" for="doc-ipt-pwd-2">注：修改成功后会自动退出，需重新登录...</label>
                                                </div>
												<button type="submit" id="submit" class="am-btn am-btn-primary">确认修改</button>
											</form>
										</div>
									</div>
								</form>
						</div>
					<!-- Row end -->
				</div>
			</div>
		</div>
		<!-- end right Content here -->
		<!--</div>-->
		</div>
<script type="text/javascript" src="/Public/Admin/assetsl/js/jquery-2.1.0.js" ></script>
<script type="text/javascript" src="/Public/Admin/layui/layui.js" ></script>
<script>
    var img = null;
    layui.use('upload', function(){
        var $ = layui.jquery,
            upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#test1'
            ,url: '<?php echo U("Admin/Common/add_imgs");?>'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
                }
                img = res.src;
                //上传成功
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    })
$(function(){

        $("#submit").click(function(){
             var headerimg = img;
             var id = $("#ids").val();
             var password = $("#doc-ipt-pwd-2").val();
             var sure_password = $("#doc-ipt-pwd-3").val();
            if(password == null || password == ""){
                alert("请填写密码");
                return false;
            }
            if(password != sure_password){
                alert("密码不一致");
                return false;
            }

            $.ajax({
                type:'post',
                url:"<?php echo U('Admin/Power/eidt_profile');?>",
                data:{password:password,id:id,headerimg:headerimg},
                success:function(data){
                    if(data == 1){
                        setInterval(layer.msg('修改成功，即将推出，请重新登录'),1500);
                        window.location.href='<?php echo U("Admin/Login/logout");?>';
                    }else{
                        alert('出现了一点小的意外...');
                        location.reload();
                    }
                }
            })


        })
})

</script>