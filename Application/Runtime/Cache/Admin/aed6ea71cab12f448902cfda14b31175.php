<?php if (!defined('THINK_PATH')) exit();?><!--	<div class="am-g">-->
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
                            <legend>权限列表</legend>
                            <button type="button" id="add" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
                            <!-- <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button> -->
                            <!-- <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button> -->
                            <!-- <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button> -->
                        </div>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field">
                        <span class="am-input-group-btn">
				            <button class="am-btn am-btn-default" type="button">搜索</button>
				          </span>
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
                                <th class="table-check"><input type="checkbox" /></th>
								<th class="table-id">ID</th>
								<th class="table-title">权限名称</th>
								<th class="table-type">分布情况</th>
								<th class="table-date am-hide-sm-only">修改日期</th>
								<th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php if(is_array($row)): foreach($row as $key=>$vo): ?><tr>
                                <td><input type="checkbox" /></td>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><a href="javascript:;"><?php echo ($vo["name"]); ?></a></td>
                                <td id="pd"><?php echo ($vo["leavls"]); ?></td>
                                <td class="am-hide-sm-only"><?php echo date('Y年m月d日 H:i',$vo['cre_time']);?></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <div class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="power_edit(<?php echo ($vo["id"]); ?>)"><span class="am-icon-pencil-square-o"></span> 编辑</div>
                                            <div class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="power_del(<?php echo ($vo["id"]); ?>)"><span class="am-icon-trash-o"></span> 删除</div>
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
                       
                    </form>
                </div>

            </div>
            <!-- Row end -->
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/Admin/assetsl/js/jquery-2.1.0.js" ></script>
<script>
$(function(){
	$("#add").click(function(){
		window.location.href="<?php echo U('Admin/Power/power_add');?>";
	})
})

function power_del(id){

	if(id == 3){
		alert('该操作系统不允许！！');return false;
	}else{
        $.ajax({
            type:'post',
            data:{id:id},
            url:'<?php echo U("Admin/Power/power_del");?>',
            success:function(data){
                if(data == 1){
                    alert('删除成功');
                }else{
                    alert('删除出错....');
                }
            }
        })
    }

}

function power_edit(id){
	if(id == 3){
		alert('该操作系统不允许！！');
		return false;
	}else{
        window.location.href="<?php echo U('Admin/Power/power_edit');?>?id="+id;
    }
}
</script>