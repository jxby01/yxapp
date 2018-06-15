<?php if (!defined('THINK_PATH')) exit();?><div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="card-box">
					<!-- Row start -->
					<div class="am-g">
						<div class="am-u-sm-12 am-u-md-6">
				          <div class="am-btn-toolbar">
				            <div class="am-btn-group am-btn-group-xs">
				            	<legend>视频列表</legend>
				              <button type="button" class="am-btn am-btn-default"><a href="<?php echo U('Admin/Video/add_video?vi=1');?>" style="color: #000;"><span class="am-icon-plus"></span> 新增</a></button>
				              <button type="button" class="am-btn am-btn-default plshanc"><span class="am-icon-trash-o"></span> 删除</button>
				              
				            </div>
				          </div>
				        </div>	
				        
						<form action="<?php echo U('Admin/Video/video');?>" method="post" enctype="multipart/form-data">
							
					        <div class="am-u-sm-12 am-u-md-3" style="float: right;">
					          <div class="am-input-group am-input-group-sm">
					            <input name="title" type="text" placeholder="请输入视频标题" class="am-form-field">
					          <span class="am-input-group-btn">
					            <button class="am-btn am-btn-default" type="submit">搜索</button>
					          </span>
					          </div>
					        </div>
					        
					        <div class="am-u-sm-12 am-u-md-2" style="float: right;margin-right: 1em;">
								<div class="am-input-group am-input-group-sm">
						          	<select name="classify" style="height:33px;">
								    	<option value="">-=请选择一项=-</option>
								    	<?php if(is_array($vifl)): foreach($vifl as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
									</select>
						        </div>
							</div>
						
						</form>
				      </div>
					  <!-- Row end -->
					  
					  <!-- Row start -->
					  	<div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox" id="all" name="all" onclick="checkAll()" /></th>
                <th class="table-id">ID</th>
                <th class="table-title">标题</th>
                <th class="table-type">类别名称</th>
                <th class="table-author am-hide-sm-only">视频描述</th>
                <th class="table-date am-hide-sm-only">添加日期</th>
                <th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
              
             	<?php if(is_array($video)): foreach($video as $key=>$v): ?><tr>
	                <td><input type="checkbox" name="checkname[]" value="<?php echo ($v["id"]); ?>"/></td>
	                <td><?php echo ($v["id"]); ?></td>
	                <td><?php echo ($v["title"]); ?></td>
	                <td><?php echo ($v["neibie"]); ?></td>
	                <td class="am-hide-sm-only"><?php echo ($v["describe"]); ?></td>
	                <td class="am-hide-sm-only"><?php echo date('Y-m-d H:i',$v['add_time']); ?></td>
	                <td>
	                  <div class="am-btn-toolbar">
	                    <div class="am-btn-group am-btn-group-xs">
	                      <div style="background-color: #fff;" class="am-btn am-btn-default am-btn-xs am-text-secondary"><a href="<?php echo U('Admin/Video/add_video?vi=2&vid='.$v['id']);?>"><span class="am-icon-pencil-square-o"></span> 编辑</a></div>
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
            
          </form>
        </div>

      </div>
					  <!-- Row end -->
					  
					</div>
				<script type="text/javascript" src="/Public/Admin/assetsl/js/jquery-2.1.0.js" ></script>
				<script type="text/javascript" src="/Public/Admin/assetsl/js/layer/layer.js" ></script>
				<script type="text/javascript">
					$('.shanc').click(function(){
						var id = $(this).attr('data-id');
						layer.confirm('是否删除该视频信息？', {
						  btn: ['确定','取消'] //按钮
						}, function(){
							$.ajax({
					            url:"<?php echo U('Admin/Video/shancsp');?>",
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
							layer.msg('请选择要删除的视频内容！');
						}else{
							layer.confirm('是否删除选中视频信息？', {
							  btn: ['确定','取消'] //按钮
							}, function(){
								$.ajax({
						            url:"<?php echo U('Admin/Video/plshanc');?>",
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