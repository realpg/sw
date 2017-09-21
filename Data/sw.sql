# Host: 127.0.0.1  (Version: 5.5.5-10.1.8-MariaDB)
# Date: 2017-09-20 17:59:50
# Generator: MySQL-Front 5.3  (Build 4.271)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "base"
#

CREATE TABLE `base` (
  `base_id` int(11) NOT NULL AUTO_INCREMENT,
  `base_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `base_logo` varchar(255) DEFAULT NULL COMMENT 'LOGO',
  `base_copyright` varchar(255) DEFAULT NULL COMMENT '版权',
  `base_record` varchar(255) DEFAULT NULL COMMENT '备案号',
  PRIMARY KEY (`base_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='基本信息表';

#
# Data for table "base"
#

INSERT INTO `base` VALUES (1,'视网',NULL,'@2016-2017 视网版权所有','备案中...');

#
# Structure for table "channel"
#

CREATE TABLE `channel` (
  `channel_id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `channel_link` varchar(255) DEFAULT NULL COMMENT '直播源链接',
  `channel_link_m` varchar(255) DEFAULT NULL COMMENT '手机版视频源链接',
  `channel_sort` int(11) DEFAULT NULL COMMENT '排序（越大越靠前）',
  `channel_show` int(11) DEFAULT NULL COMMENT '是否显示（0否；1是）',
  `channel_web` text COMMENT '节目单采集页面',
  `channel_rule` text COMMENT '节目单采集规则',
  PRIMARY KEY (`channel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COMMENT='频道表';

#
# Data for table "channel"
#

INSERT INTO `channel` VALUES (1,'CCTV-1','http://www.haotv8.com/hnws/fyzb.php?name=cctv1','http://r.gslb.lecloud.com/live/hls/201706223000000b899/desc.m3u8',0,1,NULL,NULL),(2,'CCTV-2','http://www.haotv8.com/hnws/fyzb.php?name=cctv2','http://r.gslb.lecloud.com/live/hls/201706223000000bc99/desc.m3u8',0,1,NULL,NULL),(3,'CCTV-3','http://www.haotv8.com/hnws/fyzb.php?name=cctv3','http://r.gslb.lecloud.com/live/hls/201706223000000bf99/desc.m3u8',0,1,NULL,NULL),(4,'CCTV-4','http://www.haotv8.com/hnws/fyzb.php?name=cctv4','http://r.gslb.lecloud.com/live/hls/201706223000000bk99/desc.m3u8',0,1,NULL,NULL),(5,'CCTV-4美洲频道','','http://cctv.cntv.cdnpe.com/cntvlive/cctvamerica.m3u8?AUTH=3WptX36bhyqPQNmRz0EakYl5UVvW+WV643rYRKx3A9h5d4/LNRsH/GH1hSFv3+7LVzHtONit3anu+erBUlCL6A==',0,1,NULL,NULL),(6,'CCTV-4欧洲频道','','http://cctv.cntv.cdnpe.com/cntvlive/cctveurope.m3u8?AUTH=WWWTCR17fgFDkuoXZh3Flr9RIYVzEeCHg2fz3tg23W0vY39q45VDdDj7nnRh6fjG607udJM1s3yNkkHXvk+/Cw==',0,1,NULL,NULL),(7,'CCTV-5','http://www.haotv8.com/hnws/fyzb.php?name=cctv5','http://r.gslb.lecloud.com/live/hls/201706223000000bp99/desc.m3u8',0,1,NULL,NULL),(8,'CCTV-5+频道','','http://api_p.tll888.com/v/cctv5p.php',0,1,NULL,NULL),(9,'CCTV-6',' http://ivi.bupt.edu.cn/player.html?channel=cctv6hd','http://r.gslb.lecloud.com/live/hls/201706223000000br99/desc.m3u8',0,1,NULL,NULL),(10,'CCTV-7','http://www.haotv8.com/hnws/fyzb.php?name=cctv7','http://r.gslb.lecloud.com/live/hls/201706223000000bu99/desc.m3u8',0,1,NULL,NULL),(11,'CCTV-8','http://www.haotv8.com/hnws/fyzb.php?name=cctv8','http://r.gslb.lecloud.com/live/hls/201706223000000bv99/desc.m3u8',0,1,NULL,NULL),(12,'CCTV-9','http://www.haotv8.com/hnws/fyzb.php?name=cctv9','http://r.gslb.lecloud.com/live/hls/201706223000000bz99/desc.m3u8',0,1,NULL,NULL),(13,'CCTV-10','http://www.haotv8.com/hnws/fyzb.php?name=cctv10','http://r.gslb.lecloud.com/live/hls/201706223000000c199/desc.m3u8',0,1,NULL,NULL),(14,'CCTV-11','http://www.haotv8.com/hnws/fyzb.php?name=cctv11','http://r.gslb.lecloud.com/live/hls/201706223000000c499/desc.m3u8',0,1,NULL,NULL),(15,'CCTV-12','http://www.haotv8.com/hnws/fyzb.php?name=cctv12','http://r.gslb.lecloud.com/live/hls/201706223000000c599/desc.m3u8',0,1,NULL,NULL),(16,'CCTV-13','http://www.haotv8.com/hnws/fyzb.php?name=cctv13','http://r.gslb.lecloud.com/live/hls/201706223000000c699/desc.m3u8',0,1,NULL,NULL),(17,'CCTV-14','http://www.haotv8.com/hnws/fyzb.php?name=cctv14','http://cctv.cntv.cdnpe.com/cntvlive/cctvchild.m3u8?AUTH=1jGhl6cLOtJZ8aN9ZiMYaTwZSNGmPG05fU87TAKs8iZUg2VdCPXq7z78S1W7Llp9NZC8aBkuFemZM5urF3j/3g==',0,1,NULL,NULL),(18,'CCTV-15','http://www.haotv8.com/hnws/fyzb.php?name=cctv15','http://api_p.tll888.com/v/shyd.php?id=cctv15',0,1,NULL,NULL),(19,'重庆卫视','','http://api_p.tll888.com/v/iptv.php?id=cqws',0,1,NULL,NULL),(20,'浙江卫视','','http://r.gslb.lecloud.com/live/hls/2017062230000006q99/desc.m3u8',0,1,NULL,NULL),(21,'云南卫视','','http://183.252.176.24/PLTV/88888888/224/3221225853/index.m3u8',0,1,NULL,NULL),(22,'新疆卫视','','http://playback-livehyuwxjtv122qn.sobeycache.com/sobeylive/xjtv1.m3u8',0,1,NULL,NULL),(23,'西藏卫视','','http://183.252.176.24/PLTV/88888888/224/3221225854/index.m3u8',0,1,NULL,NULL),(24,'天津卫视','','http://api_p.tll888.com/v/qq.php?id=tjwshd',0,1,NULL,NULL),(25,'四川卫视','','http://api_p.tll888.com/migu.php?id=608880878',0,1,NULL,NULL),(26,'四川康巴卫视','','http://117.169.120.193:8080/PLTV/88888888/224/3221225683/index.m3u8',0,1,NULL,NULL),(27,'深圳卫视','','http://r.gslb.lecloud.com/live/hls/201706223000000cz99/desc.m3u8',0,1,NULL,NULL),(28,'陕西卫视','','http://183.58.12.204:30001/PLTV/88888956/224/3221227722/1.m3u8',0,1,NULL,NULL),(29,'山西卫视','','http://wstv.cntv.dnion.com/live/no/194_/seg0/index.m3u8?ptype=1&amp;amp;amode=1&amp;amp;AUTH=cYoelAafF91AwA2RNld6/MRsKlnoWUYZL9ZX6i6oPucGZwcpFH5qwQZARmMcKeaCTM3o1AR6BCDiN6vKj/QVPQ==',0,1,NULL,NULL),(30,'山东卫视','','http://r.gslb.lecloud.com/live/hls/201706223000000de99/desc.m3u8',0,1,NULL,NULL),(31,'厦门卫视','','http://183.58.12.204:30001/PLTV/88888956/224/3221227760/1.m3u8',0,1,NULL,NULL),(32,'三沙卫视 ','','http://live.hnntv.cn:1935/live/ssws_bq/chunklist.m3u8',0,1,NULL,NULL),(33,'青海卫视','','http://api_p.tll888.com/migu.php?id=608915204',0,1,NULL,NULL),(34,'宁夏卫视 ','','http://api_p.tll888.com/migu.php?id=608914867',0,1,NULL,NULL),(35,'内蒙古卫视','','http://api_p.tll888.com/migu.php?id=608914971',0,1,NULL,NULL),(36,'南方卫视','','http://r.gslb.lecloud.com/live/hls/201612083000002is99/desc.m3u8',0,1,NULL,NULL),(37,'旅游卫视','','http://stream1.hnntv.cn/lywsgq/sd/live.m3u8?_upt=?ts',0,1,NULL,NULL),(38,'辽宁卫视 ','','http://183.207.249.14/PLTV/3/224/3221225566/index.m3u8',0,1,NULL,NULL),(39,'江西卫视','','http://223.110.245.171/PLTV/3/224/3221225536/index.m3u8',0,1,NULL,NULL),(40,'江苏卫视','','http://r.gslb.lecloud.com/live/hls/201706223000000dh99/desc.m3u8',0,1,NULL,NULL),(41,'吉林卫视','','http://api_p.tll888.com/migu.php?id=609020981',0,1,NULL,NULL),(42,'湖南卫视','http://r.gslb.lecloud.com/live/hls/201706223000000cf99/desc.m3u8','http://219.146.248.44/live/5/30/e9301e073cf94732a380b765c8b9573d.m3u8?type=web.cloudplay',0,1,NULL,NULL),(43,'湖北卫视','','http://183.58.12.204:30001/PLTV/88888905/224/3221227495/1.m3u8',0,1,NULL,NULL),(44,'黑龙江卫视','','http://api_p.tll888.com/v/qq.php?id=hljwshd',0,1,NULL,NULL),(45,'河南卫视','','http://api_p.tll888.com/v/hatv.php?id=haws',0,1,NULL,NULL),(46,'河北卫视','','http://weblive.hebtv.com/live/hbws_bq/index.m3u8',0,1,NULL,NULL),(47,'海峡卫视','','http://acm.gg/live/fujianhxhd.m3u8',0,1,NULL,NULL),(48,'贵州卫视','','http://api_p.tll888.com/v/qq.php?id=gzws',0,1,NULL,NULL),(49,'广西卫视','','http://wstv.cntv.cdnpe.com/cntvlive/guangximd.m3u8?AUTH=C2dKQn9rUVmvvTq5vamuKciJuf0GFff0fvVx/M6jmd77J6c4dphc9E9CDTgc1YAbHiZfgoOS4aBnnd4FJ3SjBw==',0,1,NULL,NULL),(50,'广东卫视','','http://183.58.12.204:30001/PLTV/88888905/224/3221227499/2.m3u8',0,1,NULL,NULL),(51,'甘肃卫视','','http://api_p.tll888.com/migu.php?id=608907550',0,1,NULL,NULL),(52,'东南卫视','','http://api_p.tll888.com/v/fjtv.php?id=dnwshd',0,1,NULL,NULL),(53,'东方卫视','','http://r.gslb.lecloud.com/live/hls/201706223000000d099/desc.m3u8',0,1,NULL,NULL),(54,'兵团卫视','','http://v.btzx.com.cn:1935/live/weishi.stream/playlist.m3u8',0,1,NULL,NULL),(55,'安徽卫视','','http://api_p.tll888.com/v/iptv.php?id=ahwshd',0,1,NULL,NULL),(56,'btv北京卫视 ','','http://r.gslb.lecloud.com/live/hls/201706223000000dl99/desc.m3u8',0,1,NULL,NULL),(57,'上海五星体育频道','','http://hls.mv.dftoutiao.com/live/gssports1/playlist.m3u8?t=1505318404',0,1,NULL,NULL),(58,'山东电视体育频道','','',0,1,NULL,NULL),(59,'劲爆体育','','http://27.148.240.208/PLTV/88888888/224/3221225989/1.m3u8',0,1,NULL,NULL),(60,'新视觉高清体育','','',0,1,NULL,NULL),(61,'广东体育','','http://api_p.tll888.com/v/iptv.php?id=gdtyhd',0,1,NULL,NULL),(62,'cctv足球风云','','http://api_p.tll888.com/v/migu.php?id=fyzq',0,1,NULL,NULL);

#
# Structure for table "program"
#

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_content` varchar(255) DEFAULT NULL COMMENT '内容',
  `program_level` int(11) DEFAULT NULL COMMENT '分组',
  `program_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '采集的时间',
  PRIMARY KEY (`program_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='节目单表';

#
# Data for table "program"
#

INSERT INTO `program` VALUES (1,'123',2,'2017-09-18 10:57:03'),(3,'123456789',2,'2017-09-18 11:39:18');

#
# Structure for table "user"
#

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL COMMENT '标题',
  `user_password` varchar(255) DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3'),(10,'test','098f6bcd4621d373cade4e832627b4f6');
