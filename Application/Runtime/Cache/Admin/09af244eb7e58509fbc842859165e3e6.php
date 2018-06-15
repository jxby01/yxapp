<?php if (!defined('THINK_PATH')) exit();?><div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="am-g">
					<!-- Row start -->
						<div class="am-u-sm-12">
							<div class="card-box">
								<form action="<?php echo U('Admin/Video/add_spfenl');?>" method="post" enctype="multipart/form-data">
									<input type="hidden" name="vi" id="vi" value="<?php echo ($vi); ?>"/>
									<input type="hidden" name="id" id="id" value="<?php echo ($video["id"]); ?>"/>
								    <legend>视频分类添加</legend>
								    <div class="am-form-group">
								      <label for="doc-vld-name-2">分类标题：</label>
								      <input style="width:100%;height:40px;padding-left: 1em;" value="<?php echo ($video["title"]); ?>" type="text" class="sptitle" name="title"  placeholder="输入视频分类标题"/>
								    </div>
								    <div class="am-form-group">
								      <label for="doc-vld-email-2">分类描述：</label>
								      <textarea style="width:100%;height:100px;" class="spmiaoshu" name="describe" placeholder="输入视频分类描述"><?php echo ($video["describe"]); ?></textarea>
								    </div>
								    <button class="am-btn am-btn-secondary tijiao" type="submit">提交</button>
								</form>
								
							</div>
						</div>
					<!-- Row end -->
				</div>
			</div>
		</div>