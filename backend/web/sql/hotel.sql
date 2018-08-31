/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 酒店房间
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Hotels`;
CREATE TABLE `#DB_PREFIX#Hotels` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `hotel_id` VARCHAR(85) NOT NULL COMMENT ' 酒店编号,唯一识别码',
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `password` VARCHAR(125) NOT NULL COMMENT '酒店密码',
    `name` VARCHAR(125) NOT NULL COMMENT '酒店名称',
    `content` TEXT NOT NULL COMMENT '产品内容',
	  `address` VARCHAR(125) NOT NULL COMMENT '酒店地址',
    `introduction` VARCHAR(255) NULL COMMENT '导读',
    `keywords` VARCHAR(120) NULL COMMENT '关键字',
    `path` VARCHAR(255) NULL COMMENT '酒店文件路径',
    `thumb` VARCHAR(85) NULL COMMENT '酒店缩略图',
    `images` VARCHAR(85) NULL COMMENT '酒店图片',
    `is_promote` SET('On', 'Off') NOT NULL COMMENT '推广',
    `is_using` SET('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `is_comments` SET('On', 'Off') NOT NULL COMMENT '是否启用评论',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `hotel_id` (`hotel_id`),
    UNIQUE `name` (`name`),
    KEY `user_id` (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#DB_PREFIX#Rooms`;
CREATE TABLE `#DB_PREFIX#Rooms` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `hotel_id` VARCHAR(85) NOT NULL COMMENT ' 酒店编号,唯一识别码',
    `room_id` VARCHAR(85) NOT NULL COMMENT ' 房间编号,唯一识别码',
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `c_key` VARCHAR(55) NOT NULL COMMENT '房间分类KEY',
    `room_num` VARCHAR(55) NOT NULL COMMENT '房间号码',
    `title` VARCHAR(125) NOT NULL COMMENT '产品标题',
    `content` TEXT NOT NULL COMMENT '产品内容',
    `num` INT(11) UNSIGNED NOT NULL COMMENT '房间数量',
    `check_in_num` INT(11) UNSIGNED NOT NULL COMMENT '入住房间数量',
    `price` INT(11) UNSIGNED NOT NULL COMMENT '一口价',
    `discount` DECIMAL(6,2) NULL COMMENT '折扣价',
    `introduction` VARCHAR(255) NULL COMMENT '导读,获取房间介绍第一段.',
    `keywords` VARCHAR(120) NULL COMMENT '关键字',
    `path` VARCHAR(255) NULL COMMENT '房间文件路径',
    `thumb` VARCHAR(125) NULL COMMENT '房间缩略图',
    `images` VARCHAR(255) NULL COMMENT '房间图片',
    `is_promote` SET('On', 'Off') NOT NULL COMMENT '推广',
    `is_using` SET('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `is_comments` SET('On', 'Off') NOT NULL COMMENT '是否启用评论',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `hotel_id` (`hotel_id`),
    UNIQUE `title` (`title`),
    KEY `user_id` (`user_id`),
    KEY `c_key` (`c_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 房间参数
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Rooms_Field`;
CREATE TABLE `#DB_PREFIX#Rooms_Field` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `f_key` VARCHAR(55) NOT NULL COMMENT '参数关键KEY',
    `name` VARCHAR(85) NULL COMMENT '字段名',
    `description` VARCHAR(125) NULL COMMENT '字段描述',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE `name` (`name`),
    KEY `f_key` (`f_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 关联房间参数
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Relevance_Rooms_Field`;
CREATE TABLE `#DB_PREFIX#Relevance_Rooms_Field` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `f_key` VARCHAR(55) NOT NULL COMMENT '房间参数关键KEY',
    `hotel_id` VARCHAR(55) NOT NULL COMMENT '房间关键KEY',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 房间分类
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Rooms_Classify`;
CREATE TABLE `#DB_PREFIX#Rooms_Classify` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `c_key` VARCHAR(55) NOT NULL COMMENT '分类KEY',
    `sort_id` INT(11) UNSIGNED NOT NULL COMMENT '排序',
    `name` VARCHAR(85) NOT NULL COMMENT '房间名称',
    `description` TEXT NULL COMMENT '描述',
    `keywords` VARCHAR(55) NULL COMMENT '关键字',
    `json_data` VARCHAR(55) NULL COMMENT 'Json 数据',
    `parent_id` VARCHAR(55) NOT NULL COMMENT '父类ID',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `c_key` (`c_key`),
    UNIQUE `name` (`name`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 房间分类
 */
INSERT INTO `#DB_PREFIX#Rooms_Classify`
VALUES
(NULL, 'C1', 1, '商务大床房', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C2', 2, '大床房', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C3', 3, '标准双床房', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C4', 4, '商务套房', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C5', 5, '豪华商务房', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C6', 6, '公寓套房', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C7', 7, '总统套房', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#);

/**
 + ------------------------------------------------------------------------------------------------------------
 * 订单中心
 + ------------------------------------------------------------------------------------------------------------
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Order`;
CREATE TABLE `#DB_PREFIX#Order` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `hotel_id` VARCHAR(55) NOT NULL COMMENT '酒店编号',
    `room_id` VARCHAR(55) NOT NULL COMMENT '房间编号',
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `c_key` VARCHAR(55) NOT NULL COMMENT '订单分类',
    `price` INT(11) UNSIGNED NOT NULL COMMENT '价格',
    `title` VARCHAR(125) NOT NULL COMMENT '标题',
    `content` TEXT NOT NULL COMMENT '描述内容',
    `keywords` VARCHAR(55) NULL COMMENT '关键字',
    `username` VARCHAR(55) NULL COMMENT '制单人',
    `path` VARCHAR(55) NULL COMMENT '订单路径',
    `num` integer NOT NULL DEFAULT '0' COMMENT '入住人数',
    `check_in` integer NOT NULL DEFAULT '0' COMMENT '入住时间',
    `check_out` integer NOT NULL DEFAULT '0' COMMENT '退房时间',
    `pay_type` SET('wechat', 'alipay', 'cash') NOT NULL COMMENT '支付方式',
    `express_type` SET('On', 'Off', 'Out', 'Not', 'Hold') NOT NULL COMMENT '发货状态, hold (待发货)',
    `is_using` SET('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `place_order` integer NOT NULL DEFAULT '0' COMMENT '下单时间',
    `pay_order` integer NOT NULL DEFAULT '0' COMMENT '支付时间',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `hotel_id` (`hotel_id`),
    KEY `user_id` (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 + ------------------------------------------------------------------------------------------------------------
 * 酒店卡卷
 + ------------------------------------------------------------------------------------------------------------
 */

/**
 * 卡卷
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Coupon`;
CREATE TABLE `#DB_PREFIX#Coupon` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `coupon_key` VARCHAR(125) NULL DEFAULT NULL COMMENT '优惠券识别KEY',
    `validity` VARCHAR(125) NOT NULL COMMENT '优惠券有效日期',
    `title` VARCHAR(125) NULL COMMENT '优惠券标题',
	  `num` integer NOT NULL DEFAULT '0' COMMENT '卡卷数量',
    `denomination` INT(6) UNSIGNED NOT NULL COMMENT '优惠券面额',
    `quota` INT(6) UNSIGNED NOT NULL COMMENT '优惠券使用限额',
    `remarks` VARCHAR(125) NULL COMMENT '优惠券备注',
    `images` VARCHAR(255) NULL COMMENT '优惠券图片',
    `coupon_type` SET('discount', 'coupon') NOT NULL COMMENT '卡卷类型：折扣劵 / 优惠卷',
    `pay_type` SET('before', 'after', 'wechat') NOT NULL COMMENT '消费方式：消费后送,消费前送,关注公众号',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `coupon_key` (`coupon_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 关联卡卷
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Relevance_Rooms_Coupon`;
CREATE TABLE `#DB_PREFIX#Relevance_Rooms_Coupon` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `coupon_key` VARCHAR(55) NOT NULL COMMENT '优惠卷关键KEY',
    `room_id` VARCHAR(55) NOT NULL COMMENT '房间关键KEY',
    `use_up` integer NOT NULL COMMENT '消耗了几张优惠卷',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
	  KEY `room_id` (`room_id`),
	  KEY `coupon_key` (`coupon_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 + ------------------------------------------------------------------------------------------------------------
 * 积分系统
 + ------------------------------------------------------------------------------------------------------------
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Credit`;
CREATE TABLE `#DB_PREFIX#Credit` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户编号ID',
    `credit_change` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '积分变化',
    `remarks` VARCHAR(125) NULL COMMENT '备注',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id` (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 + ------------------------------------------------------------------------------------------------------------
 * 财务系统
 + ------------------------------------------------------------------------------------------------------------
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Finance_Detailed`;
CREATE TABLE `#DB_PREFIX#Finance_Detailed` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户编号ID',
    `money_change` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '余额变化',
    `remarks` VARCHAR(125) NULL COMMENT '备注',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id` (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='余额明细表';

DROP TABLE IF EXISTS `#DB_PREFIX#Recharge_Detailed`;
CREATE TABLE `#DB_PREFIX#Recharge_Detailed` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户编号ID',
    `money` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '充值记录',
    `remarks` VARCHAR(125) NULL COMMENT '备注',
    `pay_type` SET('wechat', 'alipay', 'cash') NOT NULL COMMENT '支付方式',
    `status_type` SET('On', 'Off', 'Not', 'Out') NOT NULL COMMENT '状态',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id` (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='充值记录表';