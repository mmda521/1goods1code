# Host: localhost  (Version: 5.5.47)
# Date: 2017-07-06 23:23:42
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES gb2312 */;

#
# Structure for table "access_token"
#

CREATE TABLE `access_token` (
  `access_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'access_token的id',
  `access_token` varchar(270) CHARACTER SET gb2312 NOT NULL COMMENT 'access_token',
  `expires_in` int(10) NOT NULL COMMENT '时间限制',
  PRIMARY KEY (`access_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

#
# Data for table "access_token"
#

INSERT INTO `access_token` VALUES (1,'sxaXDihYoCI1F9DRZESXtJ-33959_yyiLMG3A1J0_QghDuzomUtVegnenoapEV7cItIHY7-fds8dRi1ApCmrO0aD6_GDOld8B6eEtltP8HAKDLeAHAXQY',7200);

#
# Structure for table "biz_control"
#

CREATE TABLE `biz_control` (
  `control_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `col_code` varchar(36) NOT NULL COMMENT '资格编号',
  `trades_code` varchar(50) NOT NULL COMMENT '企业编码',
  `trades_name` varchar(255) NOT NULL COMMENT '企业名称',
  `biz_type` varchar(10) NOT NULL COMMENT '业务类型',
  `control_flag` varchar(10) NOT NULL COMMENT '资格标志',
  `app_person` varchar(50) NOT NULL COMMENT '申请人',
  `begin_date` date NOT NULL COMMENT '开始时间',
  `end_date` date NOT NULL COMMENT '结束时间',
  `app_date` date NOT NULL COMMENT '申请时间',
  `status` varchar(50) NOT NULL COMMENT '状态',
  PRIMARY KEY (`control_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "biz_control"
#

INSERT INTO `biz_control` VALUES (1,'2','2','2','N','2','2','0000-00-00','0000-00-00','0000-00-00',''),(3,'3','3','3','Y','3','','0000-00-00','0000-00-00','2017-03-06','');

#
# Structure for table "bus_record"
#

CREATE TABLE `bus_record` (
  `bus_record_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `enterprice_code` varchar(36) NOT NULL COMMENT '企业编码',
  `enterprice_name` varchar(36) NOT NULL COMMENT '企业名称',
  `enterprice_type` varchar(36) NOT NULL COMMENT '企业类型',
  `custom_name` varchar(36) NOT NULL COMMENT '关区名称',
  `area_name` varchar(36) NOT NULL COMMENT '区域名称',
  `org_code` varchar(36) NOT NULL COMMENT '组织机构代码',
  `enterprice_full_name` varchar(36) NOT NULL COMMENT '企业注册名称（全）',
  `record_date` date NOT NULL COMMENT '注册日期',
  `enterprice_ename` varchar(36) NOT NULL COMMENT '企业英文名称',
  `valid_date` date NOT NULL COMMENT '有效日期',
  `cur_status` varchar(10) NOT NULL COMMENT '当前状态',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `create_user` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`bus_record_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "bus_record"
#

INSERT INTO `bus_record` VALUES (2,'3','3','N','3','32','3','3','2017-03-07','','0000-00-00','','2017-03-08 14:33:49',NULL,NULL),(3,'23','43','Y','3','34','3','435','0000-00-00','435','0000-00-00','','2017-03-09 16:16:05',NULL,NULL),(4,'454','54','Y','45','4','4','','0000-00-00','','0000-00-00','','2017-03-09 16:16:47',NULL,NULL);

#
# Structure for table "ceshi"
#

CREATE TABLE `ceshi` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Express_No` varchar(25) DEFAULT NULL,
  `Count_Total` int(10) DEFAULT NULL,
  `Scan_Express_Num` int(5) NOT NULL DEFAULT '0',
  `Flag` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

#
# Data for table "ceshi"
#

INSERT INTO `ceshi` VALUES (1,'6911989113589',5,5,0);

#
# Structure for table "con_freightlot"
#

CREATE TABLE `con_freightlot` (
  `GUID` varchar(50) NOT NULL COMMENT 'GUID',
  `ID` varchar(50) DEFAULT NULL COMMENT '内部ID',
  `INDEX_NO` varchar(50) DEFAULT NULL COMMENT '检索号',
  `QUREY_CODE` varchar(50) DEFAULT NULL COMMENT '查询码',
  `GOODSSITE_NO` varchar(30) DEFAULT NULL COMMENT '货位号',
  `GOODSSITE_NOTE` varchar(100) DEFAULT NULL COMMENT '货位说明',
  `OPERUSER_ID` varchar(20) DEFAULT NULL COMMENT '操作人员ID',
  `OPERROLE_ID` varchar(20) DEFAULT NULL COMMENT '操作角色ID',
  `OPER_ID` varchar(20) DEFAULT NULL COMMENT '操作点ID',
  `OPERCOM_ID` varchar(20) DEFAULT NULL COMMENT '操作公司ID',
  `OPERDATE` datetime DEFAULT NULL COMMENT '操作时间',
  `STATUS` char(1) DEFAULT NULL COMMENT '状态',
  `UPDATEUSER_ID` varchar(20) DEFAULT NULL COMMENT '修改人员ID',
  `UPDATEDATE` datetime DEFAULT NULL COMMENT '修改时间',
  `REMARK1` varchar(100) DEFAULT NULL COMMENT '备注1',
  `REMARK2` varchar(100) DEFAULT NULL COMMENT '备注2',
  PRIMARY KEY (`GUID`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='货位';

#
# Data for table "con_freightlot"
#

INSERT INTO `con_freightlot` VALUES ('150d395f-3b2e-4575-8a07-66dcf40a2385',NULL,'06',NULL,'C1','','2645','144',NULL,'NTZBQ','2017-03-09 16:17:51','Y','84','2015-12-23 10:02:25',NULL,NULL),('1e0e1949-e804-44d1-af42-f50d51c6a216',NULL,'02',NULL,'A2',NULL,'26','144',NULL,'NTZBQ','2015-09-15 15:32:13','Y','84','2015-10-11 09:23:39',NULL,NULL),('5877f390-751e-4a94-a33b-457bcf95fd8b',NULL,'07',NULL,'C2',NULL,'26','144',NULL,'NTZBQ','2015-09-15 15:34:18','Y','84','2015-12-23 10:02:36',NULL,NULL),('6e7f461e-96a8-53f7-1abe-032221966797',NULL,'34',NULL,'43','4','ADMIN',NULL,NULL,NULL,'2017-03-09 16:34:59','Y',NULL,NULL,NULL,NULL),('73dd8de4-a98b-c241-e804-e63f39b7a479',NULL,'32',NULL,'43','454','ADMIN',NULL,NULL,NULL,'2017-03-09 16:35:37','Y',NULL,NULL,NULL,NULL),('7ccc60e8-5495-43ad-8628-c08766bd3358',NULL,'04',NULL,'B2',NULL,'26','144',NULL,'NTZBQ','2015-09-15 15:32:40','Y','84','2015-10-11 09:23:27',NULL,NULL),('8b0bf382-df2a-9f1d-ad8f-363231c8136c',NULL,'0789',NULL,'8','oui',NULL,NULL,NULL,NULL,'2017-03-01 11:17:08','N',NULL,NULL,NULL,NULL),('a064b443-04b4-4516-a53f-01a2ec5bcee4',NULL,'03',NULL,'B1',NULL,'26','144',NULL,'NTZBQ','2015-09-15 15:32:28','Y','84','2015-10-11 09:23:33',NULL,NULL),('aa92e6a5-9938-42f9-b65c-bba73ac8df68',NULL,'01',NULL,'A1',NULL,'26','144',NULL,'NTZBQ','2015-09-15 15:31:57','Y','84','2015-10-11 09:22:44',NULL,NULL),('ea12d89d-2160-4c84-922e-7b0e021d0dca',NULL,'05',NULL,'C4',NULL,'26','144',NULL,'NTZBQ','2015-09-15 15:34:55','Y','84','2015-12-23 10:03:09',NULL,NULL);

#
# Structure for table "eci_user"
#

CREATE TABLE `eci_user` (
  `USER_ID` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT '用户ID',
  `LOGIN_NO` varchar(100) NOT NULL COMMENT '登陆账号',
  `PASSWORD` varchar(100) DEFAULT NULL COMMENT '登陆密码',
  `USER_NAME` varchar(100) DEFAULT NULL COMMENT '用户名称',
  `CREATE_DATE` datetime DEFAULT NULL COMMENT '创建日期',
  `COMPANY_CODE` varchar(20) DEFAULT NULL COMMENT '公司',
  `STATUS` char(1) DEFAULT NULL COMMENT '是否启用',
  `GUID` varchar(100) DEFAULT NULL COMMENT '主键',
  `AUTO` char(1) DEFAULT NULL COMMENT '自动创建',
  `PASSWORD2` varchar(100) DEFAULT NULL COMMENT '2次密码',
  `EP_ADMIN` char(1) DEFAULT NULL COMMENT '机构管理员',
  `UDF1` varchar(100) DEFAULT NULL,
  `UDF2` varchar(100) DEFAULT NULL,
  `UDF3` varchar(100) DEFAULT NULL,
  `UDF4` varchar(100) DEFAULT NULL,
  `UDF5` varchar(100) DEFAULT NULL,
  `UDF6` varchar(100) DEFAULT NULL,
  `UDF7` varchar(100) DEFAULT NULL,
  `UDF8` varchar(100) DEFAULT NULL,
  `UDF9` varchar(100) DEFAULT NULL,
  `UDF10` varchar(100) DEFAULT NULL,
  `UDF11` varchar(100) DEFAULT NULL,
  `UDF12` varchar(100) DEFAULT NULL,
  `UDF13` varchar(100) DEFAULT NULL,
  `UDF14` varchar(100) DEFAULT NULL,
  `UDF15` varchar(100) DEFAULT NULL,
  `COMPANY_NAME` varchar(20) DEFAULT NULL COMMENT '公司名称(注册用户无公司代码)',
  `EMAIL` varchar(100) DEFAULT NULL COMMENT '邮件',
  `LINKER` varchar(50) DEFAULT NULL COMMENT '联系人',
  `TEL` varchar(50) DEFAULT NULL COMMENT '电话',
  `MOBILE` varchar(50) DEFAULT NULL COMMENT '手机',
  `SEX` char(1) DEFAULT NULL COMMENT '性别',
  `POSITION` varchar(50) DEFAULT NULL COMMENT '职位',
  `QQ` varchar(50) DEFAULT NULL COMMENT 'QQ',
  `MSN` varchar(50) DEFAULT NULL COMMENT 'MSN',
  `COMPANY_TRADE` varchar(50) DEFAULT NULL COMMENT '行业',
  `COMPANY_NATURE` varchar(50) DEFAULT NULL COMMENT '公司性质',
  `ADDRESS` varchar(100) DEFAULT NULL COMMENT '地址',
  `PROVINCE` varchar(20) DEFAULT NULL COMMENT '省份',
  `CITY` varchar(20) DEFAULT NULL COMMENT '城市',
  `USER_TYPE` char(1) DEFAULT NULL COMMENT '用户类别(0-系统用户1-注册用户)',
  `VERIFY_CODE` varchar(50) DEFAULT NULL COMMENT '验证码',
  `IS_VERIFY` char(1) DEFAULT NULL COMMENT '是否通过验证',
  `REMARK` varchar(100) DEFAULT NULL COMMENT '备注',
  `REMARK1` varchar(100) DEFAULT NULL COMMENT '备注1',
  `COMPANY_TYPE` varchar(100) DEFAULT NULL COMMENT '公司类型',
  `SECURITY_CODE` varchar(50) DEFAULT NULL COMMENT '安全码',
  PRIMARY KEY (`USER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

#
# Data for table "eci_user"
#

INSERT INTO `eci_user` VALUES (26.00,'ADMIN','lgzih718','平台管理员','2011-11-25 13:40:25','NTZBQ','Y',NULL,'N','NA','Y','STS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'NTSTS-ALL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'N',NULL,NULL,NULL,NULL),(84.00,'CANGCHU','yushijujin718','仓储','2015-09-16 12:30:45','NTZBQ','Y',NULL,'N','NA','N','STS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'N',NULL,NULL,NULL,NULL),(86.00,'YUANQU','yuanqu','园区','2015-09-16 13:57:09','NTZBQ','Y',NULL,'N','NA','N','STS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'N',NULL,NULL,NULL,NULL),(87.00,'GUEST','123456','GUEST','2016-03-05 13:33:17','NTZBQ','Y',NULL,'N','NA','N','STS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'N',NULL,NULL,NULL,NULL),(88.00,'KEFU','kefu','kefu','2016-03-21 10:21:24','NTZBQ','Y',NULL,'N','NA','Y','STS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'N',NULL,NULL,NULL,NULL);

#
# Structure for table "item_number"
#

CREATE TABLE `item_number` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `record_id` int(11) NOT NULL COMMENT '表头id',
  `g_no` varchar(9) NOT NULL COMMENT '项号',
  `code_t_s` varchar(10) NOT NULL COMMENT '商品编码',
  `duty_mode` varchar(1) NOT NULL COMMENT '征免方式',
  `g_name` varchar(255) NOT NULL COMMENT '商品名称',
  `country_code` varchar(3) NOT NULL COMMENT '产销国',
  `g_model` varchar(255) NOT NULL COMMENT '规格型号',
  `aim_country` varchar(32) NOT NULL COMMENT '最终目的国（地区）',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='项号';

#
# Data for table "item_number"
#

INSERT INTO `item_number` VALUES (1,1,'2','2','2','2','2','2','2'),(3,2,'3','3','3','3','','',''),(4,3,'4','4','4','4','','',''),(5,1,'5','5','5','5','','',''),(6,2,'6','6','6','6','','',''),(7,4,'7','7','7','7','','',''),(8,3,'8','8','8','8','','','');

#
# Structure for table "kbook_record"
#

CREATE TABLE `kbook_record` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `pre_enter_no` varchar(36) NOT NULL COMMENT '预录入号',
  `eci_ems_no` varchar(36) NOT NULL COMMENT '账册编号',
  `ems_no` varchar(36) NOT NULL COMMENT 'H2000账册号',
  `tarde_code` varchar(20) NOT NULL COMMENT '经营单位代码',
  `trade_name` varchar(255) NOT NULL COMMENT '经营单位名称',
  `book_type` varchar(25) NOT NULL COMMENT '账册类型',
  `owner_code` varchar(20) NOT NULL COMMENT '收发货单位代码',
  `owner_name` varchar(255) NOT NULL COMMENT '收发货单位名称',
  `master_customs` varchar(4) NOT NULL COMMENT '主管海关',
  `declare_code` varchar(20) NOT NULL COMMENT '申请单位代码',
  `declare_name` varchar(255) NOT NULL COMMENT '申请单位名称',
  `area_code` varchar(10) NOT NULL DEFAULT '' COMMENT '地区代码',
  `cur_status` varchar(10) NOT NULL COMMENT '当前状态',
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='K账册备案表头';

#
# Data for table "kbook_record"
#

INSERT INTO `kbook_record` VALUES (1,'1','2','2','2','','Y','2','2','2','2','','',''),(3,'2','2','2','2','2','Y','2','2','2','','','',''),(4,'3','','','','','','3','3','3','','','',''),(5,'3','','','','','','4','4','4','','','',''),(6,'54','','','','','','34','43','34','','','',''),(7,'34','','','','','','34','34','34','','','','');

#
# Structure for table "master"
#

CREATE TABLE `master` (
  `QR_No` bigint(20) NOT NULL AUTO_INCREMENT,
  `QR_URL` varchar(200) DEFAULT NULL,
  `QR_FWID` varchar(20) CHARACTER SET gbk COLLATE gbk_bin DEFAULT NULL,
  `QR_Number` int(10) DEFAULT NULL,
  `QR_Active` varchar(2) NOT NULL DEFAULT 'N',
  `QR_FWTime` datetime DEFAULT NULL,
  `QR_ShopID_Ref` int(10) DEFAULT NULL,
  `QR_ItemID_Ref` bigint(20) DEFAULT NULL,
  `QR_TYPE` smallint(3) DEFAULT NULL COMMENT '0―方形码，1―圆形码',
  `QR_Money` int(10) DEFAULT NULL,
  `Openid` varchar(50) DEFAULT NULL,
  `QR_Receive` smallint(3) NOT NULL DEFAULT '0' COMMENT '0—未发放，1—已发放，2—已领取',
  `SH_mch_billno` varchar(50) DEFAULT NULL COMMENT '商户订单号',
  `QR_Scene_id` varchar(32) DEFAULT NULL COMMENT '场景id',
  `HB_TYPE` smallint(2) DEFAULT NULL,
  `WX_send_listid` varchar(32) DEFAULT NULL COMMENT '微信单号',
  `QR_Count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`QR_No`),
  UNIQUE KEY `QR_FWID` (`QR_FWID`)
) ENGINE=InnoDB AUTO_INCREMENT=131474 DEFAULT CHARSET=gbk;

#
# Data for table "master"
#

INSERT INTO `master` VALUES (1,NULL,'2993609067975',0,'Y',NULL,NULL,3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0),(2,NULL,'1693609602598',0,'Y','2017-03-27 11:35:01',NULL,3,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1),(3,NULL,'7493579285041',0,'Y','2017-02-27 13:24:05',NULL,3,1,NULL,NULL,1,NULL,NULL,NULL,NULL,2),(4,NULL,'3793579947957',0,'N',NULL,NULL,NULL,1,NULL,NULL,1,NULL,NULL,NULL,NULL,0),(5,NULL,'0992480564675',0,'N',NULL,NULL,NULL,0,NULL,NULL,1,NULL,NULL,NULL,NULL,0),(6,NULL,'3792480961067',0,'N',NULL,NULL,NULL,0,NULL,NULL,1,NULL,NULL,NULL,NULL,0),(7,'http://localhost:8080/index.php?qr_no=VDI=','0014864704971',0,'N',NULL,NULL,NULL,0,NULL,NULL,1,NULL,NULL,NULL,NULL,0),(8,'http://localhost:8080/index.php?qr_no=Vj8=','9514864604111',0,'N',NULL,NULL,NULL,0,NULL,NULL,1,'1',NULL,NULL,'1',0),(9,'http://localhost:8080/index.php?qr_no=AGg=','2814864704623',0,'N','2017-02-27 08:59:06',NULL,NULL,0,150,NULL,0,'1417986702201701202000372836',NULL,NULL,'1000041701201701203000146727092',6),(10,'http://localhost:8080/index.php?qr_no=CWlUZg==','2014864304527',0,'N',NULL,NULL,NULL,0,150,NULL,0,'1417986702201701201153068473',NULL,NULL,'1000041701201701203000043688034',0),(11,'http://localhost:8080/index.php?qr_no=UTFXZA==','7314864003461',0,'N',NULL,NULL,NULL,0,NULL,NULL,0,'1417986702201701191511543505',NULL,NULL,'1000041701201701193000051735034',0),(12,'http://localhost:8080/index.php?qr_no=AGAHNw==','4510119878606',1,'N','2017-02-27 09:08:03',NULL,NULL,0,201,NULL,1,'1417986702201701221705523382',NULL,NULL,'1000041701201701223000083652086',1),(13,'http://localhost:8080/index.php?qr_no=UTFXZg==','5810119978050',3,'N',NULL,NULL,NULL,1,300,NULL,1,'1417986702201701221415032753',NULL,1,'1000041701201701223000064713025',0),(14,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=CVgAVA==','6A5555',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(15,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=VFEAVA==','7X5M55',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(16,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=CVhSUA==','8U5l55',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(17,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=CVgEVA==','2P5J55',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(18,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=AVBUVg==','5R5Z55',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(19,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=CFlSUA==','6B5655',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(20,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=CFlQUg==','9D5255',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(21,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=UVFVVw==','0Y5W55',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(22,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=BVRSUA==','6Q5a55',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(23,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=AlMDVA==','FT5n55',6,'N',NULL,NULL,NULL,1,1000,NULL,0,NULL,'',2,NULL,0),(24,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=AlNUVg==','a',0,'N',NULL,NULL,NULL,1,100,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131453,NULL,'A',0,'N',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0),(131454,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=AVAAVFdRBgJTUlJR','7AIoO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131455,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=B1ZQUgJSAAQOW1JR','4XI6O5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131456,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=BldeXFdRVAMBVAZQ','3UIhO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131457,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=UVFQUgdXAwcHUlZR','7PIlO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131458,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=AFEDVAZWAQUFUFVR','8RIMO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131459,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=UlFVV1NRBAADVlZR','8BITO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131460,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=BVRVV1BRUwNWUlFR','5DIqO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131461,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=B1ZRUwZWBABUUlJR','6YIRO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131462,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=VFFSUFBRDgoEUQVT','FQIGO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131463,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=A1IDVAdXBQEBVAdR','BTIGO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131464,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=VlEEVFdRUgMFUFNR','ACITO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131465,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=VFFVVwlZUgNSUgZQ','7WIAO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131466,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=VFFQUghYAAQEUQZQ','FEIdO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131467,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=VlFXVQRUAwcEUVJR','BLIHO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131468,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=AVAHVAhYDwsBVARS','0GIqO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131469,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=UlFWVARUAwcDVgJU','7JIvO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131470,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=CFlTUQZWBAABVFFR','1MIkO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131471,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=B1ZUVgdXDgoCVwJU','CFIzO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131472,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=BFUEVAlZAQUCVwVT','0NIyO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0),(131473,'http://bn15897782.imwork.net/1goods1code/index.php?qr_no=BFUFVAZWAgZVUlJR','3SIJO5',0,'N',NULL,NULL,NULL,1,200,NULL,0,NULL,'PRODUCT_1',1,NULL,0);

#
# Structure for table "part_no"
#

CREATE TABLE `part_no` (
  `part_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `record_id` int(11) NOT NULL COMMENT '表头id',
  `item_id` int(11) NOT NULL COMMENT '项号id',
  `gop_g_no` varchar(30) NOT NULL COMMENT '货号',
  PRIMARY KEY (`part_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "part_no"
#

INSERT INTO `part_no` VALUES (1,1,1,'1');

#
# Structure for table "product_info"
#

CREATE TABLE `product_info` (
  `product_ItemID` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_ItemName` varchar(400) NOT NULL,
  `product_ItemNo` varchar(40) DEFAULT NULL,
  `product_CountryOfOrigin` int(10) DEFAULT NULL,
  `product_PortOfShipment` int(10) DEFAULT NULL,
  `product_SalePlatform` int(10) DEFAULT NULL,
  `product_InspectionDate` date DEFAULT NULL,
  `product_InspectionNo` varchar(40) DEFAULT NULL,
  `product_DeclarationDate` date DEFAULT NULL,
  `product_DeclarationNo` varchar(40) DEFAULT NULL,
  `product_ShopID` int(10) DEFAULT NULL,
  `product_AddTime` datetime DEFAULT NULL,
  PRIMARY KEY (`product_ItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=gbk;

#
# Data for table "product_info"
#

INSERT INTO `product_info` VALUES (1,'郑欧商城 波兰进口 乔杰克玛琪雅朵咖啡酱夹心饼干150g','5906812001547',2,2,1,'2016-01-01','123456789','2016-01-01','123456789',1,NULL),(2,'郑欧商城 越南进口麝香貂猫屎咖啡16条*20g、320g','DX8936101425188',4,4,1,'2016-01-05','123456789','2016-01-20','123465789',4,NULL),(3,'奶粉','1234567890',1,1,1,'2016-01-06','1234567890','2016-01-05','1234567890',3,NULL),(36,'哈哈哈','12435',1,1,NULL,'2016-12-14','123','2016-12-20','23455',1,NULL),(37,'1212','1212',2,2,NULL,'2016-12-04','1212','2016-12-04','1212',9,NULL),(62,'1234','1234',1,1,NULL,'2016-12-06','1234','2016-12-06','1234',1,NULL),(65,'4','4',4,4,NULL,'2017-02-13','4','2017-02-14','4',9,NULL);

#
# Structure for table "product_origininfo"
#

CREATE TABLE `product_origininfo` (
  `product_OriginID` int(10) NOT NULL,
  `product_OriginName` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`product_OriginID`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

#
# Data for table "product_origininfo"
#

INSERT INTO `product_origininfo` VALUES (1,'德国'),(2,'波兰'),(3,'白俄罗斯'),(4,'越南'),(5,'韩国'),(6,'奥地利');

#
# Structure for table "product_portinfo"
#

CREATE TABLE `product_portinfo` (
  `product_PortID` int(10) NOT NULL,
  `product_PortName` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`product_PortID`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

#
# Data for table "product_portinfo"
#

INSERT INTO `product_portinfo` VALUES (1,'汉堡'),(2,'华沙'),(3,'明斯克'),(4,'河内'),(5,'布列斯特'),(6,'波兹南'),(7,'仁川港'),(8,'马拉'),(9,'布列斯特'),(10,'波兰');

#
# Structure for table "product_shopinfo"
#

CREATE TABLE `product_shopinfo` (
  `product_ShopID` int(10) NOT NULL AUTO_INCREMENT,
  `product_SellerName` varchar(200) NOT NULL,
  `product_ShopContactPerson` varchar(200) DEFAULT NULL,
  `product_ShopPhoneNo` varchar(200) DEFAULT NULL,
  `product_ShopEmail` varchar(200) DEFAULT NULL,
  `product_ShopAddTime` datetime DEFAULT NULL,
  PRIMARY KEY (`product_ShopID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=gbk;

#
# Data for table "product_shopinfo"
#

INSERT INTO `product_shopinfo` VALUES (1,'郑欧商城','张博','18237103205','zhangbo@zih718.com',NULL),(2,'万国优品','万国','12345678902','12345678901@163.com',NULL),(3,'洋洋臻品','张博','12345678901','zb@163.com',NULL),(4,'test','test','test','test',NULL),(5,'test2','test','test','test',NULL),(6,'test25','test','test','test',NULL),(9,'郑州国际陆港开发建设有限公司','张博','18237103205','zhangbo@zih718.com',NULL),(10,'1','1','1','1',NULL);

#
# Structure for table "rp_info"
#

CREATE TABLE `rp_info` (
  `rp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `mch_billno` varchar(50) NOT NULL COMMENT '商户订单号',
  `detail_id` varchar(50) NOT NULL COMMENT '红包单号',
  `status` varchar(50) NOT NULL DEFAULT '' COMMENT '红包状态  1—发放中，2—已发放待领取，3—发放失败，4—已领取，5—退款中，6—已退款',
  `send_type` varchar(32) NOT NULL DEFAULT 'API' COMMENT '发放类型',
  `total_num` int(11) NOT NULL COMMENT '红包个数',
  `total_amount` int(11) NOT NULL COMMENT '红包金额',
  `reason` varchar(50) NOT NULL COMMENT '失败原因',
  `send_time` varchar(50) NOT NULL COMMENT '红包发送时间',
  `refund_time` varchar(50) NOT NULL COMMENT '红包退款时间',
  `refund_amount` varchar(50) NOT NULL COMMENT '红包退款金额',
  `act_name` varchar(50) NOT NULL COMMENT '活动名称',
  `hblist` varchar(500) NOT NULL COMMENT '红包领取表',
  `hb_type` varchar(32) DEFAULT NULL COMMENT 'GROUP:裂变红包   NORMAL:普通红包',
  PRIMARY KEY (`rp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='红包详情';

#
# Data for table "rp_info"
#

INSERT INTO `rp_info` VALUES (9,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(10,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(11,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(12,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(13,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(14,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(15,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(16,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(17,'1417986702201701191510437267','1000041701201701193000051715054','RECEIVED','API',0,300,'','2017-01-19 15:10:44','','','','a:3:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynw_zzJh1k-z0MDjKxtKyJ52k\";s:6:\"amount\";s:2:\"21\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:19:39\";}i:1;a:3:{s:6:\"openid\";s:28:\"oyTynw2btbc5de4LeUV5oxTSWHqo\";s:6:\"amount\";s:2:\"90\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:14:31\";}i:2;a:3:{s:6:\"openid\";s:28:\"oyTynwyKWZA8ttUeKtrLHbkMqKEQ\";s:6:\"amount\";s:3:\"189\";s:8:\"rcv_time\";s:19:\"2017-01-19 15:12:56\";}}',NULL),(18,'1417986702201701182243135856','1000041701201701183000103634031','RECEIVED','API',0,300,'','2017-01-18 22:43:21','2017-01-19 23:09:17','186','','a:1:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynwycRH2y476VAp8R7E6Okx9c\";s:6:\"amount\";s:3:\"114\";s:8:\"rcv_time\";s:19:\"2017-01-18 22:44:46\";}}',NULL),(19,'1417986702201701182243135856','1000041701201701183000103634031','RECEIVED','API',0,300,'','2017-01-18 22:43:21','2017-01-19 23:09:17','186','','a:1:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynwycRH2y476VAp8R7E6Okx9c\";s:6:\"amount\";s:3:\"114\";s:8:\"rcv_time\";s:19:\"2017-01-18 22:44:46\";}}',NULL),(20,'1417986702201701182243135856','1000041701201701183000103634031','RECEIVED','API',0,300,'','2017-01-18 22:43:21','2017-01-19 23:09:17','186','','a:1:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynwycRH2y476VAp8R7E6Okx9c\";s:6:\"amount\";s:3:\"114\";s:8:\"rcv_time\";s:19:\"2017-01-18 22:44:46\";}}',NULL),(21,'1417986702201701182243135856','1000041701201701183000103634031','RECEIVED','API',0,300,'','2017-01-18 22:43:21','2017-01-19 23:09:17','186','','a:1:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynwycRH2y476VAp8R7E6Okx9c\";s:6:\"amount\";s:3:\"114\";s:8:\"rcv_time\";s:19:\"2017-01-18 22:44:46\";}}',NULL),(22,'1417986702201701182243135856','1000041701201701183000103634031','RECEIVED','API',0,300,'','2017-01-18 22:43:21','2017-01-19 23:09:17','186','','a:1:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynwycRH2y476VAp8R7E6Okx9c\";s:6:\"amount\";s:3:\"114\";s:8:\"rcv_time\";s:19:\"2017-01-18 22:44:46\";}}',NULL),(23,'1417986702201701182243135856','1000041701201701183000103634031','RECEIVED','API',0,300,'','2017-01-18 22:43:21','2017-01-19 23:09:17','186','','a:1:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynwycRH2y476VAp8R7E6Okx9c\";s:6:\"amount\";s:3:\"114\";s:8:\"rcv_time\";s:19:\"2017-01-18 22:44:46\";}}',NULL),(24,'1417986702201701182243135856','1000041701201701183000103634031','RECEIVED','API',0,300,'','2017-01-18 22:43:21','2017-01-19 23:09:17','186','','a:1:{i:0;a:3:{s:6:\"openid\";s:28:\"oyTynwycRH2y476VAp8R7E6Okx9c\";s:6:\"amount\";s:3:\"114\";s:8:\"rcv_time\";s:19:\"2017-01-18 22:44:46\";}}',NULL);

#
# Structure for table "store_bill_in_head"
#

CREATE TABLE `store_bill_in_head` (
  `putpre_head_id` int(11) NOT NULL AUTO_INCREMENT,
  `seq_no` varchar(36) NOT NULL COMMENT '外部对接编号',
  `plat_no` varchar(36) NOT NULL COMMENT '外部企业编码，平台代码',
  `customs` varchar(36) NOT NULL COMMENT '对接海关区域代码',
  `store_bill_no` varchar(36) NOT NULL COMMENT '进库单号',
  `ems_no` varchar(20) NOT NULL COMMENT '账册编号',
  `entry_id` varchar(50) NOT NULL DEFAULT '' COMMENT '报关单号，集报时不填',
  `store_type` varchar(4) NOT NULL COMMENT '入库方式',
  `orders_no` varchar(50) NOT NULL COMMENT '提单号/转关单号',
  `contr_no` varchar(50) NOT NULL COMMENT '入库合同号',
  `trade_code` varchar(20) NOT NULL COMMENT '经营单位代码',
  `trade_name` varchar(255) NOT NULL COMMENT '经营单位名称',
  `trade_mode` varchar(4) NOT NULL COMMENT '贸易方式',
  `num` int(10) NOT NULL,
  `gross_wt` decimal(18,5) DEFAULT NULL COMMENT '毛重',
  `net_wt` decimal(18,5) DEFAULT NULL COMMENT '净重',
  `provider_code` varchar(30) NOT NULL COMMENT '供应商编码',
  `provider_name` varchar(255) NOT NULL COMMENT '供应商名称',
  `pre_start_date` date NOT NULL COMMENT '预报开始时间',
  `pre_end_date` date NOT NULL COMMENT '预报结束时间',
  `in_start_date` date NOT NULL COMMENT '入库开始时间，确报时填写',
  `in_end_date` date NOT NULL COMMENT '入库结束时间，确报时填写',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `area_code` varchar(10) NOT NULL COMMENT '区域代码',
  `customs_code` varchar(10) NOT NULL COMMENT '主管海关',
  `step_id` varchar(10) NOT NULL COMMENT '当前环节',
  `create_person` varchar(50) NOT NULL COMMENT '创建人',
  `create_date` date NOT NULL COMMENT '创建时间',
  `declare_person` varchar(50) NOT NULL COMMENT '申报人',
  `declare_date` date NOT NULL COMMENT '申报时间',
  `approve_person` varchar(50) NOT NULL COMMENT '审批人',
  `approve_date` date NOT NULL COMMENT '审批时间',
  `outer_comment` varchar(500) NOT NULL COMMENT '外部审批意见',
  `inner_comment` varchar(500) NOT NULL COMMENT '内部审批意见',
  PRIMARY KEY (`putpre_head_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=gbk;

#
# Data for table "store_bill_in_head"
#

INSERT INTO `store_bill_in_head` VALUES (1,'','','','445','22','333','t','','','','90','',0,0.00000,0.00000,'','','2017-03-02','0000-00-00','0000-00-00','0000-00-00','','','','预录入','','0000-00-00','','0000-00-00','','0000-00-00','',''),(8,'','','','1','','','','','','','','',0,NULL,NULL,'','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','','','0000-00-00','','0000-00-00','','0000-00-00','',''),(9,'','','','2','','','','','','','','',0,NULL,NULL,'','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','','','0000-00-00','','0000-00-00','','0000-00-00','',''),(10,'','','','3','','','','','','','','',0,NULL,NULL,'','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','','','0000-00-00','','0000-00-00','','0000-00-00','',''),(11,'','','','45654','','','','','','','','',0,NULL,NULL,'','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','','','0000-00-00','','0000-00-00','','0000-00-00','',''),(12,'','','','345232','','','','','','','','',0,NULL,NULL,'','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','','','0000-00-00','','0000-00-00','','0000-00-00','',''),(13,'','','','654','','','','','','','','',0,NULL,NULL,'','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','','','0000-00-00','','0000-00-00','','0000-00-00','',''),(14,'','','','978','','','','','','','','',0,NULL,NULL,'','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','','','0000-00-00','','0000-00-00','','0000-00-00','',''),(15,'','','','4','54','','45','','','','','',0,NULL,NULL,'','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','','','0000-00-00','','0000-00-00','','0000-00-00','','');

#
# Structure for table "store_bill_in_head1"
#

CREATE TABLE `store_bill_in_head1` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `store_bill_no` varchar(255) NOT NULL DEFAULT '',
  `ems_no` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

#
# Data for table "store_bill_in_head1"
#

INSERT INTO `store_bill_in_head1` VALUES (1,'34',''),(2,'1',''),(3,'322',''),(4,'34354',''),(5,'5645',''),(6,'4','');

#
# Structure for table "tk_check"
#

CREATE TABLE `tk_check` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Express_No` varchar(25) DEFAULT NULL,
  `Store_Id` varchar(25) DEFAULT NULL,
  `Count_Store` int(10) NOT NULL DEFAULT '0',
  `Scan_Store_Num` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=gbk;

#
# Data for table "tk_check"
#

INSERT INTO `tk_check` VALUES (1,'6911989113589','6925517200047',2,2),(2,'6911989113589','9787121053863',3,3);

#
# Structure for table "user_info"
#

CREATE TABLE `user_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(150) NOT NULL COMMENT '微信会员openid',
  `nickname` varchar(150) CHARACTER SET gb2312 NOT NULL COMMENT '昵称',
  `headimgurl` varchar(150) CHARACTER SET gb2312 NOT NULL COMMENT '用户头像',
  `datetime` int(11) NOT NULL COMMENT '添加时间',
  `Error_time` datetime DEFAULT NULL,
  `Error_count` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=gbk;

#
# Data for table "user_info"
#

INSERT INTO `user_info` VALUES (2,'oyTynw89Gf5ZLL8EbTfXnZH-Ij6c','我.....你','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKxgshMABuic4Me2HtpIJtnzAriasrPTC1uMA4JnBiaoW5icvhPACgwx208POzYAlicMzaficOo31LvicEbA/0',1486717601,NULL,0),(6,'oyTynw7B3_yrilhCYBiLg5fOrQ-M','霸气的狮子','http://wx.qlogo.cn/mmopen/6aw7fqRyYzGYIAxavUh26vBrxQpACXaGEhDp8ABjibIY2p5pJwe361szEeZibVRpnGAenR8aNzf2B29lgCIDtImsKUydqWic0eO/0',1485075945,NULL,0),(7,'oyTynww9GRx0muyYJ44uY4Bl9Okw','Zy','http://wx.qlogo.cn/mmopen/6aw7fqRyYzGYIAxavUh26n3erbeTDEs1L4MrQG42ey2qcIuLIsbh4qcoFzV6b6bXYDojFEcL5IdEjRDymkNs02HibrXpVVicQO/0',1484748128,NULL,0),(8,'oyTynwxmY6Tqd3NDyaj70NX4JAXY','尘埃落定','http://wx.qlogo.cn/mmopen/6aw7fqRyYzEETvub6qW1Ku5oibw520XjmhBNdKA82U9icicynfMyklxDwicmalgfy6MHicUrclmBiajxia973w4vEHfuKWRIBQ2O3wG/0',1486462660,NULL,0),(9,'oyTynwycRH2y476VAp8R7E6Okx9c','Admire','http://wx.qlogo.cn/mmopen/soicIViaC6LPNqhvW03YaXnsJtFIvMeL0kMBM4CU1aGR6uVia232T6AURqEicnY9OavlBvlHhuJ65ROfNjCVeoZUXItvHSCQViaE3/0',1484750566,NULL,0),(10,'oyTynw-DkAhdBJ0E41etgPT41DD4','张博','http://wx.qlogo.cn/mmopen/6aw7fqRyYzGYIAxavUh26rGHax1J6ia0Ku8eMib8xu2DgiavSKV9hsl9GiaY6KWjdvpiatPicoNg4yYCaCYqNp9rVibqjAe71um8E9l/0',1484876745,NULL,0),(11,'oyTynw7VuPBWoqdE7QUDdvgRZpP8','橙子','http://wx.qlogo.cn/mmopen/PiajxSqBRaELJCEIyRNl9ArSW3TkmcQOogz49xzT5BvnFBcJwtdjyqibfahuv42GDTqKF2beTwxuAIWeJRZobuSQ/0',1484873757,NULL,0),(12,'oyTynw-HENpX-RnbsMz08UTP5Y14','婷婷','http://wx.qlogo.cn/mmopen/sTJptKvBQLLglXkusdibbxnicGnsIkEOVDxyzbOWrSrDibR2k7oKicMqiabm31KGzMMt0wzEv0YFQTDQwjNDInjSnOJBoiaJfRdOx6/0',1484699515,NULL,0),(13,'oyTynw-jNiHhEAp7EzrrqARLThsI','kevinnee','http://wx.qlogo.cn/mmopen/soicIViaC6LPM2S6UXRxNibO0KLZ0ibiaibqdw9KwZbKibORF4zIicZGT4NGZ31DviboQT5zalICZohEUBSGnqSlaMm3nhb8HRqjaia6TK/0',1484700788,NULL,0),(14,'oyTynw_nqTWQLckAybTdjnHK2msY','Lxx? 张九龙','http://wx.qlogo.cn/mmopen/zEiaaCXBwXrrvzLFogZfMQwdryXkFSyqRTw1fk1eH8AHtKibEW8zgkrfK0tx68gpn7ibJ9gnBtRBa2XyuzuAsPttda9lyNV0Eca/0',1484728980,NULL,0),(15,'oyTynw0dsG2HHB6IzugQub6BapYo','阿伏','http://wx.qlogo.cn/mmopen/6aw7fqRyYzHdm5MI6LOribFW36TLO66nbVB13NRF3oADqGvft3rcu1OylzutC4OkWicHUhJTSNxXOrr485JrJA2K0ibusr7WDiaV/0',1484804079,NULL,0),(16,'oyTynw_ynko_2d2QJDQujRJZW9FE','蜗壳','http://wx.qlogo.cn/mmopen/ajNVdqHZLLB3Po2hQib88PZLSnnroCDzuUGiaz0fRYzE5dm5xicxoUr9tJ6ZNd4GHCZ45Xw5XQcckqRELzw3H0M4A/0',1484809963,NULL,0),(17,'oyTynwyKWZA8ttUeKtrLHbkMqKEQ','雅','http://wx.qlogo.cn/mmopen/soicIViaC6LPNqhvW03YaXnuqZtzWEZGFUcMAWjaWayTfkvmVb3xoEaFrp8juR119vas5tINlA0tuEOvzhicBSYicabric2QCPUHP/0',1484809730,NULL,0),(18,'oyTynw9UclbS0GIxcLgtekEGa77k','卜算子','http://wx.qlogo.cn/mmopen/zEiaaCXBwXroS60W0E4QNXcsXF58FKY0iaSoa3U9TiawZ023YuQBrDFJfghUtV5auHPVxC79eEfAiasO6QYYrNV75njMGzPykLUa/0',1484813146,NULL,0),(19,'oyTynw-tcSjEW0IZViQY0_l1HhRg','黄坤','http://wx.qlogo.cn/mmopen/6aw7fqRyYzHRSrYWrRCQj4Rku2DduLrYiaBfIgNic4TEibCPBCW1gkHQYlXyH98oicRfz8sAL77mynic4PsgsU3I0KBfiaWyH3KduH/0',1484875158,NULL,0),(20,'oyTynw1koXVikKmcSBb5RBA2zdKI','杨林凯','http://wx.qlogo.cn/mmopen/PiajxSqBRaELwgGXmichHj1PV4B13lDVgl3WT8QfRc7FMzCU1sq1cZS37MqlZNrPOtD9PfWgxAveMkIeT6UL0xsQ/0',1484818443,NULL,0),(21,'oyTynw1E9zhLbjDl_WA3hFOUOWyY','晨曦&&直航','http://wx.qlogo.cn/mmopen/zEiaaCXBwXrrvzLFogZfMQysy3kLIwa7v1F8M4iaYBv7IlxWrx7pPPZZ2oABehaicfJBouc0oI3PdIpQVWSLbxcYWoJngFvg27g/0',1484901085,NULL,0),(22,'oyTynw7-P5kPWaGU4uQ2k5OCzHrY','Eleven Yu','http://wx.qlogo.cn/mmopen/sTJptKvBQLLglXkusdibbxjf6M7CKGwSiakOjT4rgUgDrYV9iaoMef6Q3lRdwZjicsmKGG5mw2aWWibhXGWYEfWaiamVgLUvFnprOq/0',1484832552,NULL,0),(23,'oyTynw_XKiv-rWpvEyHmICKPRPbk','龚春杨','http://wx.qlogo.cn/mmopen/ajNVdqHZLLARdJjAkLAicMcI8WvK2FC4eqKJXbmqwJsLAAucHbh5eQ7Rd0BqSicRQubS6C2S00WtRBRhegsY07iapyXujS0q8tUSiaqSwrUNCoM/0',1484881610,NULL,0);
