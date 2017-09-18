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
                        <i class="icon-cog"></i>基本信息管理<i class="icon-angle-right"></i>
                    </dt>
                    <dd>
                        <a href="<?php echo U('Admin/Base/edit');?>">修改基本信息</a>
                    </dd>
                </dl>
            <li>
            <li>
                <dl>
                    <dt>
                        <i class="icon-play"></i>频道管理<i class="icon-angle-right"></i>
                    </dt>
                    <dd>
                        <a href="<?php echo U('Admin/Channel/index');?>">频道管理</a>
                    </dd>
                </dl>
            <li>
            <!--<li>-->
                <!--<dl>-->
                    <!--<dt>-->
                        <!--<i class="icon-play"></i>视频管理<i class="icon-angle-right"></i>-->
                    <!--</dt>-->
                    <!--<dd>-->
                        <!--<a href="<?php echo U('Admin/Program/index');?>">视频管理</a>-->
                    <!--</dd>-->
                <!--</dl>-->
            <!--<li>-->
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
                <h2 class="title"><i class="icon-table"></i>频道列表</h2>
            </header>
            <hr>
        </section>
        <div class="fl">
            <a href="<?php echo U('Admin/Channel/add');?>" class="mr-5">
                <button class="btn btn-warning"><?php echo CUSTOM_SYSTOM_ADD;?></button>
            </a>
            <button class="btn btn-danger" id="button_delete" onclick="deleteDo()"><?php echo CUSTOM_SYSTOM_DELETEALL;?></button>
        </div>
        <div class="fr input-group mb-15">
            <form action="<?php echo U('Admin/Channel/index');?>" method="get">
                <input name="searchname" type="text" type="searchname" placeholder="<?php echo ($searchname); ?>" class="form-control form-boxed" style="width:290px;">
                <button class="btn btn-primary">搜索</button>
            </form>
        </div>
        <p class="title-description"></p>
        <form action="<?php echo U('Admin/Channel/delete');?>" method="post" id="table_data">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th width="10%">
                        <input type="checkbox"  name="mmAll" onclick="All(this, 'mm[]')">
                    </th>
                    <th width="10%">序号</th>
                    <th>标题</th>
                    <th>状态</th>
                    <th width="10%">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($channel_rows)): $i = 0; $__LIST__ = $channel_rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel_row): $mod = ($i % 2 );++$i;?><tr class="cen">
                        <td>
                            <input type="checkbox" name="mm[]" value="<?php echo ($channel_row["channel_id"]); ?>" onclick="Item(this, 'mmAll')">
                        </td>
                        <td><?php echo ($i); ?></td>
                        <td><?php echo ($channel_row["channel_title"]); ?></td>
                        <td>
                            <?php if(($channel_row["channel_show"]) == "1"): ?>显示
                            <?php else: ?>
                                隐藏<?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo U('Admin/Channel/edit',array('channel_id'=>$channel_row[channel_id]));?>" title="<?php echo CUSTOM_SYSTOM_EDIT;?>" class="mr-5"><?php echo CUSTOM_SYSTOM_EDIT;?></a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </form>
        <?php if(empty($channel_rows)): ?><div class="panel panel-default">
                <div class="panel-bd text-center">
                    <?php echo CUSTOM_MESSAGE_NODATA;?>
                </div>
            </div><?php endif; ?>
        <?php if($channel_count > CUSTOM_PAGING): ?><div class="panel panel-default">
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