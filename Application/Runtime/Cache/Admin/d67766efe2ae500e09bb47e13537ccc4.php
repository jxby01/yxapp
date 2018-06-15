<?php if (!defined('THINK_PATH')) exit();?>
		
	<!--	<div class="am-g">-->
		<!-- ============================================================== -->
		<!-- Start right Content here -->
		<div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="am-g">
					<!-- Row start -->
						<div class="am-u-sm-12">
							<div class="card-box">
								
								<h4 class="header-title m-t-0 m-b-30">添加新闻分类栏目</h4>
								
								<div class="am-g">
									<div class="am-u-md-6">
										<form class="am-form am-text-sm" action="<?php echo U('NewsCloumnLogic/cloumn_add');?>" method="post" enctype="multipart/form-data">
											<div class="am-form-group">
												<div class="am-g">
											      <label class="am-u-md-2 am-md-text-right am-padding-left-0" for="doc-ipt-text-1">栏目名称</label>
											      <input class="am-u-md-10 form-control" name="name" id="doc-ipt-text-1" placeholder="输入栏目名称">
										      </div>
										    </div>
										    
										    <div class="am-form-group">
												<div class="am-g">
											      <label class="am-u-md-2 am-md-text-right am-padding-left-0" for="doc-ipt-text-1">栏目图片</label>
											      <input class="am-u-md-10 form-control" type="file" name="img" accept="image/*" id="doc-ipt-text-1" placeholder="选择上传图片">
										      </div>
										    </div>

											<button type="submit" class="am-btn am-btn-primary">确定</button>

										</form>
									</div>
									
									
							</div>
						</div>
					<!-- Row end -->
				</div>
			
			
			
				<!-- col end -->
				
				
			<!-- row end -->
			
			
			
				<!-- col end -->
				
				
				<!-- col end -->
			</div>
			<!-- row end -->
			
			</div>
		</div>
		<!-- end right Content here -->
		<!--</div>-->
		</div>
		</div>
		
		<!-- navbar -->
		<a href="admin-offcanvas" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"><!--<i class="fa fa-bars" aria-hidden="true"></i>--></a>
		
		<script type="text/javascript" src="../assets/js/jquery-2.1.0.js" ></script>
		<script type="text/javascript" src="../assets/js/amazeui.min.js"></script>
		<script type="text/javascript" src="../assets/js/app.js" ></script>
		<script type="text/javascript" src="../assets/js/blockUI.js" ></script>
	</body>
	
</html>