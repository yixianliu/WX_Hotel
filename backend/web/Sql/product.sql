/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 产品
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Product`;
CREATE TABLE `#DB_PREFIX#Product` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `product_id` VARCHAR(85) NOT NULL COMMENT '产品编号,唯一识别码',
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `c_key` VARCHAR(55) NOT NULL COMMENT '产品分类KEY',
    `title` VARCHAR(125) NOT NULL COMMENT '产品标题',
    `content` TEXT NOT NULL COMMENT '产品内容',
    `price` INT(11) UNSIGNED NOT NULL COMMENT '一口价',
    `discount` INT(11) UNSIGNED NULL COMMENT '折扣价',
    `introduction` VARCHAR(255) NULL COMMENT '导读,获取产品介绍第一段.',
    `keywords` VARCHAR(120) NULL COMMENT '关键字',
    `path` VARCHAR(255) NULL COMMENT '产品文件路径',
    `thumb` VARCHAR(85) NULL COMMENT '产品缩略图',
    `images` VARCHAR(85) NULL COMMENT '产品图片',
    `praise` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '赞数量',
    `forward` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '转发数量',
    `collection` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '收藏数量',
    `share` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '分享数量',
    `attention` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '关注数量',
    `is_promote` SET('On', 'Off') NOT NULL COMMENT '推广',
    `is_hot` SET('On', 'Off') NOT NULL COMMENT '热门',
    `is_classic` SET('On', 'Off') NOT NULL COMMENT '经典',
    `is_winnow` SET('On', 'Off') NOT NULL COMMENT '精选',
    `is_recommend` SET('On', 'Off') NOT NULL COMMENT '推荐',
    `is_audit` SET('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `is_field` SET('On', 'Off') NOT NULL COMMENT '是否生成字段JSON文件,没有生成的话,产品异常!',
    `is_comments` SET('On', 'Off') NOT NULL COMMENT '是否启用评论',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `product_id` (`product_id`),
    UNIQUE `title` (`title`),
    KEY `user_id` (`user_id`),
    KEY `c_key` (`c_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 产品分类(产品属于那种类型,例如电子产品,服装产品,这里的分类是根据版块ID来分类的)
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Product_Classify`;
CREATE TABLE `#DB_PREFIX#Product_Classify` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `c_key` VARCHAR(55) NOT NULL COMMENT '分类KEY',
    `sort_id` INT(11) UNSIGNED NOT NULL COMMENT '排序',
    `name` VARCHAR(85) NOT NULL COMMENT '名称',
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
 * 产品图片 / (产品图片记录入数据库的都是封面图片,其他图片均存入指定目录)
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Product_Image`;
CREATE TABLE `#DB_PREFIX#Product_Image` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `product_id` VARCHAR(55) NOT NULL COMMENT '产品ID',
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `path` VARCHAR(125) NOT NULL COMMENT '图片路径',
    `primary` TINYINT(1) UNSIGNED NULL COMMENT '封面图片,值为1的时候,该图片为封面',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `product_id` (`product_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 产品参数
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Product_Field`;
CREATE TABLE `#DB_PREFIX#Product_Field` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `c_key` VARCHAR(55) NOT NULL COMMENT '产品分类KEY (根据分类生成产品参数)',
    `name` VARCHAR(85) NULL COMMENT '字段名',
    `description` VARCHAR(125) NULL COMMENT '字段描述',
    `is_required` SET('On', 'Off') NOT NULL COMMENT '是否必填',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE `name` (`name`),
    KEY `c_key` (`c_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 产品评论
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Product_Comment`;
CREATE TABLE `#DB_PREFIX#Product_Comment` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `c_id` VARCHAR(125) NOT NULL COMMENT '评论编码,唯一识别码',
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `product_id` VARCHAR(85) NOT NULL COMMENT '产品ID',
    `content` VARCHAR(255) NOT NULL COMMENT '内容',
    `praise` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '支持',
    `oppose` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '反对',
    `ref_comment_id` INT(11) UNSIGNED NOT NULL COMMENT '引用评论ID',
    `is_unread` SET('On', 'Off') NOT NULL COMMENT '未读',
    `is_hot` SET('On', 'Off') NOT NULL COMMENT '热门',
    `is_audit` SET('On', 'Off') NOT NULL COMMENT '审核',
    `grade` INT(11) UNSIGNED NOT NULL COMMENT '支持率',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `c_id` (`c_id`),
    KEY `user_id` (`user_id`),
    KEY `product_id` (`product_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 推广产品,根据位置也有不同的推广内容
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Product_Promote`;
CREATE TABLE `#DB_PREFIX#Product_Promote` (
    `promote_id` INT(11) NULL AUTO_INCREMENT,
    `product_id` INT(11) UNSIGNED NOT NULL COMMENT '产品ID',
    `sort_id` INT(11) UNSIGNED NOT NULL COMMENT '排序ID',
    `location` SET('Index', 'Details') NOT NULL COMMENT '位置',
    `orientation` SET('Left', 'Down', 'Slide') NOT NULL COMMENT '方位',
    `name` VARCHAR(55) NULL COMMENT '字段名',
    `content` VARCHAR(255) NULL COMMENT '字段值',
    PRIMARY
    KEY (`promote_id`),
    KEY `sort_id` (`sort_id`),
    KEY `product_id` (`product_id`)
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
    `title` VARCHAR(125) NOT NULL COMMENT '产品标题',
    `content` TEXT NOT NULL COMMENT '产品内容',
    `price` INT(11) UNSIGNED NOT NULL COMMENT '一口价',
    `discount` INT(11) UNSIGNED NULL COMMENT '折扣价',
    `introduction` VARCHAR(255) NULL COMMENT '导读,获取产品介绍第一段.',
    `keywords` VARCHAR(120) NULL COMMENT '关键字',
    `path` VARCHAR(255) NULL COMMENT '产品文件路径',
    `thumb` VARCHAR(85) NULL COMMENT '产品缩略图',
    `images` VARCHAR(85) NULL COMMENT '产品图片',
    `praise` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '赞数量',
    `forward` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '转发数量',
    `collection` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '收藏数量',
    `share` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '分享数量',
    `attention` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '关注数量',
    `is_promote` SET('On', 'Off') NOT NULL COMMENT '推广',
    `is_hot` SET('On', 'Off') NOT NULL COMMENT '热门',
    `is_classic` SET('On', 'Off') NOT NULL COMMENT '经典',
    `is_winnow` SET('On', 'Off') NOT NULL COMMENT '精选',
    `is_recommend` SET('On', 'Off') NOT NULL COMMENT '推荐',
    `is_audit` SET('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `is_field` SET('On', 'Off') NOT NULL COMMENT '是否生成字段JSON文件,没有生成的话,产品异常!',
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
 * 产品参数
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Hotels_Field`;
CREATE TABLE `#DB_PREFIX#Hotels_Field` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `c_key` VARCHAR(55) NOT NULL COMMENT '产品分类KEY (根据分类生成产品参数)',
    `name` VARCHAR(85) NULL COMMENT '字段名',
    `description` VARCHAR(125) NULL COMMENT '字段描述',
    `is_required` SET('On', 'Off') NOT NULL COMMENT '是否必填',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE `name` (`name`),
    KEY `c_key` (`c_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 房间分类
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Hotels_Classify`;
CREATE TABLE `#DB_PREFIX#Hotels_Classify` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `c_key` VARCHAR(55) NOT NULL COMMENT '分类KEY',
    `sort_id` INT(11) UNSIGNED NOT NULL COMMENT '排序',
    `name` VARCHAR(85) NOT NULL COMMENT '名称',
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
