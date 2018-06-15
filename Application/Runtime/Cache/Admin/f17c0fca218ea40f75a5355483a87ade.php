<?php if (!defined('THINK_PATH')) exit();?>
		
	<!--	<div class="am-g">-->
		<!-- ============================================================== -->
		<!-- Start right Content here -->
		<div class="content-page">
			<!-- Start content -->
			<div class="content">
				<div class="card-box">
					<!-- Row start -->
					<div class="am-g">
						<div class="am-u-sm-12 am-u-md-6">
				          <div class="am-btn-toolbar">
				            <div class="am-btn-group am-btn-group-xs">
				              <button type="button" class="am-btn am-btn-default"><a href="<?php echo U('NewsCloumn/cloumn_add');?>"> <span class="am-icon-plus"></span>新增</a></button>
				              <button onclick="sort()" type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 排序</button>
				              <!-- <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button> -->
				              <button type="button" class="am-btn am-btn-default plshanc"><span class="am-icon-trash-o"></span> 删除</button>
				            </div>
				          </div>
				        </div>	
				        
						    <!-- <div class="am-u-sm-12 am-u-md-3">
                  <form action="" me>
  				          <div class="am-input-group am-input-group-sm">
  				            <input type="text" class="am-form-field">
    				          <span class="am-input-group-btn">
    				            <button class="am-btn am-btn-default" type="button">搜索</button>
    				          </span>
  				          </div>
                  </form>
				        </div> -->
				      </div>
					  <!-- Row end -->
					  
					  <!-- Row start -->
					  	<div class="am-g">
        <div class="am-u-sm-12">
          <!-- <form class="am-form"> -->
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox" id="all" name="all" onclick="checkAll()" /></th>
                <th class="table-id">ID</th>
                <th class="table-title">栏目名称</th>
                <th class="table-type">权重排序</th>
                <th class="table-author am-hide-sm-only">操作者</th>
                <th class="table-date am-hide-sm-only">修改日期</th>
               <th class="table-set">操作</th>
              </tr>
              </thead>
              <?php if(is_array($cloumn_list)): foreach($cloumn_list as $key=>$val): ?><tr>
                <td><input type="checkbox" name="checkname[]" value="<?php echo ($val['news_cloumn_id']); ?>" /></td>
                <td><?php echo ($val['news_cloumn_id']); ?></td>
                <td><?php echo ($val['name']); ?></td>
                <td><input style="max-width: 60px;max-height: 26px;" value="<?php echo ($val['sort']); ?>" name="sort" data-id="<?php echo ($val['news_cloumn_id']); ?>" type="number" width="" /></td>
                <td class="am-hide-sm-only"><?php echo ($val['admin_name']); ?></td>
                <td class="am-hide-sm-only"><?php echo date("Y-m-d H:i:s",$val['starttime']);?></td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <a href="<?php echo U('NewsCloumn/cloumn_eitd');?>?news_cloumn_id=<?php echo ($val['news_cloumn_id']); ?>"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button></a>
                      <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                      <button data-id="<?php echo ($val['news_cloumn_id']); ?>" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only shanc"><span class="am-icon-trash-o"></span> 删除</button>
                    </div>
                  </div>
                </td>
              </tr><?php endforeach; endif; ?>
              </tbody>
            </table>
            <div class="am-cf">
              共 <?php echo ($count); ?> 条记录
              <div class="am-fr">
                <?php echo ($page); ?>
              </div>
            </div>
            <hr />
            <p>注：.....</p>
          <!-- </form> -->
        </div>

      </div>
					  <!-- Row end -->
					  
					</div>
				
				
				
				
				</div>
			

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
    <script type="text/javascript" src="/Public/Admin/assetsl/js/jquery-2.1.0.js" ></script>
    <script type="text/javascript" src="/Public/Admin/assetsl/js/layer/layer.js" ></script>
    <script type="text/javascript">
      //设置权重
      function sort(){
        var winputs=document.getElementsByName('sort');

        var data=new Object();
        for(var i=0;i<winputs.length;i++){
          var id=winputs[i].getAttribute("data-id");
          var weight=winputs[i].value;
          data[id] = weight;
        }
        // data=JSON.stringify(data);
        // console.log(data);
        $.ajax({
          url:"<?php echo U('NewsCloumnLogic/cloumn_sort');?>",
          type:"post",
          data:{
            data:data
          },
          success:function(e){
            console.log(e)
            layer.msg(e, {icon: 1});
            setTimeout(shuax,1000);
            function shuax(){
              window.location.reload();
            }
          },
        });
      }
      //单条删除
      $('.shanc').click(function(){
        var id = $(this).attr('data-id');
        layer.confirm('是否删除该条新闻栏目信息？', {
          btn: ['确定','取消'] //按钮
        }, function(){
          $.ajax({
                  url:"<?php echo U('NewsCloumnLogic/cloumn_del');?>",
                  type:"post",
                  data:{
                    news_cloumn_id:id
                  },
                  success:function(e){
                    console.log(e)
                    if(e>0){
                      layer.msg('删除成功！', {icon: 1});
                      setTimeout(shuax,1000);
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
        layer.msg('请选择要删除的新闻栏目内容！');
      }else{
        layer.confirm('是否删除选中新闻栏目信息？', {
          btn: ['确定','取消'] //按钮
        }, function(){
          $.ajax({
                  url:"<?php echo U('NewsCloumnLogic/cloumn_alldel');?>",
                  type:"post",
                  data:{
                    id:str
                  },
                  success:function(e){
                    console.log(e)
                    if(e>0){
                      layer.msg('删除成功！', {icon: 1});
                      setTimeout(shuax,700);
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
	</body>
	
</html>