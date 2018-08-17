/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 酒店
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Hotels`;
CREATE TABLE `#DB_PREFIX#Hotels` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `hotel_id` VARCHAR(85) NOT NULL COMMENT '产品编号,唯一识别码',
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `c_key` VARCHAR(55) NOT NULL COMMENT '产品分类KEY',
    `room_num` VARCHAR(55) NOT NULL COMMENT '房间号码',
    `title` VARCHAR(125) NOT NULL COMMENT '产品标题',
    `content` TEXT NOT NULL COMMENT '产品内容',
    `num` INT(11) UNSIGNED NOT NULL COMMENT '房间数量',
    `check_in_num` INT(11) UNSIGNED NOT NULL COMMENT '入住房间数量',
    `price` INT(11) UNSIGNED NOT NULL COMMENT '一口价',
    `discount` INT(11) UNSIGNED NULL COMMENT '折扣价',
    `introduction` VARCHAR(255) NULL COMMENT '导读,获取房间介绍第一段.',
    `keywords` VARCHAR(120) NULL COMMENT '关键字',
    `path` VARCHAR(255) NULL COMMENT '房间文件路径',
    `thumb` VARCHAR(85) NULL COMMENT '房间缩略图',
    `images` VARCHAR(85) NULL COMMENT '房间图片',
    `is_promote` SET('On', 'Off') NOT NULL COMMENT '推广',
    `is_audit` SET('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `is_comments` SET('On', 'Off') NOT NULL COMMENT '是否启用评论',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `hotel_id` (`hotel_id`),
    UNIQUE `title` (`title`),
    KEY `user_id` (`user_id`),
    KEY `c_key` (`c_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 房间参数
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Hotels_Field`;
CREATE TABLE `#DB_PREFIX#Hotels_Field` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `f_key` VARCHAR(55) NOT NULL COMMENT '参数关键KEY',
    `name` VARCHAR(85) NULL COMMENT '字段名',
    `description` VARCHAR(125) NULL COMMENT '字段描述',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `is_required` SET('On', 'Off') NOT NULL COMMENT '是否必填',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE `name` (`name`),
    KEY `f_key` (`f_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 关联房间参数
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Relevance_Hotels_Field`;
CREATE TABLE `#DB_PREFIX#Relevance_Hotels_Field` (
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
DROP TABLE IF EXISTS `#DB_PREFIX#Hotels_Classify`;
CREATE TABLE `#DB_PREFIX#Hotels_Classify` (
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
 * 产品分类
 */
INSERT INTO `#DB_PREFIX#Product_Classify`
VALUES
(NULL, 'C1', 1, '数码周边', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C2', 2, '母婴用品', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C3', 3, '时尚服装', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C4', 4, '商场百货', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C5', 5, '运动户外', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C6', 6, '美容美肤', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#),
(NULL, 'C7', 7, '珠玉宝石', NULL, NULL, NULL, 'C0', 'On', #TIME#, #TIME#);

/**
 + ------------------------------------------------------------------------------------------------------------
 * 订单中心
 + ------------------------------------------------------------------------------------------------------------
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Order`;
CREATE TABLE `#DB_PREFIX#Order` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `hotel_id` VARCHAR(55) NOT NULL COMMENT '房间编号',
    `price` INT(11) UNSIGNED NOT NULL COMMENT '价格',
    `title` VARCHAR(125) NOT NULL COMMENT '标题',
    `content` TEXT NOT NULL COMMENT '描述内容',
    `keywords` VARCHAR(55) NULL COMMENT '关键字',
    `html` VARCHAR(55) NULL COMMENT '静态路径',
    `num` integer NOT NULL DEFAULT '0' COMMENT '入住人数',
    `checkin` integer NOT NULL DEFAULT '0' COMMENT '入住时间',
    `checkout` integer NOT NULL DEFAULT '0' COMMENT '退房时间',
    `is_using` SET('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `hotel_id` (`hotel_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 + ------------------------------------------------------------------------------------------------------------
 * 本司卡卷
 + ------------------------------------------------------------------------------------------------------------
 */

/**
 * 本司卡卷
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Coupon`;
CREATE TABLE `#DB_PREFIX#Coupon` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `coupon_key` VARCHAR(125) NULL DEFAULT NULL COMMENT '优惠券识别KEY',
    `validity` VARCHAR(125) NOT NULL COMMENT '优惠券有效日期',
    `title` VARCHAR(125) NULL COMMENT '优惠券标题',
    `denomination` INT(6) UNSIGNED NOT NULL COMMENT '优惠券面额',
    `quota` INT(6) UNSIGNED NOT NULL COMMENT '优惠券使用限额',
    `remarks` VARCHAR(125) NULL COMMENT '优惠券备注',
    `coupon_type` SET('discount', 'coupon') NOT NULL COMMENT '卡卷类型：折扣劵 / 优惠卷',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `coupon_key` (`coupon_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
