/**
 * 网站配置
 */
INSERT INTO `#DB_PREFIX#Conf`
VALUES
  (NULL, 'CN', '#NAME#', '#TITLE#', '#EMAIL#', '#PHONE#', '#KEYWORDS#', '#SITE_URL#', '#DEVELOPERS#', '#ICP#', '#DESCRIPTION#', '#COPYRIGHT#', #TIME#, #TIME#),
  (NULL, 'EN_USA', '#NAME#_USA', '#TITLE#_USA', '#EMAIL#', '#PHONE#', '#KEYWORDS#', '#SITE_URL#', '#DEVELOPERS#_USA', '#ICP#', '#DESCRIPTION#', '#COPYRIGHT#', #TIME#, #TIME#);

/**
 * 网站辅助配置参数
 */
INSERT INTO `#DB_PREFIX#Language`
VALUES
  (NULL, 'CN', '中文', 'zh-CN', 'On', #TIME#, #TIME#),
  (NULL, 'CN_TW', '中文(台湾)', 'zh-TW', 'On', #TIME#, #TIME#),
  (NULL, 'EN', '英文', 'en-CA', 'On', #TIME#, #TIME#),
  (NULL, 'EN_USA', '英文(美式)', 'en-CA', 'On', #TIME#, #TIME#);

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

(NULL, 'UP1', 1, 'model', 'product', '产品中心', 'On', 'On', '#TIME#', '#TIME#'),
(NULL, 'UN1', 2, 'model', 'news', '新闻中心', 'On', 'On', '#TIME#', '#TIME#'),
(NULL, 'UJob1', 3, 'model', 'job', '招聘中心', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'UPages1', 4, 'model', 'pages', '自定义页面', 'On', 'On', '#TIME#', '#TIME#'),
(NULL, 'UU1', 5, 'model', 'urls', '外部链接', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'UM1', 9, 'model', 'maps', '地图页面', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'UC2', 10, 'model', 'comment', '留言页面', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'URooms2', 11, 'model', 'rooms', '房间页面', 'On', 'On', '#TIME#', '#TIME#'),
(NULL, 'USearch2', 12, 'model', 'search', '搜索中心', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'UHotel2', 13, 'model', 'hotel', '酒店页面', 'On', 'On', '#TIME#', '#TIME#'),

(NULL, 'TIndex', 13, 'controller', 'index', '首页控制器', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'TList', 14, 'controller', 'list', '列表控制器', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'TView', 15, 'controller', 'view', '详情控制器', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'TShow', 16, 'controller', 'show', '展示控制器', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'TCenter', 17, 'controller', 'center', '中心控制器', 'On', 'Off', '#TIME#', '#TIME#');

INSERT INTO `#DB_PREFIX#Menu`
VALUES

  /* 酒店 */
  (NULL, 'H1', 1, null, null, 'R15', NULL, 'M0', '酒店中心', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'HN1', 1, 'urls', 'center/index', 'R15', NULL, 'H1', '首页', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'HN2', 2, 'urls', null, 'R15', NULL, 'H1', '酒店中心', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'HSV1', 1, 'urls', 'hotel/index', 'R15', NULL, 'HN2', '房间分类', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'HSI2', 2, 'urls', 'hotel/index', 'R15', NULL, 'HN2', '海景房', 'On', 'On', #TIME#, #TIME#),

  /*
   用户中心 / User
  */
  (NULL, 'U1', 1, null, null, 'R15', NULL, 'M0', '用户中心', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'UN2', 1, 'urls', 'user/index', 'R15', NULL, 'U1', '我的档案', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UN3', 2, 'urls', 'center/index', 'R15', NULL, 'U1', '精选大伽', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UN4', 3, 'urls', 'center/index', 'R15', NULL, 'U1', '历史记录', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UN5', 4, 'urls', 'center/index', 'R15', NULL, 'U1', '我的订单', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'UN6', 5, 'urls', 'center/index', 'R15', NULL, 'U1', '我的设置', 'On', 'On', #TIME#, #TIME#),

  /*
   搜索中心 / Search
  */
  (NULL, 'S1', 1, null, null, 'R15', NULL, 'M0', '搜索中心', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'SN1', 1, 'urls', 'center/index', 'R15', NULL, 'S1', '搜索产品', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SN2', 2, 'urls', 'center/index', 'R15', NULL, 'S1', '搜索酒店房间', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SN3', 3, 'urls', 'center/index', 'R15', NULL, 'S1', '搜索商户', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SN4', 4, 'urls', 'center/index', 'R15', NULL, 'S1', '搜索分类', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'SNSProduct1', 1, 'urls', 'center/index', 'R15', NULL, 'SN1', '新品产品', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SNSProduct2', 2, 'urls', 'center/index', 'R15', NULL, 'SN1', '热门搜索', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SNSProduct3', 3, 'urls', 'center/index', 'R15', NULL, 'SN1', '新奇产品', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'SNSUser1', 1, 'urls', 'center/index', 'R15', NULL, 'SN2', '用户列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SNSUser2', 2, 'urls', 'center/index', 'R15', NULL, 'SN2', '热门用户', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'SNSUser3', 3, 'urls', 'center/index', 'R15', NULL, 'SN2', '没被关注的用户', 'On', 'On', #TIME#, #TIME#),

  /*
   后台管理 / Admin
  */
  (NULL, 'AdminManage', 1, null, null, 'R15', NULL, 'M0', '后台管理', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AC2', 1, 'urls', null, 'R15', NULL, 'AdminManage', '管理中心', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AHotel1', 2, 'urls', null, 'R15', NULL, 'AdminManage', '酒店管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ARooms1', 2, 'urls', null, 'R15', NULL, 'AdminManage', '房间管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACoupon1', 3, 'urls', null, 'R15', NULL, 'AdminManage', '卡卷管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AM1', 4, 'urls', null, 'R15', NULL, 'AdminManage', '菜单管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AU1', 5, 'urls', null, 'R15', NULL, 'AdminManage', '用户管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AArticle1', 5, 'urls', null, 'R15', NULL, 'AdminManage', '文章管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AR1', 7, 'urls', null, 'R15', NULL, 'AdminManage', '角色管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AP1', 8, 'urls', null, 'R15', NULL, 'AdminManage', '权限管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuditA6', 14, 'urls', null, 'R15', NULL, 'AdminManage', '认证角色管理', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AOrder7', 15, 'urls', null, 'R15', NULL, 'AdminManage', '订单中心', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AWeChat1', 16, 'urls', null, 'R15', NULL, 'AdminManage', '公众号设置', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AWeChatPay1', 17, 'urls', null, 'R15', NULL, 'AdminManage', '商户平台设置', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AWeChatProgram1', 18, 'urls', null, 'R15', NULL, 'AdminManage', '小程序设置', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthWeChatProgram1', 1, 'urls', '/we-chat-program/index', 'R15', NULL, 'AWeChat1', '小程序设置', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthWeChatProgram2', 2, 'urls', '/we-chat-program/view', 'R15', NULL, 'AWeChat1', '小程序名称', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthWeChat1', 1, 'urls', '/we-chat/index', 'R15', NULL, 'AWeChat1', '公众号设置', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthWeChat2', 2, 'urls', '/we-chat/menu', 'R15', NULL, 'AWeChat1', '公众号菜单', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthWeChatPay1', 1, 'urls', '/we-chat-pay/index', 'R15', NULL, 'AWeChat1', '商户平台设置', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthWeChatPay2', 2, 'urls', '/we-chat-pay/view', 'R15', NULL, 'AWeChat1', '商户平台测试', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AAArticle1', 1, 'urls', '/article/index', 'R15', NULL, 'AArticle1', '文章列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AAArticle2', 2, 'urls', '/article/create', 'R15', NULL, 'AArticle1', '添加文章', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AAArticle3', 3, 'urls', '/article-cls/index', 'R15', NULL, 'AArticle1', '文章分类列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AAArticle4', 4, 'urls', '/article-cls/create', 'R15', NULL, 'AArticle1', '添加文章分类', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthHotel1', 1, 'urls', '/hotels/index', 'R15', NULL, 'AHotel1', '酒店列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthHotel2', 2, 'urls', '/hotels/create', 'R15', NULL, 'AHotel1', '添加酒店', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthRoom1', 1, 'urls', '/rooms/index', 'R15', NULL, 'ARooms1', '房间列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom2', 2, 'urls', '/rooms/create', 'R15', NULL, 'ARooms1', '添加房间', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom3', 3, 'urls', '/rooms-cls/index', 'R15', NULL, 'ARooms1', '房间分类列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom4', 4, 'urls', '/rooms-cls/create', 'R15', NULL, 'ARooms1', '添加房间分类', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom5', 7, 'urls', '/rooms-field/index', 'R15', NULL, 'ARooms1', '房间参数', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom6', 8, 'urls', '/rooms-field/create', 'R15', NULL, 'ARooms1', '添加房间参数', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom7', 7, 'urls', '/rooms-tag/index', 'R15', NULL, 'ARooms1', '房间标签', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRoom8', 8, 'urls', '/rooms-tag/create', 'R15', NULL, 'ARooms1', '添加房间标签', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthCoupon1', 1, 'urls', '/coupon/index', 'R15', NULL, 'ACoupon1', '卡卷列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthCoupon2', 2, 'urls', '/coupon/create', 'R15', NULL, 'ACoupon1', '添加卡卷', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthCoupon3', 3, 'urls', '/relevance-rooms-coupon/index', 'R15', NULL, 'ACoupon1', '派送卡卷设置', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthCoupon4', 4, 'urls', '/relevance-rooms-coupon/create', 'R15', NULL, 'ACoupon1', '添加派送', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthOrder1', 1, 'urls', '/order/index', 'R15', NULL, 'AOrder7', '订单列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthOrder2', 2, 'urls', '/order/statistics', 'R15', NULL, 'AOrder7', '订单统计', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AuthRole1', 1, 'urls', '/auth-role/index', 'R15', NULL, 'AuditA6', '认证角色列表', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AuthRole2', 2, 'urls', '/auth-role/create', 'R15', NULL, 'AuditA6', '添加认证角色', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AUUserV1', 1, 'urls', '/user/index', 'R15', NULL, 'AU1', '所有用户', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AUUserV2', 2, 'urls', '/comment/index', 'R15', NULL, 'AU1', '用户留言', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AUMenuV1', 1, 'urls', '/menu/index', 'R15', NULL, 'AM1', '所有菜单', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AUMenuV2', 2, 'urls', '/menu/create', 'R15', NULL, 'AM1', '创建菜单', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'ACCCenter1', 1, 'urls', '/conf/index', 'R15', NULL, 'AC2', '网站配置', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACCCenter2', 2, 'urls', '/center/view', 'R15', NULL, 'AC2', '配置单', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACCCenter3', 3, 'urls', '/center/index', 'R15', NULL, 'AC2', '管理中心', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACCCenter4', 4, 'urls', '/backup/index', 'R15', NULL, 'AC2', '备份数据', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'ACCCenter5', 5, 'urls', '/assist/index', 'R15', NULL, 'AC2', '辅助参数', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AURR1', 1, 'urls', '/role/index', 'R15', NULL, 'AR1', '所有角色', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AURR2', 2, 'urls', '/role/create', 'R15', NULL, 'AR1', '创建角色', 'On', 'On', #TIME#, #TIME#),

  (NULL, 'AUPP1', 1, 'urls', '/power/index', 'R15', NULL, 'AP1', '所有权限', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'AUPP2', 2, 'urls', '/power/create', 'R15', NULL, 'AP1', '创建权限', 'On', 'On', #TIME#, #TIME#)
