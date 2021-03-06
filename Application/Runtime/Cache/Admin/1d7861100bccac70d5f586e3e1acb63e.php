<?php if (!defined('THINK_PATH')) exit();?><div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="card-box">
					<!-- Row start -->
					<div class="am-g">
						<div class="am-u-sm-12 am-u-md-3">
				          <div class="am-btn-toolbar">
				            <div class="am-btn-group am-btn-group-xs">
				            	<legend>日记列表</legend>
				              <button type="button" class="am-btn am-btn-default plshanc"><span class="am-icon-trash-o"></span> 批量删除</button>
				              <span class="am-btn am-btn-default" style="margin-left:1rem;background-color: #fff;">点赞时间：<?php echo ($zan_time["start_time"]); ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo ($zan_time["end_time"]); ?></span>
				            </div>
				          </div>
				       </div>	
				        <form action="<?php echo U('Admin/Diary/time_diary');?>" method="post" enctype="multipart/form-data">
							<div class="am-u-sm-12 am-u-md-1" style="padding:0;margin-right: 1em;">
					          <div class="am-input-group-sm">
					            <input name="start_time" type="date" class="am-form-field">
					          <span class="am-input-group-btn">
					          </span>
					          </div>
					        </div>
					        <div class="am-u-sm-12 am-u-md-2" style="padding-left:0;float: left;">
					          <div class="am-input-group am-input-group-sm">
					            <input name="end_time" type="date" class="am-form-field">
					          <span class="am-input-group-btn">
					            <button class="am-btn am-btn-default" type="submit">点赞时间设置</button>
					          </span>
					          </div>
					        </div>
				        </form>
						<form action="<?php echo U('Admin/Diary/diary');?>" method="get" enctype="multipart/form-data">
					        <div class="am-u-sm-12 am-u-md-2" style="float: right;padding-left:0;">
					          <div class="am-input-group am-input-group-sm">
					            <input name="diary_title" type="text" class="am-form-field" placeholder="请输入日记标题" >
					          <span class="am-input-group-btn">
					            <button class="am-btn am-btn-default" type="submit">搜索</button>
					          </span>
					          </div>
					        </div>
							 <div class="am-u-sm-12 am-u-md-1" style="float: right;padding:0;margin-right: 1em;">
					          <div class="am-input-group-sm">
					            <input name="username" type="text" class="am-form-field" placeholder="请输入作者名称">
					          <span class="am-input-group-btn">
					          </span>
					          </div>
					        </div>
					        <div class="am-u-sm-12 am-u-md-1" style="float: right;padding:0;margin-right: 1em;">
								<div class="am-input-group-sm">
						          	<select name="home_page" style="height:33px;">
								    	<option value="">-=是否上首页=-</option>
								        <option value="1">否</option>
								        <option value="2">是</option>
									</select>
						        </div>
							</div>
						</form>
				      </div>
					  <!-- Row end -->
					  <style type="text/css">
					  	.tjdaoshouy{
					  		color: #666;
					  		background-color: #eee;
					  	}
					  	.quxiaotuijian{
					  		color: #fff;
					  		background-color: #10C469;
					  	}
					  	.am-btn:hover{
					  		color: #aaa;
    						text-decoration: none;
					  	}
					  	.di{
					  		display: none;
					  	}
					  </style>
					  <!-- Row start -->
					  	<div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox" id="all" name="all" onclick="checkAll()" /></th>
                <th>ID</th>
                <th>作者名字</th>
                <th>学校</th>
                <th>日记标题</th>
                <th>点赞次数</th>
                <th>是否上首页</th>
                <th>操作</th>
              </tr>
              </thead>
              <tbody>
              	<?php if(is_array($diary)): foreach($diary as $key=>$v): ?><tr>
	                <td><input type="checkbox" name="checkname[]" value="<?php echo ($v["id"]); ?>"/></td>
	                <td><?php echo ($v["id"]); ?></td>
	                <td><?php echo ($v["username"]); ?></td>
	                <td><?php echo ($v["school"]); ?></td>
	                <td><?php echo ($v["diary_title"]); ?></td>
	                <td><?php echo ($v["zan"]); ?></td>
	                <td> 
	                	<div class="am-btn am-btn-xs am-text-secondary tjshouye <?php echo $v['home_page']==1?tjdaoshouy:quxiaotuijian;?>" data-id="<?php echo ($v["id"]); ?>" title="点击改变状态" data-ho="<?php echo ($v["home_page"]); ?>"><?php echo ($v["shouye"]); ?></div> 
	                	<div class="am-btn am-btn-xs am-text-secondary youxiuriji <?php echo $v['home_page']==1?di:'';?> <?php echo $v['excellent']==1?tjdaoshouy:quxiaotuijian;?>"  title="点击改变状态" data-id="<?php echo ($v["id"]); ?>" data-ex="<?php echo ($v["excellent"]); ?>">优秀日记</div> 
	                </td>
	                <td>
	                  <div class="am-btn-toolbar">
	                    <div class="am-btn-group am-btn-group-xs">
	                      <div style="background-color: #fff;" class="am-btn am-btn-default am-btn-xs am-text-secondary"><a href="<?php echo U('Admin/Diary/diary_details?did='.$v['id']);?>"><span class="am-icon-pencil-square-o"></span> 查看</a></div>
	                      <div style="background-color: #fff;" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only shanc" data-id="<?php echo ($v["id"]); ?>"><span class="am-icon-trash-o"></span> 删除</div>
	                    </div>
	                  </div>
	                </td>
	              </tr><?php endforeach; endif; ?>
              </tbody>
            </table>
            <div class="am-cf">
              共 <?php echo ($num); ?> 条记录
              <div class="am-fr">
                	<?php echo ($page); ?>
              </div>
            </div>
            <hr />
            <p>注：点赞时间设置，开始时间到结束时间之间添加的日记才能点赞</p>
          </form>
        </div>

      </div>
					  <!-- Row end -->
					  
					</div>
				<script type="text/javascript" src="/Public/Admin/assetsl/js/jquery-2.1.0.js" ></script>
				<script type="text/javascript" src="/Public/Admin/assetsl/js/layer/layer.js" ></script>
				<script type="text/javascript">
					$('.tjshouye').click(function(){
						var did = $(this).attr('data-id');
						var ho = $(this).attr('data-ho');
						if(ho==1){
							var neiro = '是否推荐上首页？';
						}else{
							var neiro = '是否取消首页推荐？';
						}
						layer.confirm(neiro, {
						  btn: ['确定','取消'] //按钮
						}, function(){
							$.ajax({
					            url:"<?php echo U('Admin/Diary/syxiugai');?>",
					            type:"post",
					            data:{
					            	did:did,
					            	ho:ho
					            },
					            success:function(e){
					            	if(e==1){
					            		layer.msg('修改成功！', {icon: 1});
					            		setTimeout(shuax,500);
					            		function shuax(){
					            			window.location.reload();
					            		}
					            	}else{
					            		layer.msg('修改失败！', {icon: 2});
					            	}
					            },
					       	});
						}, function(){
						  
						});
					})
					$('.youxiuriji').click(function(){
						var did = $(this).attr('data-id');
						var ex = $(this).attr('data-ex');
						if(ex==1){
							var neiro = '是否修改为优秀日记？';
						}else{
							var neiro = '是否取消优秀日记？';
						}
						layer.confirm(neiro, {
						  btn: ['确定','取消'] //按钮
						}, function(){
							$.ajax({
					            url:"<?php echo U('Admin/Diary/yxxiugai');?>",
					            type:"post",
					            data:{
					            	did:did,
					            	ex:ex
					            },
					            success:function(e){
					            	if(e==1){
					            		layer.msg('修改成功！', {icon: 1});
					            		setTimeout(shuax,500);
					            		function shuax(){
					            			window.location.reload();
					            		}
					            	}else{
					            		layer.msg('修改失败！', {icon: 2});
					            	}
					            },
					       	});
						}, function(){
						  
						});
					})
					$('.shanc').click(function(){
						var id = $(this).attr('data-id');
						layer.confirm('是否删除该日记信息？', {
						  btn: ['确定','取消'] //按钮
						}, function(){
							$.ajax({
					            url:"<?php echo U('Admin/Diary/shancsp');?>",
					            type:"post",
					            data:{
					            	id:id
					            },
					            success:function(e){
					            	if(e==1){
					            		layer.msg('删除成功！', {icon: 1});
					            		setTimeout(shuax,500);
					            		function shuax(){
					            			window.location.reload();
					            		}
					            	}else{
					            		layer.msg('删除失败！', {icon: 1});
					            	}
					            },
					       	});
						}, function(){
						  
						});
					})
					function checkAll() {
				        var all=document.getElementById('all');  
				        var one=document.getElementsByName('checkname[]');
				        if(all.checked==true){
				            for(var i=0;i<one.length;i++){  
				                one[i].checked=true;  
				            }  
				  
				        }else{  
				            for(var j=0;j<one.length;j++){  
				                one[j].checked=false;  
				            }  
				        }  
				    } 
				    //批量删除
				    $('.plshanc').click(function(){
						var obj=document.getElementsByName('checkname[]'); 
						var str=''; 
						for(var i=0; i<obj.length; i++){ 
							if(obj[i].checked) str+=obj[i].value+','; 
							
						} 
						str = str.substring(0, str.length - 1);
						if(str==''){
							layer.msg('请选择要删除的日记！');
						}else{
							layer.confirm('是否删除选中日记信息？', {
							  btn: ['确定','取消'] //按钮
							}, function(){
								$.ajax({
						            url:"<?php echo U('Admin/Diary/plshanc');?>",
						            type:"post",
						            data:{
						            	id:str
						            },
						            success:function(e){
						            	if(e==1){
						            		layer.msg('删除成功！', {icon: 1});
						            		setTimeout(shuax,500);
						            		function shuax(){
						            			window.location.reload();
						            		}
						            	}else{
						            		layer.msg('删除失败！', {icon: 2});
						            	}
						            },
						       	});
							}, function(){
							  
							});
						}
				    })
				</script>
				
				
				</div>
			

			</div>