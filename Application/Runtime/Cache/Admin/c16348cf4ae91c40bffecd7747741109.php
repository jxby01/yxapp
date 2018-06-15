<?php if (!defined('THINK_PATH')) exit();?><div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="card-box">
					<!-- Row start -->
					<div class="am-g">
						<div class="am-u-sm-12 am-u-md-6">
				          <div class="am-btn-toolbar">
				            <div class="am-btn-group am-btn-group-xs">
				            	<legend>视频分类列表</legend>
				              <button type="button" class="am-btn am-btn-default"><a href="<?php echo U('Admin/Video/add_videofenl?vi=1');?>" style="color: #000;"><span class="am-icon-plus"></span> 新增</a></button>
				              <!--<button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>-->
				              
				            </div>
				          </div>
				        </div>	

				      </div>
					  <!-- Row end -->
					  
					  <!-- Row start -->
					  	<div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <!--<th class="table-check"><input type="checkbox" /></th>-->
                <th class="table-id">ID</th>
                <th class="table-title">标题</th>
                <th class="table-author am-hide-sm-only">分类描述</th>
                <th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
             	<?php if(is_array($video)): foreach($video as $key=>$v): ?><tr>
	                <!--<td><input type="checkbox" /></td>--> 
	                <td><?php echo ($v["id"]); ?></td>
	                <td><?php echo ($v["title"]); ?></td>
	                <td class="am-hide-sm-only"><?php echo ($v["describe"]); ?></td>
	                <td>
	                  <div class="am-btn-toolbar">
	                    <div class="am-btn-group am-btn-group-xs">
	                      <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><a href="<?php echo U('Admin/Video/add_videofenl?vi=2&vid='.$v['id']);?>"><span class="am-icon-pencil-square-o"></span> 编辑</a></button>
	                      <div style="background-color: #fff;" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only shanc" data-id="<?php echo ($v["id"]); ?>"><span class="am-icon-trash-o"></span> 删除</div>
	                    </div>
	                  </div>
	                </td>
	              </tr><?php endforeach; endif; ?>
              </tbody>
            </table>
            <div class="am-cf">
              共 <?php echo ($num); ?> 条记录
              
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
						layer.confirm('是否删除该视频分类信息？', {
						  btn: ['确定','取消'] //按钮
						}, function(){
							$.ajax({
					            url:"<?php echo U('Admin/Video/shancspfl');?>",
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
					            		layer.msg('删除失败！', {icon: 2});
					            	}
					            },
					       	});
						}, function(){
						  
						});
					})
				</script>
				
				
				</div>
			

			</div>