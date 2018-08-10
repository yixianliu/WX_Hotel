/**
 * 网站配置
 */
INSERT INTO `#DB_PREFIX#Conf`
VALUES
  (NULL, '#NAME#', '#TITLE#', '#EMAIL#', '#PHONE#', '#KEYWORDS#', '#SITE_URL#', '#DEVELOPERS#', '#ICP#', '#DESCRIPTION#', '#COPYRIGHT#', #TIME#, #TIME#);

/**
 * 网站辅助配置参数
 */
INSERT INTO `#DB_PREFIX#Assist`
VALUES
  (NULL, 'C1', 'FILE_UPLOAD_TYPE', 'zip,gz,rar,iso,doc,xsl,ppt,wps', '上传文件格式', 'On', #TIME#, #TIME#),
  (NULL, 'C2', 'IMAGE_UPLOAD_TYPE', 'jpg,gif,png', '上传图片格式', 'On', #TIME#, #TIME#),
  (NULL, 'C3', 'FILE_UPLOAD_SIZE', 500000, '上传文件大小', 'On', #TIME#, #TIME#),
  (NULL, 'C4', 'IMAGE_UPLOAD_SIZE', 500000, '上传图片大小', 'On', #TIME#, #TIME#),
  (NULL, 'C5', 'CODE_STATUS', 'On', '是否启用验证码', 'On', #TIME#, #TIME#),
  (NULL, 'C6', 'REG_STATUS', 'On', '是否启用注册', 'On', #TIME#, #TIME#),
  (NULL, 'C7', 'WEB_STATUS', 'On', '是否启用网站状态', 'On', #TIME#, #TIME#),
  (NULL, 'C8', 'LOGIN_STATUS', 'On', '是否启用登陆', 'On', #TIME#, #TIME#),
  (NULL, 'C9', 'VIEW_NUM', 15, '显示列表页码', 'On', #TIME#, #TIME#),
  (NULL, 'C10', 'COMMENT_NUM', 30, '评论列表页码', 'On', #TIME#, #TIME#);

/**
 * 友情链接
 */
INSERT INTO `#DB_PREFIX#Friend_link`
VALUES
(NULL, '#DEVELOPERS#', '#TITLE#', '#USERNAME#', NULL, '#SITE_URL#', 'On', 'On', #TIME#, #TIME#);

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 用户
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */

/**
 * 用户安全问题
 */
INSERT INTO `#DB_PREFIX#User_Problems`
VALUES
  (NULL, 'S1', '您配偶的生日是?', 'On', #TIME#, #TIME#),
  (NULL, 'S2', '您母亲的姓名是?', 'On', #TIME#, #TIME#),
  (NULL, 'S3', '您父亲的姓名是?', 'On', #TIME#, #TIME#),
  (NULL, 'S4', '您配偶父亲或者母亲的姓名是?', 'On', #TIME#, #TIME#),
  (NULL, 'S5', '您的出生地是?', 'On', #TIME#, #TIME#),
  (NULL, 'S6', '您高中班主任的名字是?', 'On', #TIME#, #TIME#),
  (NULL, 'S7', '您小学班主任的名字是?', 'On', #TIME#, #TIME#),
  (NULL, 'S8', '您大学班主任的名字是?', 'On', #TIME#, #TIME#),
  (NULL, 'S9', '您的小学校名是?', 'On', #TIME#, #TIME#),
  (NULL, 'S10', '您的学号（或工号）是?', 'On', #TIME#, #TIME#),
  (NULL, 'S11', '您父亲的生日是?', 'On', #TIME#, #TIME#),
  (NULL, 'S12', '您母亲的生日是?', 'On', #TIME#, #TIME#),
  (NULL, 'S13', '您配偶的生日是?', 'On', #TIME#, #TIME#);

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 菜单
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */
INSERT INTO `#DB_PREFIX#Menu_Model`
VALUES

  (NULL, 'UP1', 1, 'model', 'product', '产品中心', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UN1', 2, 'model', 'news', '新闻中心', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UJob1', 3, 'model', 'job', '招聘中心', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UPages1', 4, 'model', 'pages', '自定义页面', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UU1', 5, 'model', 'urls', '外部链接', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UP2', 6, 'model', 'purchase', '采购中心', 'On', '#TIME#', '#TIME#'),
  (NULL, 'US1', 7, 'model', 'supply', '供应中心', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UB1', 8, 'model', 'bid', '投标中心', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UM1', 9, 'model', 'maps', '地图页面', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UC2', 10, 'model', 'comment', '留言页面', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UDownload2', 11, 'model', 'download', '下载中心', 'On', '#TIME#', '#TIME#'),
  (NULL, 'USearch2', 12, 'model', 'search', '搜索中心', 'On', '#TIME#', '#TIME#'),
  (NULL, 'UEvaluating2', 13, 'model', 'evaluating', '评测中心', 'On', '#TIME#', '#TIME#'),

  (NULL, 'TIndex', 13, 'controller', 'index', '首页控制器', 'On', '#TIME#', '#TIME#'),
  (NULL, 'TList', 14, 'controller', 'list', '列表控制器', 'On', '#TIME#', '#TIME#'),
  (NULL, 'TView', 15, 'controller', 'view', '详情控制器', 'On', '#TIME#', '#TIME#'),
  (NULL, 'TShow', 16, 'controller', 'show', '展示控制器', 'On', '#TIME#', '#TIME#'),
  (NULL, 'TCenter', 17, 'controller', 'center', '中心控制器', 'On', '#TIME#', '#TIME#');


INSERT INTO `#DB_PREFIX#Menu`
VALUES

  /* 酒店 */
  (NULL, 'H1', 1, null, null, 'R15', NULL, 'M0', '酒店中心', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'HN1', 1, 'urls', 'center/index', 'R15', NULL, 'H1', '首页', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'HN2', 2, 'urls', null, 'R15', NULL, 'H1', '酒店中心', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'HSV1', 1, 'urls', 'hotel/index', 'R15', NULL, 'HN2', '房间分类', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'HSI2', 2, 'urls', 'hotel/index', 'R15', NULL, 'HN2', '海景房', NULL, 'On', 'On', #TIME#, #TIME#),

  /*
   用户中心 / User
  */
  (NULL, 'U1', 1, null, null, 'R15', NULL, 'M0', '焦点世界', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'UN2', 1, 'urls', 'center/index', 'R15', NULL, 'U1', '评测区', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UN3', 2, 'urls', 'center/index', 'R15', NULL, 'U1', '精选大伽', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UN4', 3, 'urls', 'center/index', 'R15', NULL, 'U1', '淘一淘', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UN5', 4, 'urls', 'center/index', 'R15', NULL, 'U1', '我的设置', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UN6', 5, 'urls', 'center/index', 'R15', NULL, 'U1', '你我他的故事', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'UE1', 1, 'urls', 'center/index', 'R15', NULL, 'UN2', '我的评测', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UE2', 2, 'urls', 'center/index', 'R15', NULL, 'UN2', '发布评测', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'UNN1', 1, 'urls', 'center/index', 'R15', NULL, 'UN6', '买卖经历', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UNN2', 2, 'urls', 'center/index', 'R15', NULL, 'UN6', '发布经历', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'UT1', 1, 'urls', 'center/index', 'R15', NULL, 'UN4', '淘抢购', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'UC1', 1, 'urls', 'center/index', 'R15', NULL, 'UN5', '个人设置', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UC2', 2, 'urls', 'center/index', 'R15', NULL, 'UN5', '头像设置', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'UP1', 1, 'urls', 'center/index', 'R15', NULL, 'UN3', '集聚人气产品', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UP2', 2, 'urls', 'center/index', 'R15', NULL, 'UN3', '人气产品榜', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UP3', 3, 'urls', 'center/index', 'R15', NULL, 'UN3', '大神作品', NULL, 'On', 'On', #TIME#, #TIME#),

  /*
   搜索中心 / Search
  */
  (NULL, 'S1', 1, null, null, 'R15', NULL, 'M0', '搜索中心', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'SN1', 1, 'urls', 'center/index', 'R15', NULL, 'S1', '搜索产品', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SN2', 2, 'urls', 'center/index', 'R15', NULL, 'S1', '搜索酒店房间', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SN3', 3, 'urls', 'center/index', 'R15', NULL, 'S1', '搜索商户', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SN4', 4, 'urls', 'center/index', 'R15', NULL, 'S1', '搜索分类', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'SNSProduct1', 1, 'urls', 'center/index', 'R15', NULL, 'SN1', '新品产品', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SNSProduct2', 2, 'urls', 'center/index', 'R15', NULL, 'SN1', '热门搜索', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SNSProduct3', 3, 'urls', 'center/index', 'R15', NULL, 'SN1', '新奇产品', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'SNSUser1', 1, 'urls', 'center/index', 'R15', NULL, 'SN2', '用户列表', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SNSUser2', 2, 'urls', 'center/index', 'R15', NULL, 'SN2', '热门用户', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SNSUser3', 3, 'urls', 'center/index', 'R15', NULL, 'SN2', '没被关注的用户', NULL, 'On', 'On', #TIME#, #TIME#),

  /*
   后台管理 / Admin
  */
  (NULL, 'A3', 1, null, null, 'R15', NULL, 'M0', '后台管理', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AC2', 1, 'urls', null, 'R15', NULL, 'A3', '管理中心', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AM1', 4, 'urls', null, 'R15', NULL, 'A3', '菜单管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AU1', 5, 'urls', null, 'R15', NULL, 'A3', '用户管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AR1', 7, 'urls', null, 'R15', NULL, 'A3', '角色管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AP1', 8, 'urls', null, 'R15', NULL, 'A3', '权限管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditA1', 9, 'urls', null, 'R15', NULL, 'A3', '产品管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditA5', 13, 'urls', null, 'R15', NULL, 'A3', '产品分类管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditA6', 14, 'urls', null, 'R15', NULL, 'A3', '认证角色管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditA7', 15, 'urls', null, 'R15', NULL, 'A3', '订单中心', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditA8', 16, 'urls', null, 'R15', NULL, 'A3', '卡卷管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditA9', 17, 'urls', null, 'R15', NULL, 'A3', '酒店管理', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthRoom1', 1, 'urls', '/hotel/index', 'R15', NULL, 'AuditA9', '房间列表', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom2', 2, 'urls', '/hotel/create', 'R15', NULL, 'AuditA9', '添加房间', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom3', 3, 'urls', '/hotel-cls/index', 'R15', NULL, 'AuditA9', '房间分类列表', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom4', 4, 'urls', '/hotel-cls/create', 'R15', NULL, 'AuditA9', '添加房间分类', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthCoupon1', 1, 'urls', '/coupon/index', 'R15', NULL, 'AuditA8', '卡卷列表', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthCoupon2', 2, 'urls', '/coupon/create', 'R15', NULL, 'AuditA8', '添加卡卷', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthOrder1', 1, 'urls', '/order/index', 'R15', NULL, 'AuditA7', '订单列表', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthOrder2', 2, 'urls', '/order/create', 'R15', NULL, 'AuditA7', '添加订单', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthRole1', 1, 'urls', '/auth-role/index', 'R15', NULL, 'AuditA6', '认证角色列表', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRole2', 2, 'urls', '/auth-role/create', 'R15', NULL, 'AuditA6', '添加认证角色', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AUUV1', 1, 'urls', '/user/index', 'R15', NULL, 'AU1', '所有用户', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AUUV2', 2, 'urls', '/comment/index', 'R15', NULL, 'AU1', '用户留言', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AUMV1', 1, 'urls', '/menu/index', 'R15', NULL, 'AM1', '所有菜单', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AUMV2', 2, 'urls', '/menu/create', 'R15', NULL, 'AM1', '创建菜单', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'ACCC1', 1, 'urls', '/center/conf', 'R15', NULL, 'AC2', '网站配置', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACCC2', 2, 'urls', '/center/view', 'R15', NULL, 'AC2', '配置单', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACCC3', 3, 'urls', '/center/index', 'R15', NULL, 'AC2', '管理中心', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACCC4', 4, 'urls', '/backup/index', 'R15', NULL, 'AC2', '备份数据', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACCC5', 5, 'urls', '/assist/index', 'R15', NULL, 'AC2', '辅助参数', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AURR1', 1, 'urls', '/role/index', 'R15', NULL, 'AR1', '所有角色', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AURR2', 2, 'urls', '/role/create', 'R15', NULL, 'AR1', '创建角色', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AUPP1', 1, 'urls', '/power/index', 'R15', NULL, 'AP1', '所有权限', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AUPP2', 2, 'urls', '/power/create', 'R15', NULL, 'AP1', '创建权限', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuditAAC1', 1, 'urls', '/product-cls/index', 'R15', NULL, 'AuditA5', '所有产品分类', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAC2', 1, 'urls', '/product-cls/create', 'R15', NULL, 'AuditA5', '添加产品分类', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuditAAP1', 1, 'urls', '/product/index', 'R15', NULL, 'AuditA1', '所有产品', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAP2', 2, 'urls', '/product/create', 'R15', NULL, 'AuditA1', '添加产品', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAP3', 3, 'urls', '/product-level/index', 'R15', NULL, 'AuditA1', '产品等级', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAP4', 4, 'urls', '/product-level/create', 'R15', NULL, 'AuditA1', '添加产品等级', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAP5', 5, 'urls', '/product-promote/index', 'R15', NULL, 'AuditA1', '推广产品', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAP6', 6, 'urls', '/product-comment/index', 'R15', NULL, 'AuditA1', '产品留言管理', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAP7', 7, 'urls', '/product-image/index', 'R15', NULL, 'AuditA1', '产品图片管理', NULL, 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuditAAM1', 1, 'urls', '/merchant/index', 'R15', NULL, 'AuditA3', '所有商户', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAM2', 5, 'urls', '/merchant/create', 'R15', NULL, 'AuditA3', '添加商户', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAM3', 2, 'urls', '/merchant-coupon/index', 'R15', NULL, 'AuditA3', '优惠卷', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAM4', 3, 'urls', '/merchant-level/index', 'R15', NULL, 'AuditA3', '商户等级', NULL, 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditAAM5', 4, 'urls', '/merchant-image/index', 'R15', NULL, 'AuditA3', '商户图片管理', NULL, 'On', 'On', #TIME#, #TIME#)
