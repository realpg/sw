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
                <h2 class="title">基本信息编辑</h2>
            </header>
            <hr>
        </section>
        <div class="form-group-col-2">
            <div class="form-label">网站标题：</div>
            <div class="form-cont">
                <input type="text" value="<?php echo ($base_row["base_title"]); ?>" class="form-control form-boxed width-30" name="base_title" id="base_title" />
            </div>
        </div>
        <div class="form-group-col-2">
            <div class="form-label">版权：</div>
            <div class="form-cont">
                <input type="text" value="<?php echo ($base_row["base_copyright"]); ?>" class="form-control form-boxed width-30" name="base_copyright" id="base_copyright" />
            </div>
        </div>
        <div class="form-group-col-2">
            <div class="form-label">备案号：</div>
            <div class="form-cont">
                <input type="text" value="<?php echo ($base_row["base_record"]); ?>" class="form-control form-boxed width-30" name="base_record" id="base_record" />
            </div>
        </div>
        <div class="form-group-col-2">
            <div class="form-label"></div>
            <div class="form-cont">
                <input type="submit" class="btn btn-primary" value="<?php echo CUSTOM_SYSTOM_PUTIN;?>" onclick="edit_base()" />
            </div>
        </div>
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

    
    <div class="mask"></div>
<div class="dialog">
	<div class="dialog-hd">
		<strong class="lt-title"><?php echo CUSTOM_SYSTOM_BAR;?></strong>
		<a class="rt-operate icon-remove JclosePanel" title="<?php echo CUSTOM_SYSTOM_COLSE;?>"></a>
	</div>
	<div class="dialog-bd"><p></p></div>
	<div class="dialog-ft">
		<button class="btn btn-info JyesBtn"><?php echo CUSTOM_SYSTOM_CONFIRM;?></button>
		<button class="btn btn-secondary JnoBtn"><?php echo CUSTOM_SYSTOM_COLSE;?></button>
	</div>
</div>
<dialog class="automatic">
	<span class="icon-volume-down"></span>
</dialog>
    

</body>
</html>