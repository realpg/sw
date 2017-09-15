<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
<title><?php echo CUSTOM_SYSTOM_WEBTITLE;?></title>
<meta name="author" content="DeathGhost" />
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="icon" href="/sw/Public/Admin/images/icon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/sw/Public/Admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="/sw/Public/Admin/css/supplement.css" />
<script type="text/javascript" src="/sw/Public/Admin/javascript/jquery.js"></script>
<script type="text/javascript" src="/sw/Public/Admin/javascript/plug-ins/customScrollbar.min.js"></script>
<script type="text/javascript" src="/sw/Public/Admin/javascript/plug-ins/echarts.min.js"></script>
<script type="text/javascript" src="/sw/Public/Admin/javascript/plug-ins/layerUi/layer.js"></script>
<script type="text/javascript" src="/sw/Public/Admin/javascript/plug-ins/pagination.js"></script>
<script type="text/javascript" src="/sw/Public/Admin/javascript/public.js"></script>
<script type="text/javascript" src="/sw/Public/Admin/javascript/supplement.js"></script>
    
</head>
<body>
<div class="main-wrap">
    
    <div class="side-nav">
    <div class="side-logo">
        <div class="logo">
				<span class="logo-ico">
					<i class="i-l-1"></i>
					<i class="i-l-2"></i>
					<i class="i-l-3"></i>
				</span>
            <strong><?php echo CUSTOM_SYSTOM_MENU;?></strong>
        </div>
    </div>

    <nav class="side-menu content mCustomScrollbar" data-mcs-theme="minimal-dark">
        <h2>
            <a href="<?php echo U('Admin/Home/index');?>" class="InitialPage"><i class="icon-home"></i><?php echo CUSTOM_SYSTOM_HOME;?></a>
        </h2>
        <ul>
            <li>
                <dl>
                    <dt>
                        <i class="icon-user"></i>用户信息管理<i class="icon-angle-right"></i>
                    </dt>
                    <?php if(($_SESSION['user']['user_id']) == "1"): ?><dd>
                            <a href="<?php echo U('Admin/User/index');?>">用户管理</a>
                        </dd><?php endif; ?>
                    <dd>
                        <a href="<?php echo U('Admin/User/edit');?>">修改密码</a>
                    </dd>
                </dl>
            <li>
            <li>
                <dl>
                    <dt>
                        <i class="icon-user"></i>频道管理<i class="icon-angle-right"></i>
                    </dt>
                    <dd>
                        <a href="">修改密码</a>
                    </dd>
                </dl>
            <li>
            <!--<?php if(is_array($backstage_rows)): $k = 0; $__LIST__ = $backstage_rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$backstage_row): $mod = ($k % 2 );++$k;?>-->
                <!--<li>-->
                    <!--<dl>-->
                        <!--<dt>-->
                            <!--<i class="icon-book"></i><?php echo ($backstage_row["name"]); ?><i class="icon-angle-right"></i>-->
                        <!--</dt>-->
                        <!--<dd>-->
                            <!--<a href="<?php echo U('Admin/Book/index',array('bar_id'=>$backstage_row[id]));?>"><?php echo ($backstage_row["son"]["book"]); ?></a>-->
                        <!--</dd>-->
                        <!--<dd>-->
                            <!--&lt;!&ndash;<a href="/Admin/Statistics/index?bar_id=<?php echo ($backstage_row["id"]); ?>"><?php echo ($backstage_row["son"]["statistics"]); ?></a>&ndash;&gt;-->
                            <!--<a href="<?php echo U('Admin/Statistics/index',array('bar_id'=>$backstage_row[id]));?>"><?php echo ($backstage_row["son"]["statistics"]); ?></a>-->
                        <!--</dd>-->
                    <!--</dl>-->
                <!--<li>-->
            <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
        </ul>
    </nav>
</div>
    
    <div class="content-wrap">
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<header class="top-hd overflow-hidden">
    <div class="hd-lt">
        <a class="icon-reorder"></a>
    </div>
	<div class="hd-rt">
		<ul>
			<li>
				<i class="icon-user"></i><?php echo ($_SESSION['user']['user_name']); ?>
			</li>
			<li>
				<a href="javascript:void(0)" id="JsSignOut"><i class="icon-signout"></i><?php echo CUSTOM_SYSTOM_EXIT;?></a>
			</li>
		</ul>
	</div>
</header>
        
        <main class="main-cont content mCustomScrollbar">
            <!--开始::内容-->
            
    <div class="page-wrap">
        <section class="page-hd">
            <header>
                <h2 class="title"><i class="icon-table"></i>用户列表</h2>
            </header>
            <hr>
        </section>
        <div class="fl">
            <a href="<?php echo U('Admin/User/add');?>" title="<?php echo CUSTOM_SYSTOM_ADD;?>" class="mr-5">
                <button class="btn btn-warning"><i class="icon-plus"></i>添加</button>
            </a>
            <button class="btn btn-danger" id="button_delete" onclick="deleteDo()"><i class="icon-trash"></i>批量删除</button>
        </div>
        <div class="fr input-group mb-15">
            <form action="<?php echo U('Admin/User/index');?>" method="get">
                <input name="searchname" type="text" type="searchname" placeholder="<?php echo ($searchname); ?>" class="form-control form-boxed" style="width:290px;">
                <button class="btn btn-primary">搜索</button>
            </form>
        </div>
        <p class="title-description"></p>
        <form action="<?php echo U('Admin/User/delete');?>" method="post" id="table_data">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th width="10%">
                        <input type="checkbox"  name="mmAll" onclick="All(this, 'mm[]')">
                    </th>
                    <th width="10%">序号</th>
                    <th>用户</th>
                    <th>密码</th>
                    <th width="10%">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($user_rows)): $i = 0; $__LIST__ = $user_rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user_row): $mod = ($i % 2 );++$i;?><tr class="cen">
                        <td>
                            <?php if(($user_row["user_id"]) == "1"): ?>--
                            <?php else: ?>
                                <input type="checkbox" name="mm[]" value="<?php echo ($user_row["user_id"]); ?>" onclick="Item(this, 'mmAll')"><?php endif; ?>
                        </td>
                        <td><?php echo ($i); ?></td>
                        <td><?php echo ($user_row["user_name"]); ?></td>
                        <td>***********************</td>
                        <td>
                            <a href="<?php echo U('Admin/User/edit',array('user_id'=>$user_row[user_id]));?>" title="<?php echo CUSTOM_SYSTOM_EDIT;?>" class="mr-5"><?php echo CUSTOM_SYSTOM_EDIT;?></a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </form>
        <?php if(empty($user_rows)): ?><div class="panel panel-default">
                <div class="panel-bd text-center">
                    <?php echo CUSTOM_MESSAGE_NODATA;?>
                </div>
            </div><?php endif; ?>
        <?php if($user_count > CUSTOM_PAGING): ?><div class="panel panel-default">
                <div class="panel-bd">
                    <div class='pagination'>
                    <?php echo ($page_show); ?>
                    </div>
                </div>
            </div><?php endif; ?>
    </div>

            <!--开始::结束-->
        </main>
        
        <footer class="btm-ft">
	<p class="clear">
		<span class="fl"><?php echo ($company_row["company_copyright"]); ?> <a href="#" title="DeathGhost" target="_blank"><?php echo ($company_row["company_record"]); ?></a></span>
		<span class="fr text-info">
			<em class="uppercase">
				<i class="icon-user"></i>
				技术支持：<a href="" target="_blank">ISART</a>
			</em> 
		</span>
	</p>
</footer>
        
    </div>
</div>

</body>
</html>