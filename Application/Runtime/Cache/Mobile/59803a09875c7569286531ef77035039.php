<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($base_row["base_title"]); ?></title>
    <link rel="stylesheet" type="text/css" href="/sw/Public/Mobile/css/index.css" />
</head>
<body>
<div class="header">
    <div class="top">
        <img src="/sw/Public/Images/logo.png" class="logo" />
    </div>
    <div class="video">
        <iframe height="500px" frameborder="0" width="100%" scrolling="no" marginheight="0" marginwidth="0" border="0" src="<?php echo ($channel_link); ?>"></iframe>
        <div class="source">
            视频来源：<?php echo ($channel_link); ?>
        </div>
    </div>
    <div class="title">频道</div>
</div>
<div class="channel">
    <ul>
        <?php if(is_array($channel_rows)): $i = 0; $__LIST__ = $channel_rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel_row): $mod = ($i % 2 );++$i;?><a href="?id=<?php echo ($channel_row["channel_id"]); ?>">
                <?php if($channel_row["channel_id"] == $channel_id): ?><li style="background: #fff;"><?php echo ($channel_row["channel_title"]); ?></li>
                <?php else: ?>
                    <li><?php echo ($channel_row["channel_title"]); ?></li><?php endif; ?>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
<div class="footer"><?php echo ($base_row["base_copyright"]); ?> <?php echo ($base_row["base_record"]); ?></div>
</body>
</html>