/**
 * 网站设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Conf`;
CREATE TABLE `#DB_PREFIX#Conf` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `language` VARCHAR(85) NOT NULL COMMENT '配置语言',
    `name` VARCHAR(85) NOT NULL COMMENT '网站名称',
    `title` VARCHAR(135) NOT NULL COMMENT '网站标题',
    `email` VARCHAR(135) NOT NULL COMMENT '网站联系邮箱',
    `phone` VARCHAR(135) NOT NULL COMMENT '网站联系电话',
    `keywords` VARCHAR(135) NOT NULL COMMENT '网站关键词',
    `site_url` VARCHAR(135) NOT NULL COMMENT '网站URL地址',
    `developers` VARCHAR(135) NOT NULL COMMENT '开发者',
    `icp` VARCHAR(135) NOT NULL COMMENT '备案号',
    `description` TEXT NULL COMMENT '网站描述',
    `copyright` VARCHAR(135) NOT NULL COMMENT '字段值',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 网站辅助设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Assist`;
CREATE TABLE `#DB_PREFIX#Assist` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `c_key` VARCHAR(55) NOT NULL COMMENT '网站设置关键KEY',
    `name` VARCHAR(85) NOT NULL COMMENT '字段名',
    `content` VARCHAR(135) NOT NULL COMMENT '字段值',
    `description` TEXT NULL COMMENT '网站配置描述',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `c_key` (`c_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 广告
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Adv`;
CREATE TABLE `#DB_PREFIX#Adv` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `sort_id` INT(11) UNSIGNED NOT NULL COMMENT '排序ID',
    `weight` INT(6) UNSIGNED NOT NULL COMMENT '权重',
    `size` VARCHAR(55) NOT NULL COMMENT '广告形状大小',
    `urls` VARCHAR(125) NOT NULL COMMENT '链接地址',
    `is_audit` SET('On', 'Off') NOT NULL COMMENT '审核',
    `start_time` INT(11) UNSIGNED NOT NULL COMMENT '开始时间',
    `end_time` INT(11) UNSIGNED NOT NULL COMMENT '结束时间',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 友情链接
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Friend_Link`;
CREATE TABLE `#DB_PREFIX#Friend_Link` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `title` VARCHAR(85) NULL COMMENT '标题',
    `content` VARCHAR(255) NULL COMMENT '介绍',
    `author` VARCHAR(55) NULL COMMENT '联系人',
    `img` VARCHAR(125) NULL COMMENT '图片地址',
    `url` VARCHAR(125) NULL COMMENT '链接地址',
    `is_status` SET('On', 'Off') NOT NULL DEFAULT 'Off' COMMENT '友情链接状态',
    `is_audit` SET('On', 'Off') NOT NULL COMMENT '审核',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE `title` (`title`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 网站公告
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Announce`;
CREATE TABLE `#DB_PREFIX#Announce` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `title` VARCHAR(85) NOT NULL COMMENT '标题',
    `content` TEXT NOT NULL COMMENT '内容',
    `is_audit` SET('On', 'Off') NOT NULL COMMENT '审核',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    UNIQUE `title` (`title`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 管理员(包括审核,后台管理)
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Management`;
CREATE TABLE `#DB_PREFIX#Management` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `username` VARCHAR(85) NOT NULL COMMENT '账号',
    `password` VARCHAR(255) NOT NULL COMMENT '密码',
    `area` VARCHAR(125) NULL COMMENT '地区',
    `login_time` INT(11) UNSIGNED NOT NULL COMMENT '登陆时间',
    `last_login_time` INT(11) UNSIGNED NOT NULL COMMENT '最后登陆时间',
    `login_ip` VARCHAR(55) COMMENT '登陆IP',
    `token` INT(11) UNSIGNED NOT NULL COMMENT '权限ID',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 用户
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */

/**
 * 用户信息
 */
