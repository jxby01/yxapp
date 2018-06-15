<?php if (!defined('THINK_PATH')) exit();?><div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="am-g">
					<!-- Row start -->
						<div class="am-u-sm-12">
							<div class="card-box">
							    <legend class="biaoqt">日记详情</legend>
							    <div class="am-form-group" style="text-align: center;font-size: 30px;">
							      <label for="doc-vld-name-2"><span style="color: #666;"><?php echo ($di["diary_title"]); ?></span></label>
							    </div>
							    <div class="am-form-group" style="text-align: center;font-size: 13px;">
							      <label for="doc-vld-name-2" style="color: #666;">名称：<span style="color: #aaa;"><?php echo ($di["username"]); ?></span></label>
							      <label for="doc-vld-name-2">&nbsp;&nbsp;|&nbsp;&nbsp;</label>
							      <label for="doc-vld-name-2" style="color: #666;">时间：<span style="color: #aaa;"><?php echo ($di["add_time"]); ?></span></label>
							    </div>
							    <div class="am-form-group" style="text-align: center;font-size: 13px;">
							      <label for="doc-vld-name-2" style="color: #aaa;">学校：<span style="color: #666;"><?php echo ($di["school"]); ?></span></label>
							      <label for="doc-vld-name-2">&nbsp;&nbsp;|&nbsp;&nbsp;</label>
							      <label for="doc-vld-name-2" style="color: #aaa;">老师推荐：<span style="color: #666;"><?php echo ($di["recommend"]); ?></span></label>
							      <label for="doc-vld-name-2">&nbsp;&nbsp;|&nbsp;&nbsp;</label>
							      <label for="doc-vld-name-2" style="color: #aaa;">推荐首页：<span style="color: #666;"><?php echo ($di["home_page"]); ?></span></label>
							      <label for="doc-vld-name-2">&nbsp;&nbsp;|&nbsp;&nbsp;</label>
							      <label for="doc-vld-name-2" style="color: #aaa;">优秀日记：<span style="color: #666;"><?php echo ($di["excellent"]); ?></span></label>
							    </div>
							    <div class="am-form-group" style="width: 85%;margin: auto;text-indent:35px"><?php echo ($di["content"]); ?></div>
							</div>
						</div>
					<!-- Row end -->
				</div>
				<script type="text/javascript" src="/Public/Admin/assetsl/js/jquery-2.1.0.js" ></script>
				
			</div>
		</div>