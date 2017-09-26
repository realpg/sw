<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($base_row["base_title"]); ?></title>
    <link rel="stylesheet" type="text/css" href="/sw/Public/Home/css/index.css" />
    <script type="text/javascript" src="/sw/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/sw/Public/Home/js/index.js"></script>
</head>
<body>
    <div class="body" id="body">
        <!--左侧频道栏-->
        <div class="left">
            <div class="logo"><img src="/sw/Public/Images/logo.png"  /></div>
            <div class="search">
                <div class="search-input">
                    <form action="<?php echo U('Home/Index/index');?>" method="post" id="searchChannel">
                        <input type="text" name="searchname" id="searchname" value="<?php echo ($searchname); ?>" />
                    </form>
                </div>
                <div class="search-button" onclick="search()"><img src="/sw/Public/Images/search.png" /></div>
            </div>
            <div class="title">频道</div>
            <div class="channel">
                <ul id="channel">
                    <?php if(is_array($channel_rows)): $i = 0; $__LIST__ = $channel_rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel_row): $mod = ($i % 2 );++$i;?><a href="javascript:void(0)" onclick="playvideo(<?php echo ($channel_row["channel_id"]); ?>)">
                            <?php if($channel_row["channel_id"] == $channel_id): ?><li style="background: #fff;">
                                    <?php echo ($channel_row["channel_title"]); ?>
                                </li>
                                <?php else: ?>
                                <li><?php echo ($channel_row["channel_title"]); ?></li><?php endif; ?>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <!--中间视频区-->
        <div class="main" id="main">
            <iframe id="iframe"allowfullscreen="" frameborder="0" width="100%" height="100%" scrolling="no" marginheight="0" marginwidth="0" margintop="0" marginbottom="0" border="0" src="<?php echo ($channel_link); ?>"></iframe>
        </div>
        <!--右侧节目单-->
        <div class="right">
            <div class="tab">
                <div class="tab-time">节目</div>
            </div>
            <div class="content">
                <div class="content-time" id="content-time"></div>
                <div class="program">
                    <ul id="program">
                        <?php if(is_array($program_rows)): $i = 0; $__LIST__ = $program_rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$program_row): $mod = ($i % 2 );++$i;?><li><?php echo ($program_row["program_content"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="source" id="source">-->
        <!--视频来源：<?php echo ($channel_link); ?>-->
    <!--</div>-->
</body>
</html>