DROP TABLE IF EXISTS `#DB_PREFIX#User`;
CREATE TABLE `#DB_PREFIX#User` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户编号ID',
    `username` VARCHAR(55) NOT NULL COMMENT '邮箱 / 用户名',
    `password` VARCHAR(255) NOT NULL COMMENT '密码',
    `r_key` VARCHAR(55) NOT NULL COMMENT '角色关键KEY',
    `exp` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '经验值',
    `credit` INT(11) UNSIGNED NULL DEFAULT 0 COMMENT '积分',
    `nickname` VARCHAR(85) NULL DEFAULT NULL COMMENT '昵称',
    `signature` TEXT NULL DEFAULT NULL COMMENT '个性签名',
    `address` VARCHAR(125) NULL DEFAULT NULL COMMENT '通讯地址',
    `telphone` VARCHAR(55) NULL DEFAULT NULL COMMENT '手机号码',
    `birthday` VARCHAR(125) NULL DEFAULT 0 COMMENT '出生年月日',
    `answer` VARCHAR(125) NULL DEFAULT NULL COMMENT '用户答案',
    `problems_key` VARCHAR(55) NULL COMMENT '用户问题',
    `reg_time` INT(11) UNSIGNED NOT NULL COMMENT '注册时间',
    `last_login_time` INT(11) UNSIGNED NOT NULL COMMENT '最后登陆时间',
    `login_ip` VARCHAR(55) NULL DEFAULT 0 COMMENT '登陆IP',
    `sex` SET('Male' , 'Female') NOT NULL DEFAULT 'Female' COMMENT '性别',
    `is_microhurt` SET('On', 'Off', 'Not') NOT NULL COMMENT '是否开启商户',
    `is_display` SET('On', 'Off') NOT NULL DEFAULT 'Off' COMMENT '显示信息',
    `is_head` SET('On', 'Off') NOT NULL DEFAULT 'Off' COMMENT '上传头像',
    `is_security` SET('On', 'Off') NOT NULL DEFAULT 'Off' COMMENT '安全设置',
    `is_using` SET('On', 'Off', 'Not') NOT NULL DEFAULT 'Off' COMMENT '是否可用',
    PRIMARY KEY (`id`),
    KEY `r_key` (`r_key`),
    UNIQUE KEY `user_id` (`user_id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE `nickname` (`nickname`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 用户优惠券
 */
DROP TABLE IF EXISTS `#DB_PREFIX#User_Coupon`;
CREATE TABLE `#DB_PREFIX#User_Coupon` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `m_id` INT(11) UNSIGNED NOT NULL COMMENT '商户ID',
    `coupon_key` VARCHAR(125) NULL DEFAULT NULL COMMENT '优惠券识别KEY',
    `receive` INT(11) UNSIGNED NOT NULL COMMENT '优惠券领取日期',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id` (`user_id`),
    KEY `m_id` (`m_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 用户设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#User_Config`;
CREATE TABLE `#DB_PREFIX#User_Config` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `user_id` VARCHAR(55) NOT NULL COMMENT '用户ID',
    `get_praise` SET('On', 'Off') NOT NULL COMMENT '接收 / 赞提醒',
    `get_comment` SET('On', 'Off') NOT NULL COMMENT '接收 / 评论提醒',
    `is_access` SET('On', 'Off') NOT NULL COMMENT '是否开启访问',
    `is_show_phone` SET('On', 'Off') NOT NULL COMMENT '是否开启显示手机',
    `is_show_sex` SET('On', 'Off') NOT NULL COMMENT '是否开启显示性别',
    `is_show_address` SET('On', 'Off') NOT NULL COMMENT '是否开启显示通讯地址',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id` (`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 用户安全问题
 */
DROP TABLE IF EXISTS `#DB_PREFIX#User_Problems`;
CREATE TABLE `#DB_PREFIX#User_Problems` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `security_key` VARCHAR(20) NOT NULL COMMENT '安全问题KEY',
    `name` VARCHAR(55) NOT NULL COMMENT '问题',
    `is_using` SET('On', 'Off') NULL DEFAULT 'On' COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `security_key` (`security_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 菜单
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Menu`;
CREATE TABLE `#DB_PREFIX#Menu` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `m_key` VARCHAR(55) NOT NULL COMMENT '菜单值',
    `sort_id` INT(11) UNSIGNED NOT NULL COMMENT '排序ID',
    `model_key` VARCHAR(55) NULL COMMENT '菜单模型的关键KEY',
    `url_data` VARCHAR(155) NULL COMMENT '菜单数据',
    `r_key` VARCHAR(55) NULL COMMENT '角色关键KEY',
    `description` TEXT NULL COMMENT '描述',
    `parent_id` VARCHAR(55) NOT NULL COMMENT '父类值',
    `name` VARCHAR(85) NOT NULL COMMENT '菜单名称',
    `json_data` VARCHAR(155) NULL COMMENT 'Json 数据',
    `is_url` SET('On', 'Off') NOT NULL COMMENT '是否启用链接(不启用的话,此分类没有链接,只会获取权限)',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `m_key` (`m_key`),
    KEY `r_key` (`r_key`),
    KEY `name` (`name`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单表';

/**
 * 菜单模型
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Menu_Model`;
CREATE TABLE `#DB_PREFIX#Menu_Model` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `m_key` VARCHAR(55) NOT NULL COMMENT '菜单模型',
    `sort_id` INT(11) UNSIGNED NOT NULL COMMENT '排序ID',
    `url_type` VARCHAR(85) NULL COMMENT 'Url 类型',
    `url_key` VARCHAR(85) NULL COMMENT 'Url 模型关键KEY',
    `name` VARCHAR(85) NOT NULL COMMENT '模型名称',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `m_key` (`m_key`),
    UNIQUE KEY `url_key` (`url_key`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单模型表';
