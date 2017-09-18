# Host: 127.0.0.1  (Version: 5.5.5-10.1.8-MariaDB)
# Date: 2017-09-18 11:41:55
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
  `channel_sort` int(11) DEFAULT NULL COMMENT '排序（越大越靠前）',
  `channel_show` int(11) DEFAULT NULL COMMENT '是否显示（0否；1是）',
  PRIMARY KEY (`channel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='频道表';

#
# Data for table "channel"
#

INSERT INTO `channel` VALUES (1,'CCTV-1',1,1),(2,'CCTV-2',0,0);

#
# Structure for table "program"
#

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `program_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '播放时间',
  `program_video` varchar(255) DEFAULT NULL COMMENT '视频',
  `program_level` int(11) DEFAULT NULL COMMENT '分组',
  `program_sort` int(11) DEFAULT NULL COMMENT '排序（越大越靠前）',
  `program_show` int(11) DEFAULT NULL COMMENT '是否显示（0否；1是）',
  PRIMARY KEY (`program_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='节目表';

#
# Data for table "program"
#

INSERT INTO `program` VALUES (1,'新闻联播','2017-09-18 10:57:03','123',2,999,1),(3,'法治在线','2017-09-18 11:39:18','123456789',2,666,0);

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
