/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : luru

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-20 10:17:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bfdyt_log
-- ----------------------------
DROP TABLE IF EXISTS `bfdyt_log`;
CREATE TABLE `bfdyt_log` (
  `bfdyt_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `bfdyt_username` varchar(10) DEFAULT NULL COMMENT '登录的用户名',
  `bfdyt_userid` int(11) unsigned DEFAULT NULL,
  `bfdyt_logintime` bigint(20) unsigned DEFAULT NULL COMMENT '登录时间',
  `bfdyt_status` enum('1','0') DEFAULT '0' COMMENT '是否登录成功',
  `bfdyt_ip` varchar(255) DEFAULT NULL COMMENT '登录的ip',
  PRIMARY KEY (`bfdyt_id`),
  KEY `ipindex` (`bfdyt_ip`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bfdyt_log
-- ----------------------------
INSERT INTO `bfdyt_log` VALUES ('1', 'admins', '0', '1504593563', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('3', 'admins', '0', '1504593651', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('4', 'admins', '1', '1504593663', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('5', 'admins', '0', '1504593694', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('6', 'admins', '0', '1504593709', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('7', 'admins', '0', '1504593718', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('9', 'admins', '1', '1504680595', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('10', 'admins', '1', '1504748596', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('11', 'admins', '1', '1504761705', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('12', 'admins', '1', '1504761778', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('13', 'admins', '1', '1504833126', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('14', 'cs_kefu1', '0', '1504850463', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('15', 'admins', '1', '1504850476', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('16', 'cs_kefu1', '0', '1504850773', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('17', 'cs_kefu1', '0', '1504850786', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('18', 'admins', '1', '1504850791', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('19', 'cs_kefu3', '3', '1504850808', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('20', 'admins', '1', '1505092475', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('21', 'cs_leader', '2', '1505115798', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('22', 'cs_kefu1', '0', '1505115855', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('23', 'cs_kefu3', '3', '1505115863', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('24', 'admins', '1', '1505115917', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('25', 'cs_leader', '2', '1505117033', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('26', 'cs_kefu1', '0', '1505117067', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('27', 'cs_kefu3', '3', '1505117077', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('28', 'admins', '1', '1505117129', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('29', 'cs_kefu3', '3', '1505117162', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('30', 'admins', '1', '1505117338', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('31', 'admins', '1', '1505178148', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('32', 'admins', '1', '1505186052', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('33', 'admins', '1', '1505264329', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('34', 'admins', '1', '1505264329', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('35', 'cs_leader', '2', '1505284362', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('36', 'cs_kefu3', '3', '1505284425', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('37', 'cs_leader', '2', '1505284486', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('38', 'admins', '1', '1505284505', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('39', 'admins', '1', '1505351241', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('40', 'admins', '1', '1505366738', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('41', 'cs_leader', '2', '1505369397', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('42', 'cs_kefu1', '0', '1505369432', '0', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('43', 'cs_kefu2', '7', '1505369443', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('44', 'cs_qtkefu2', '9', '1505379294', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('45', 'admins', '1', '1505437851', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('46', 'admins', '1', '1505442883', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('47', 'admins', '1', '1505442934', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('48', 'admins', '1', '1505446864', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('49', 'admins', '1', '1505697098', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('50', 'admins', '1', '1505782839', '1', '127.0.0.1');
INSERT INTO `bfdyt_log` VALUES ('51', 'admins', '1', '1505869511', '1', '127.0.0.1');

-- ----------------------------
-- Table structure for bfdyt_major
-- ----------------------------
DROP TABLE IF EXISTS `bfdyt_major`;
CREATE TABLE `bfdyt_major` (
  `bfdyt_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `bfdyt_name` varchar(255) DEFAULT NULL COMMENT '专业名字',
  `bfdyt_month` tinyint(255) unsigned DEFAULT NULL COMMENT '学制月份',
  PRIMARY KEY (`bfdyt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bfdyt_major
-- ----------------------------

-- ----------------------------
-- Table structure for bfdyt_studentinfo
-- ----------------------------
DROP TABLE IF EXISTS `bfdyt_studentinfo`;
CREATE TABLE `bfdyt_studentinfo` (
  `bfdyt_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `bfdyt_name` varchar(255) NOT NULL COMMENT '名字',
  `bfdyt_sex` enum('1','0') DEFAULT '1' COMMENT '0女生，1男生',
  `bfdyt_age` tinyint(255) unsigned NOT NULL COMMENT '年龄',
  `bfdyt_edu` enum('4','3','2','1','5','0') NOT NULL DEFAULT '2' COMMENT '1小学2初中3高中4大专5本科',
  `bfdyt_phone` varchar(255) NOT NULL COMMENT '电话',
  `bfdyt_qq` varchar(255) NOT NULL COMMENT 'qq微信号',
  `bfdyt_star` enum('2','1','3') DEFAULT '1' COMMENT '星级 重要程度',
  `bfdyt_job` enum('4','3','2','1','5','0') NOT NULL COMMENT '职业状况 1应届,2往届3待业,4已工作,5没毕业',
  `bfdyt_pro` int(255) unsigned DEFAULT NULL COMMENT '地区编号省',
  `bfdyt_city` int(255) unsigned DEFAULT NULL COMMENT '市',
  `bfdyt_county` int(255) unsigned DEFAULT NULL,
  `bfdyt_major` tinyint(255) unsigned DEFAULT NULL COMMENT '专业编号',
  `bfdyt_source` enum('5','4','3','2','1','6') DEFAULT NULL COMMENT '信息来源1在线报名2离线宝3400电话4商桥留言5官网电话6SEO渠道',
  `bfdyt_learnmonth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '学制月数 0为其他',
  `bfdyt_arivetime` date DEFAULT NULL COMMENT '到校时间',
  `bfdyt_zxdate` date DEFAULT NULL COMMENT '咨询日期',
  `bfdyt_zxtime` tinyint(4) unsigned DEFAULT NULL COMMENT '咨询时间24小时制',
  `bfdyt_visitime` date DEFAULT NULL COMMENT '回访时间',
  `bfdyt_zxstatus` enum('1','2') NOT NULL DEFAULT '2' COMMENT '咨询状态2未到校1已到校',
  `bfdyt_backuser` int(255) unsigned DEFAULT '0' COMMENT '后台客服id',
  `bfdyt_frontuser` int(255) unsigned DEFAULT '0' COMMENT '前台客服id',
  `bfdyt_rltime` date DEFAULT NULL COMMENT '前台认领时间',
  `bfdyt_zystatus` enum('1','0') DEFAULT '0' COMMENT '是否转移至前台0没转移1已转移',
  `bfdyt_htremark` text COMMENT '后台备注',
  `bfdyt_isjoin` enum('1','0') DEFAULT '0' COMMENT '是否报名0没有报名1已经报名',
  `bfdyt_visitstatus` tinyint(255) unsigned DEFAULT '0' COMMENT '后台客服 1为已经回访',
  `bfdyt_adddate` date DEFAULT NULL,
  PRIMARY KEY (`bfdyt_id`),
  KEY `userid` (`bfdyt_backuser`,`bfdyt_frontuser`) USING BTREE COMMENT '信息客服id'
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bfdyt_studentinfo
-- ----------------------------
INSERT INTO `bfdyt_studentinfo` VALUES ('1', '李士', '0', '0', '3', '/12345678910', '588277', '3', '3', '51', '5101', null, '0', '4', '0', '2017-04-02', '2017-03-01', '8', '2017-09-19', '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('2', '万仕焕', '1', '0', '3', '', '8780246', '3', '3', '51', '5101', null, '7', '4', '24', '2017-04-03', '2017-03-01', '8', '2017-09-18', '', '10', '0', null, '1', '直接导入', '0', '1', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('3', '成福友', '1', '0', '3', '', '8223346884', '3', '3', '52', '5203', null, '8', '4', '24', '2017-04-04', '2017-03-01', '8', null, '', '10', '0', null, '1', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('4', '童浩然', '1', '0', '3', '', '8385242023', '3', '3', '52', '5203', null, '8', '4', '24', '2017-04-05', '2017-03-01', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('5', '郭先生', '1', '0', '3', '', '588302480', '3', '3', '51', '5101', null, '7', '4', '0', '2017-04-06', '2017-03-01', '8', null, '', '10', '0', null, '1', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('6', '马永倩', '0', '0', '3', '', '33040660', '3', '3', '51', '5101', null, '7', '4', '24', '2017-04-07', '2017-03-01', '8', null, '', '10', '0', null, '1', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('7', '吴先生', '1', '0', '3', '', '478835808', '3', '3', '51', '5101', null, '7', '1', '24', '2017-04-08', '2017-03-01', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('8', '方先生', '1', '0', '3', '', '773760', '3', '3', '51', '5101', null, '0', '4', '0', '2017-04-09', '2017-03-01', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('9', '吴先生', '1', '0', '3', '', '58280320', '3', '3', '51', '5101', null, '7', '4', '0', '2017-04-10', '2017-03-01', '8', '0000-00-00', '', '10', '1', '2017-09-20', '1', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('10', '王先生', '1', '0', '3', '', '8048657667', '3', '3', '51', '5101', null, '7', '2', '0', '2017-04-11', '2017-03-01', '8', null, '', '10', '0', null, '1', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('11', '尤先生', '1', '0', '3', '', '5328535', '3', '3', '51', '5101', null, '0', '4', '3', '2017-04-12', '2017-03-01', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('12', '某学员', '1', '0', '3', '', '34086322', '3', '3', '51', '5101', null, '7', '3', '3', '2017-04-13', '2017-03-01', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('13', '王先生', '1', '0', '3', '', '3633627', '3', '3', '62', '6201', null, '0', '3', '0', '2017-04-14', '2017-03-01', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('14', '李先生', '1', '0', '3', '', '780825730', '3', '3', '51', '5101', null, '8', '3', '0', '2017-04-15', '2017-03-01', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('15', '李乐', '0', '19', '3', '', '58772705', '3', '3', '51', '5101', null, '4', '1', '24', '2017-04-16', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('16', '李娅', '0', '0', '3', '', '88808524', '3', '3', '51', '5101', null, '12', '1', '0', '2017-04-17', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('17', '李', '0', '0', '3', '', '38822027', '3', '3', '51', '5101', null, '0', '3', '0', '2017-04-18', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('18', '张', '0', '0', '3', '', '528408202', '3', '3', '51', '5101', null, '7', '4', '3', '2017-04-19', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('19', '汪丹', '0', '0', '3', '', '588470623', '2', '3', '51', '5101', null, '0', '4', '0', '2017-04-20', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('20', '张', '1', '16', '3', '', '34660504', '3', '3', '53', '5303', null, '0', '3', '24', '2017-04-21', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('21', '汪青成', '1', '20', '3', '', '878473357', '3', '3', '51', '5101', null, '0', '4', '24', '2017-04-22', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('22', '朱福军', '1', '17', '3', '', '588233420', '3', '3', '51', '5101', null, '0', '4', '24', '2017-04-23', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('23', '龚', '1', '0', '3', '', '53073', '3', '3', '51', '5101', null, '11', '3', '0', '2017-04-24', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('24', '沈宇琴', '1', '0', '3', '', '354022565', '2', '3', '51', '5101', null, '0', '4', '0', '2017-04-25', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('25', '刘', '1', '28', '3', '', '35507440', '3', '3', '50', '5002', null, '0', '4', '3', '2017-04-26', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('26', '康琳', '0', '17', '3', '', '872863307', '3', '3', '51', '5101', null, '4', '4', '24', '2017-04-27', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('27', '田', '1', '17', '3', '', '5838427', '3', '3', '51', '5101', null, '0', '4', '24', '2017-04-28', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('28', '谭蓉', '0', '15', '3', '', '5228222764', '3', '3', '51', '5101', null, '6', '4', '24', '2017-04-29', '2017-03-02', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('29', '金措', '0', '0', '3', '', '87203', '3', '3', '63', '6327', null, '0', '4', '24', '2017-04-30', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('30', '黄志', '', '0', '3', '', '3880234022', '3', '3', '51', '5101', null, '0', '1', '3', '2017-05-01', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('31', '袁敏强', '1', '0', '3', '', '32204324', '3', '3', '32', '3205', null, '1', '3', '24', '2017-05-02', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('32', '李辉', '', '0', '3', '', '86862637', '3', '3', '51', '5101', null, '6', '1', '24', '2017-05-03', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('33', '何波', '1', '0', '3', '', '77605205', '3', '3', '51', '5101', null, '6', '1', '24', '2017-05-04', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('34', '徐曲博', '1', '0', '3', '', '502388445', '1', '3', '51', '5101', null, '8', '4', '6', '2017-05-05', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('35', '姚先生', '1', '0', '3', '', '3545768', '1', '3', '62', '6201', null, '12', '3', '1', '2017-05-06', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('36', '简小飞', '0', '0', '3', '', '586448530', '3', '3', '52', '5203', null, '8', '1', '24', '2017-05-07', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('37', '黄明伟', '1', '0', '3', '', '5864580', '3', '3', '52', '5203', null, '8', '1', '24', '2017-05-08', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('38', '赵先生', '1', '0', '3', '', '38824376', '1', '3', '51', '5101', null, '8', '2', '3', '2017-05-09', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('39', '魏0士', '0', '0', '3', '', '83555508', '1', '3', '50', '5002', null, '0', '4', '0', '2017-05-10', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('40', '郑真', '1', '0', '3', '', '8657602', '3', '3', '51', '5101', null, '7', '3', '3', '2017-05-11', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('41', '王先生', '1', '0', '3', '', '585820372', '1', '3', '62', '6201', null, '0', '4', '0', '2017-05-12', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('42', '陈先生', '1', '0', '3', '', '34522', '3', '3', '62', '6201', null, '7', '3', '3', '2017-05-13', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('43', '王先生', '1', '0', '3', '', '858736758', '3', '3', '51', '5101', null, '7', '4', '1', '2017-05-14', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('44', '刘朝奇', '1', '0', '3', '', '58675450', '3', '3', '52', '5203', null, '7', '4', '3', '2017-05-15', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('45', '王振磊', '1', '0', '3', '', '3830238', '3', '3', '51', '5101', null, '0', '4', '1', '2017-05-16', '2017-03-03', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('46', '申刁', '1', '0', '3', '', '886872', '3', '3', '52', '5203', null, '12', '1', '0', '2017-05-17', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('47', '王国东', '1', '0', '3', '', '878230875', '3', '3', '51', '5101', null, '0', '4', '0', '2017-05-18', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('48', '达西', '1', '0', '3', '', '778048506', '3', '3', '51', '5101', null, '0', '3', '0', '2017-05-19', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('49', '曹给孩子', '1', '0', '3', '', '7386586', '3', '3', '51', '5101', null, '6', '2', '24', '2017-05-20', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('50', '张聪', '1', '0', '3', '', '528270870', '3', '3', '51', '5101', null, '0', '4', '24', '2017-05-21', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('51', '张晓丽', '1', '0', '3', '', '58028704', '1', '3', '51', '5101', null, '0', '2', '0', '2017-05-22', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('52', '王佳彬', '1', '0', '3', '', '83807878', '1', '3', '51', '5101', null, '8', '4', '0', '2017-05-23', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('53', '常曦', '1', '0', '3', '', '5348225775', '3', '3', '51', '5101', null, '8', '4', '24', '2017-05-24', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('54', '才让三木知', '1', '0', '3', '', '32347036', '3', '3', '62', '6201', null, '6', '2', '24', '2017-05-25', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('55', '王', '1', '0', '3', '', '375572300', '1', '3', '51', '5101', null, '0', '4', '0', '2017-05-26', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('56', '王', '1', '0', '3', '', '532826867', '1', '3', '51', '5101', null, '0', '4', '0', '2017-05-27', '2017-03-04', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('57', '范0士', '1', '0', '3', '', '808757250', '3', '3', '51', '5101', null, '7', '4', '3', '2017-05-28', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('58', '王0士', '1', '0', '3', '', '340837766', '1', '3', '51', '5101', null, '8', '4', '24', '2017-05-29', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('59', '萧凡', '1', '0', '3', '', '365072465', '3', '3', '51', '5101', null, '8', '4', '24', '2017-05-30', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('60', '姚乐', '1', '0', '3', '', '52352547', '3', '3', '62', '5101', null, '8', '4', '3', '2017-05-31', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('61', '李先生', '1', '0', '3', '', '8283585760', '3', '3', '51', '5101', null, '8', '2', '3', '2017-06-01', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('62', '罗0士', '0', '0', '3', '', '8086222', '3', '3', '52', '5203', null, '11', '4', '1', '2017-06-02', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('63', '曹雪莉', '0', '0', '3', '', '5828648802', '3', '3', '51', '5101', null, '7', '4', '24', '2017-06-03', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('64', '善同学', '1', '0', '3', '', '825054', '3', '3', '62', '6201', null, '6', '4', '24', '2017-06-04', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('65', '肖俊', '1', '0', '3', '', '8385880', '3', '3', '52', '5203', null, '6', '4', '24', '2017-06-05', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('66', '史永鹏', '1', '0', '3', '', '50552707', '3', '3', '62', '6201', null, '8', '1', '24', '2017-06-06', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('67', '刘同学', '0', '0', '3', '', '87854720', '3', '3', '52', '5203', null, '8', '4', '24', '2017-06-07', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('68', '姜鸿基', '1', '0', '3', '', '873604488', '3', '3', '62', '6201', null, '8', '1', '24', '2017-06-08', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('69', '杨波', '1', '0', '3', '', '773853406', '3', '3', '51', '5101', null, '1', '1', '24', '2017-06-09', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('70', '祝建平', '1', '0', '3', '', '878472068', '3', '3', '51', '5101', null, '8', '1', '0', '2017-06-10', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('71', '王鑫', '0', '0', '3', '', '330405400', '3', '3', '51', '5101', null, '7', '3', '24', '2017-06-11', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('72', '唐红梅', '0', '0', '3', '', '8380805586', '3', '3', '51', '5101', null, '7', '4', '0', '2017-06-12', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('73', '吉伍日鬼', '1', '0', '3', '', '87824465', '3', '3', '51', '5101', null, '0', '1', '24', '2017-06-13', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('74', '程露露', '0', '0', '3', '', '824444462', '3', '3', '51', '5101', null, '6', '4', '0', '2017-06-14', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('75', '0士', '0', '0', '3', '', '7383458858', '3', '3', '51', '5101', null, '7', '3', '0', '2017-06-15', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('76', '王树莲', '0', '0', '3', '', '58408447', '3', '3', '51', '5101', null, '0', '2', '0', '2017-06-16', '2017-03-05', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('77', '郭先生', '1', '0', '3', '', '77737525', '3', '3', '43', '4301', null, '7', '3', '3', '2017-06-17', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('78', '杨先生', '1', '0', '3', '', '308862', '1', '3', '51', '5101', null, '8', '2', '0', '2017-06-18', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('79', '吴志锋', '1', '0', '3', '', '363248884', '1', '3', '52', '5203', null, '0', '1', '1', '2017-06-19', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('80', '何蕊', '0', '0', '3', '', '372452860', '3', '3', '52', '5203', null, '7', '4', '24', '2017-06-20', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('81', '余亚龙', '1', '0', '3', '', '733775', '3', '3', '62', '6201', null, '7', '4', '24', '2017-06-21', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('82', '李刚青', '1', '0', '3', '', '582045885', '1', '3', '51', '5101', null, '8', '3', '3', '2017-06-22', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('83', '韩光远', '1', '0', '3', '', '38254', '1', '3', '51', '5101', null, '8', '1', '6', '2017-06-23', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('84', '谢杨', '1', '0', '3', '', '5663236', '3', '3', '51', '5101', null, '1', '4', '24', '2017-06-24', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('85', '母0士', '0', '0', '3', '', '3550588', '1', '3', '51', '5101', null, '7', '3', '3', '2017-06-25', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('86', '付景仰', '0', '0', '3', '', '5680836777', '3', '3', '51', '5101', null, '8', '3', '24', '2017-06-26', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('87', '张0士', '0', '0', '3', '', '57755660', '3', '3', '51', '5101', null, '0', '3', '0', '2017-06-27', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('88', '黄韬', '1', '0', '3', '', '83424586', '3', '3', '51', '5101', null, '8', '3', '3', '2017-06-28', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('89', '王同学', '1', '0', '3', '', '5244264', '3', '3', '62', '6201', null, '0', '3', '6', '2017-06-29', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('90', '冯先生', '1', '0', '3', '', '85828546', '3', '3', '51', '5101', null, '7', '3', '3', '2017-06-30', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('91', '吴佩科', '1', '0', '3', '', '56563665', '3', '3', '51', '5101', null, '7', '3', '0', '2017-07-01', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('92', '王鹏开', '1', '0', '3', '', '53357344', '3', '3', '62', '6201', null, '8', '4', '3', '2017-07-02', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('93', '蒙0士', '1', '0', '3', '', '52367486', '3', '3', '62', '6201', null, '3', '4', '24', '2017-07-03', '2017-03-06', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('94', '李道根', '1', '0', '3', '', '36840725', '3', '3', '51', '5101', null, '8', '2', '3', '2017-07-04', '2017-03-07', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);
INSERT INTO `bfdyt_studentinfo` VALUES ('95', '杜先生', '1', '0', '3', '', '832802385', '3', '3', '51', '5101', null, '7', '4', '24', '2017-07-05', '2017-03-07', '8', null, '', '10', '0', null, '0', '直接导入', '0', '0', null);

-- ----------------------------
-- Table structure for bfdyt_user
-- ----------------------------
DROP TABLE IF EXISTS `bfdyt_user`;
CREATE TABLE `bfdyt_user` (
  `bfdyt_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `bfdyt_username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `bfdyt_passwd` varchar(255) DEFAULT NULL,
  `bfdyt_role` enum('2','1','3','0') NOT NULL DEFAULT '2' COMMENT '角色 0主账号,1部门主管,2后台客服，3前台客服',
  `bfdyt_fid` int(10) unsigned NOT NULL COMMENT '上级主管id',
  `bfdyt_name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `bfdyt_sex` enum('1','0') DEFAULT '0' COMMENT '性别0女1男',
  `bfdyt_job` varchar(255) DEFAULT NULL COMMENT '职位',
  `bfdyt_phone` varchar(255) DEFAULT NULL COMMENT '电话',
  `bfdyt_time` date DEFAULT NULL COMMENT '添加日期',
  `bfdyt_logintime` datetime DEFAULT NULL COMMENT '上次登录时间',
  `bfdyt_status` enum('1','0') DEFAULT '1' COMMENT '0禁用账号 1启用账号',
  `bfdyt_logins` int(255) unsigned DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`bfdyt_id`),
  UNIQUE KEY `bfdyt_username` (`bfdyt_username`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bfdyt_user
-- ----------------------------
INSERT INTO `bfdyt_user` VALUES ('1', 'admins', 'e10adc3949ba59abbe56e057f20f883e ', '0', '1', '超级管理员', '1', '系统管理员', '18224577767', '2017-08-22', '2017-09-20 09:05:11', '1', '47');
INSERT INTO `bfdyt_user` VALUES ('11', 'caoxiu', 'e10adc3949ba59abbe56e057f20f883e', '2', '10', '曹秀', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:03:23', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('12', 'xuelian', 'e10adc3949ba59abbe56e057f20f883e', '2', '10', '薛莲', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:05:45', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('10', 'liuweiqing', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', '刘伟青', '0', null, '12345678910', '2017-09-19', '2017-09-19 12:01:44', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('13', 'wangxia', 'e10adc3949ba59abbe56e057f20f883e', '2', '10', '汪霞', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:08:08', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('16', 'niecuixia', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', '聂翠霞', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:10:53', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('14', 'suhuaying', 'e10adc3949ba59abbe56e057f20f883e', '2', '10', '苏华英', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:09:02', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('15', 'lilijuan', 'e10adc3949ba59abbe56e057f20f883e', '2', '1', '李丽娟', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:10:05', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('17', 'liuweiqing1', 'e10adc3949ba59abbe56e057f20f883e', '3', '16', '刘伟青', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:12:13', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('18', 'youyanying', 'e10adc3949ba59abbe56e057f20f883e', '3', '16', '尤艳英', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:13:25', '1', '0');
INSERT INTO `bfdyt_user` VALUES ('19', 'zhaozhongling', 'e10adc3949ba59abbe56e057f20f883e', '3', '16', '赵众玲', '0', null, '12345678910', '2017-09-19', '2017-09-19 13:14:08', '1', '0');

-- ----------------------------
-- Table structure for bfdyt_visit
-- ----------------------------
DROP TABLE IF EXISTS `bfdyt_visit`;
CREATE TABLE `bfdyt_visit` (
  `bfdyt_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '回访信息表',
  `bfdyt_userid` int(10) unsigned NOT NULL COMMENT '客服id',
  `bfdyt_infoid` int(10) unsigned NOT NULL COMMENT '学生信息id',
  `bfdyt_time` date NOT NULL COMMENT '回访时间',
  `bfdyt_status` tinyint(255) unsigned NOT NULL DEFAULT '0' COMMENT '0没有回访1已经回访',
  PRIMARY KEY (`bfdyt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bfdyt_visit
-- ----------------------------
INSERT INTO `bfdyt_visit` VALUES ('1', '1', '1', '2017-09-09', '0');
INSERT INTO `bfdyt_visit` VALUES ('2', '3', '2', '2017-09-05', '0');
INSERT INTO `bfdyt_visit` VALUES ('3', '1', '3', '2017-09-06', '0');
INSERT INTO `bfdyt_visit` VALUES ('4', '1', '1', '2017-09-05', '0');
INSERT INTO `bfdyt_visit` VALUES ('5', '2', '2', '2017-09-06', '0');
INSERT INTO `bfdyt_visit` VALUES ('6', '3', '3', '2017-09-14', '0');
INSERT INTO `bfdyt_visit` VALUES ('7', '1', '4', '2017-09-13', '0');
INSERT INTO `bfdyt_visit` VALUES ('8', '1', '5', '2017-09-22', '0');
INSERT INTO `bfdyt_visit` VALUES ('9', '1', '6', '2017-09-15', '0');
INSERT INTO `bfdyt_visit` VALUES ('10', '1', '7', '2017-09-07', '0');
INSERT INTO `bfdyt_visit` VALUES ('11', '2', '8', '2017-09-15', '0');
INSERT INTO `bfdyt_visit` VALUES ('12', '3', '9', '2017-09-15', '0');
INSERT INTO `bfdyt_visit` VALUES ('13', '1', '10', '2017-09-15', '0');
INSERT INTO `bfdyt_visit` VALUES ('14', '1', '11', '2017-09-09', '0');
INSERT INTO `bfdyt_visit` VALUES ('15', '7', '12', '2017-09-14', '0');
INSERT INTO `bfdyt_visit` VALUES ('16', '7', '13', '2017-09-22', '0');
INSERT INTO `bfdyt_visit` VALUES ('17', '7', '14', '2017-09-16', '0');
INSERT INTO `bfdyt_visit` VALUES ('18', '7', '15', '2017-09-09', '0');
INSERT INTO `bfdyt_visit` VALUES ('19', '9', '16', '2017-09-16', '0');
