/**
 * 管理员
 */
INSERT INTO `#DB_PREFIX#Management`
VALUES
(NULL, '#USERNAME#', '#PASSWORD#', NULL, #TIME#, #TIME#, NULL, 999, 'On', #TIME#, #TIME#),
(NULL, '#USERNAME#_Audit', '#PASSWORD#', NULL, #TIME#, #TIME#, NULL, 888, 'On', #TIME#, #TIME#);

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 用户角色
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */

/**
 * 角色
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Role`;
CREATE TABLE `#DB_PREFIX#Role` (
    `id` INT(11) NULL AUTO_INCREMENT,
    `sort_id` INT(11) UNSIGNED NOT NULL COMMENT '排序ID',
    `r_key` VARCHAR(55) NOT NULL COMMENT '权限关键KEY',
    `name` VARCHAR(85) NOT NULL COMMENT '名称',
    `exp` INT(11) UNSIGNED NOT NULL COMMENT '经验值',
    `description` TEXT NULL COMMENT '注释',
    `ico_class` VARCHAR(125) NULL COMMENT '角色图标样式',
    `is_using` SET('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer NOT NULL DEFAULT '0',
    `updated_at` integer NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `r_key` (`r_key`),
    UNIQUE `name` (`name`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/**
 * 角色
 */
INSERT INTO `#DB_PREFIX#Role`
VALUES
  (NULL, 1, 'R1', '一代宗师', 10000, '所有板块最高级别', NULL, 'On', #TIME#, #TIME#),
  (NULL, 2, 'R2', '首席长老', 9000, '板块内最高级别', NULL, 'On', #TIME#, #TIME#),
  (NULL, 3, 'R3', '左右护法', 8000, '圈内最高级别', NULL, 'On', #TIME#, #TIME#),
  (NULL, 4, 'R4', '骨灰元老', 4000, '本论坛贡献最高者', NULL, 'On', #TIME#, #TIME#),
  (NULL, 5, 'R5', '江湖奇才', 7000, '本版块贡献最高者', NULL, 'On', #TIME#, #TIME#),
  (NULL, 6, 'R6', '金牌会员', 6000, '金牌会员', NULL, 'On', #TIME#, #TIME#),
  (NULL, 7, 'R7', '高级会员', 5000, '高级会员', NULL, 'On', #TIME#, #TIME#),
  (NULL, 8, 'R8', '特约撰稿人', 3000, '特约撰稿人', NULL, 'On', #TIME#, #TIME#),
  (NULL, 9, 'R9', '中级会员', 2000, '中级会员', NULL, 'On', #TIME#, #TIME#),
  (NULL, 10, 'R10', '初级会员', 1000, '初级会员', NULL, 'On', #TIME#, #TIME#),
  (NULL, 11, 'R11', '普通会员', 500, '普通会员', NULL, 'On', #TIME#, #TIME#),
  (NULL, 12, 'R12', '验证用户', 100, '验证用户', NULL, 'On', #TIME#, #TIME#),
  (NULL, 13, 'R13', '禁止发言', 50, '禁止发言', NULL, 'On', #TIME#, #TIME#),
  (NULL, 14, 'R14', '未验证会员', 10, '未验证会员', NULL, 'On', #TIME#, #TIME#),
  (NULL, 15, 'R15', '游客', 0, '游客', NULL, 'On', #TIME#, #TIME#);

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 权限 / 角色
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */

DROP TABLE IF EXISTS `#DB_PREFIX#auth_role`;
CREATE TABLE `#DB_PREFIX#auth_role` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(80) NOT NULL DEFAULT '' COMMENT '角色名称',
    `description` varchar(80) NOT NULL DEFAULT '' COMMENT '权限描述',
    `rule_name` varchar(80) NULL DEFAULT NULL COMMENT '规则',
    `data` varchar(80) NULL DEFAULT NULL COMMENT '数据',
    `type` smallint NOT NULL DEFAULT 0 COMMENT '状态 1：角色 2：权限',
    `status` smallint NOT NULL DEFAULT 0 COMMENT '状态 1：有效 0：无效',
    `updated_at` integer NOT NULL DEFAULT '0' COMMENT '最后一次更新时间',
    `created_at` integer NOT NULL DEFAULT '0' COMMENT '插入时间',
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`),
    UNIQUE KEY `description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限表';

/**
 * 用户角色关联表
 */
DROP TABLE IF EXISTS `#DB_PREFIX#auth_user_role`;
CREATE TABLE `#DB_PREFIX#auth_user_role` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` varchar(80) NOT NULL COMMENT '用户id',
    `role_id` varchar(80) NOT NULL COMMENT '角色ID',
    `created_at` integer NOT NULL DEFAULT '0' COMMENT '插入时间',
    `updated_at` integer NOT NULL DEFAULT '0' COMMENT '最后一次更新时间',
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户角色关联表';

/**
 * 角色权限关联表
 */
DROP TABLE IF EXISTS `#DB_PREFIX#auth_role_permisson`;
CREATE TABLE `#DB_PREFIX#auth_role_permisson` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `parent` varchar(80) NOT NULL COMMENT '角色名称',
    `child` varchar(80) NOT NULL COMMENT '权限名称',
    PRIMARY KEY (`id`),
    KEY `parent` (`parent`),
    KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限关联表';

/**
 * 规则表
 */
DROP TABLE IF EXISTS `#DB_PREFIX#auth_rule`;
CREATE TABLE `#DB_PREFIX#auth_rule` (
    `name` varchar(80) NOT NULL,
    `data` blob,
    `updated_at` integer NOT NULL DEFAULT '0' COMMENT '最后一次更新时间',
    `created_at` integer NOT NULL DEFAULT '0' COMMENT '插入时间',
    primary key (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='规则表';

/**
 * 插入数据
 */

INSERT INTO `#DB_PREFIX#auth_user_role`
VALUES
(NULL, 1, 'admin', '#TIME#', '#TIME#'),
(NULL, 2, 'admin', '#TIME#', '#TIME#');

INSERT INTO `#DB_PREFIX#auth_role`
VALUES

/* 角色 */
(NULL, 'admin', '管理员', NULL, NULL, 1, 1, '#TIME#', '#TIME#'),
(NULL, 'guest', '游客', NULL, NULL, 1, 1, '#TIME#', '#TIME#'),
(NULL, 'user', '会员', NULL, NULL, 1, 1, '#TIME#', '#TIME#'),

/* 权限 */
(NULL, 'indexCenter', '管理首页', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'confCenter', '用户中心', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateCenter', '更新网站配置', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'createCenter', '创建网站配置', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewCenter', '查看网站配置', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteCenter', '删除网站配置', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'image-uploadUpload', '上传文件', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'backupCenter', '备份数据库', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'infoCenter', '网站档案', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'seoCenter', '网站SEO', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexTpl', '模板管理', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'editTpl', '编辑模板', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createMsg', '发布留言', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateMsg', '更新留言', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexMsg', '留言列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewMsg', '查看留言', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteMsg', '删除留言', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createSlide', '发布幻灯片', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateSlide', '更新幻灯片', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexSlide', '幻灯片列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewSlide', '查看幻灯片', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteSlide', '删除幻灯片', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createSlide-cls', '添加幻灯片类型', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateSlide-cls', '更新幻灯片类型', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexSlide-cls', '幻灯片类型列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewSlide-cls', '查看幻灯片类型', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteSlide-cls', '删除幻灯片类型', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createMenu', '添加菜单', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateMenu', '更新菜单', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexMenu', '菜单列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewMenu', '查看菜单', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteMenu', '删除菜单', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'adjustmentMenu', '菜单Url设置', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createUser', '添加用户', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateUser', '更新用户', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexUser', '用户列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewUser', '查看用户', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteUser', '删除用户', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createRole', '添加角色', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateRole', '更新角色', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexRole', '角色列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewRole', '查看角色', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteRole', '删除角色', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createPower', '添加权限', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updatePower', '更新权限', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexPower', '权限列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewPower', '查看权限', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deletePower', '删除权限', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createNews', '添加新闻', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateNews', '更新新闻', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexNews', '新闻列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewNews', '查看新闻', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteNews', '删除新闻', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createNews-cls', '添加新闻分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateNews-cls', '更新新闻分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexNews-cls', '新闻分类列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewNews-cls', '查看新闻分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteNews-cls', '删除新闻分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createProduct', '添加产品', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateProduct', '更新产品', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexProduct', '产品列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewProduct', '查看产品', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteProduct', '删除产品', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createProduct-cls', '添加产品分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateProduct-cls', '更新产品分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexProduct-cls', '产品分类列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewProduct-cls', '查看产品分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteProduct-cls', '删除产品分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createJob', '添加招聘', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateJob', '更新招聘', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexJob', '招聘列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewJob', '查看招聘', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteJob', '删除招聘', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createResume', '添加简历', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateResume', '更新简历', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexResume', '简历列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewResume', '查看简历', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteResume', '删除简历', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createPages', '添加自定义页面', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updatePages', '更新自定义页面', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexPages', '自定义页面列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewPages', '查看自定义页面', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deletePages', '删除自定义页面', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createPages-cls', '添加自定义页面分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updatePages-cls', '更改自定义页面分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexPages-cls', '自定义页面分类列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewPages-cls', '查看自定义页面分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deletePages-cls', '删除自定义页面分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createPages-list', '添加自定义页面内容', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updatePages-list', '更新自定义页面内容', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexPages-list', '自定义页面内容列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewPages-list', '查看自定义页面内容', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deletePages-list', '删除自定义页面内容', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createDownload', '添加下载内容', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateDownload', '更改下载内容', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexDownload', '下载内容列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewDownload', '查看下载内容', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteDownload', '删除下载内容', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createDownload-cls', '添加下载内容分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateDownload-cls', '更新下载内容分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexDownload-cls', '下载内容分类列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewDownload-cls', '查看下载内容分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteDownload-cls', '删除下载内容分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createPurchase', '添加采购', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updatePurchase', '更改采购', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexPurchase', '采购列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewPurchase', '查看采购', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deletePurchase', '删除采购', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createNav-cls', '添加导航分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateNav-cls', '更改导航分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexNav-cls', '导航分类列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewNav-cls', '查看导航分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteNav-cls', '删除导航分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createSupply', '添加供应', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateSupply', '更改供应', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexSupply', '供应列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewSupply', '查看供应', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteSupply', '删除供应', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createBid', '添加投标', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateBid', '更改投标', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexBid', '投标列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewBid', '查看投标', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteBid', '删除投标', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createSp-offer', '添加价格提交', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updateSp-offer', '更改价格', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexSp-offer', '价格列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewSp-offer', '查看价格', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deleteSp-offer', '删除价格', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),

(NULL, 'createPsb-cls', '添加相关分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'updatePsb-cls', '更改相关分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'indexPsb-cls', '相关分类列表', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'viewPsb-cls', '查看相关分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#'),
(NULL, 'deletePsb-cls', '删除相关分类', NULL, NULL, 2, 1, '#TIME#', '#TIME#');

