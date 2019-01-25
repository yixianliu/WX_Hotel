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
  (NULL, 'CN', '中文', 'zh-CN', 'On', 'On', #TIME#, #TIME#),
  (NULL, 'CN_TW', '中文(台湾)', 'zh-TW', 'On', 'Off', #TIME#, #TIME#),
  (NULL, 'EN', '英文', 'en-CA', 'On', 'Off', #TIME#, #TIME#),
  (NULL, 'EN_USA', '英文(美式)', 'en-CA', 'On', 'Off', #TIME#, #TIME#);

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

(NULL, 'UP1', 1, 'model', 'product', '产品模型', 'On', 'On', '#TIME#', '#TIME#'),
(NULL, 'UN1', 2, 'model', 'news', '新闻模型', 'On', 'On', '#TIME#', '#TIME#'),
(NULL, 'UJob1', 3, 'model', 'job', '招聘模型', 'On', 'On', '#TIME#', '#TIME#'),
(NULL, 'UPages1', 4, 'model', 'pages', '自定义页面', 'On', 'On', '#TIME#', '#TIME#'),
(NULL, 'UU1', 5, 'model', 'urls', '外部链接', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'UM1', 9, 'model', 'maps', '地图页面', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'UC2', 10, 'model', 'comment', '留言页面', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'USearch2', 12, 'model', 'search', '搜索模型', 'On', 'Off', '#TIME#', '#TIME#'),
(NULL, 'UEvaluating2', 13, 'model', 'evaluating', '评测模型', 'On', 'On', '#TIME#', '#TIME#');


INSERT INTO `#DB_PREFIX#Menu`
VALUES

/* 酒店 */
(NULL, 'H1', 1, null, null, 'R15', NULL, 'M0', '酒店中心', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'HN1', 1, 'UU1', 'center/index', 'R15', NULL, 'H1', '首页', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'HN2', 2, 'UU1', null, 'R15', NULL, 'H1', '酒店中心', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'HN3', 3, 'UU1', null, 'R15', NULL, 'H1', '超值酒店', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'HN4', 4, 'UU1', null, 'R15', NULL, 'H1', '超值酒店', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'HSV1', 1, 'UU1', 'hotel/index', 'R15', NULL, 'HN2', '房间分类', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'HSI2', 2, 'UU1', 'hotel/index', 'R15', NULL, 'HN2', '海景房', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

/*
 用户中心 / User
*/
(NULL, 'U1', 1, null, null, 'R15', NULL, 'M0', '焦点世界', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'UN2', 1, 'UU1', 'center/index', 'R15', NULL, 'U1', '评测房间', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UN3', 2, 'UU1', 'center/index', 'R15', NULL, 'U1', '精选房间', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UN4', 3, 'UU1', 'center/index', 'R15', NULL, 'U1', '淘一淘', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UN5', 4, 'UU1', 'center/index', 'R15', NULL, 'U1', '我的设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UN6', 5, 'UU1', 'center/index', 'R15', NULL, 'U1', '酒店的故事', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'UE1', 1, 'UU1', 'center/index', 'R15', NULL, 'UN2', '我的评测', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UE2', 2, 'UU1', 'center/index', 'R15', NULL, 'UN2', '发布评测', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'UNN1', 1, 'UU1', 'center/index', 'R15', NULL, 'UN6', '酒店经历', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UNN2', 2, 'UU1', 'center/index', 'R15', NULL, 'UN6', '发布经历', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'UT1', 1, 'UU1', 'center/index', 'R15', NULL, 'UN4', '淘抢购', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'UC1', 1, 'UU1', 'center/index', 'R15', NULL, 'UN5', '个人设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UC2', 2, 'UU1', 'center/index', 'R15', NULL, 'UN5', '头像设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'UP1', 1, 'UU1', 'center/index', 'R15', NULL, 'UN3', '人气房间', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UP2', 2, 'UU1', 'center/index', 'R15', NULL, 'UN3', '人气酒店榜', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'UP3', 3, 'UU1', 'center/index', 'R15', NULL, 'UN3', '神级酒店', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

/*
 搜索中心 / Search
*/
(NULL, 'S1', 1, null, null, 'R15', NULL, 'M0', '搜索中心', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'SN1', 1, 'UU1', 'center/index', 'R15', NULL, 'S1', '搜索产品', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SN2', 2, 'UU1', 'center/index', 'R15', NULL, 'S1', '搜索酒店房间', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SN3', 3, 'UU1', 'center/index', 'R15', NULL, 'S1', '搜索商户', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SN4', 4, 'UU1', 'center/index', 'R15', NULL, 'S1', '搜索分类', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'SNSProduct1', 1, 'UU1', 'center/index', 'R15', NULL, 'SN1', '新品产品', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SNSProduct2', 2, 'UU1', 'center/index', 'R15', NULL, 'SN1', '热门搜索', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SNSProduct3', 3, 'UU1', 'center/index', 'R15', NULL, 'SN1', '新奇产品', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'SNSUser1', 1, 'UU1', 'center/index', 'R15', NULL, 'SN2', '用户列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SNSUser2', 2, 'UU1', 'center/index', 'R15', NULL, 'SN2', '热门用户', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SNSUser3', 3, 'UU1', 'center/index', 'R15', NULL, 'SN2', '没被关注的用户', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

/*
 超管管理 / Admin
*/
(NULL, 'SupperAdmin', 1, null, null, 'R15', NULL, 'M0', '终极管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'SCenter2', 1, 'UU1', null, 'R15', NULL, 'SupperAdmin', '管理中心', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SPower1', 2, 'UU1', null, 'R15', NULL, 'SupperAdmin', '权限管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SMenuModel1', 3, 'UU1', null, 'R15', NULL, 'SupperAdmin', '菜单模型管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ALanguage1', 5, 'UU1', null, 'R15', NULL, 'SupperAdmin', '语言管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AUMenuModel1', 1, 'UU1', '/menu-model/index', 'R15', NULL, 'SMenuModel1', '所有菜单模型', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AUMenuModel2', 2, 'UU1', '/menu-model/create', 'R15', NULL, 'SMenuModel1', '创建菜单模型', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'SCCCenter4', 4, 'UU1', '/backup/index', 'R15', NULL, 'SCenter2', '备份数据', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'SCCCenter5', 5, 'UU1', '/assist/index', 'R15', NULL, 'SCenter2', '辅助参数', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AUPP1', 1, 'UU1', '/power/index', 'R15', NULL, 'SPower1', '所有权限', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AUPP2', 2, 'UU1', '/power/create', 'R15', NULL, 'SPower1', '创建权限', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'ALLanguage1', 1, 'UU1', '/language/index', 'R15', NULL, 'ALanguage1', '语言类别', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ALLanguage2', 2, 'UU1', '/language/create', 'R15', NULL, 'ALanguage1', '添加语言类别', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

/*
 后台管理 / Admin
*/
(NULL, 'AdminManage', 1, null, null, 'R15', NULL, 'M0', '后台管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AC2', 1, 'UU1', null, 'R15', NULL, 'AdminManage', '管理中心', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AHotel1', 2, 'UU1', null, 'R15', NULL, 'AdminManage', '酒店管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ARooms1', 2, 'UU1', null, 'R15', NULL, 'AdminManage', '房间管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ACoupon1', 3, 'UU1', null, 'R15', NULL, 'AdminManage', '卡卷管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AM1', 4, 'UU1', null, 'R15', NULL, 'AdminManage', '菜单管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AU1', 5, 'UU1', null, 'R15', NULL, 'AdminManage', '用户管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AArticle1', 5, 'UU1', null, 'R15', NULL, 'AdminManage', '文章管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AJob1', 6, 'UU1', null, 'R15', NULL, 'AdminManage', '招聘管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ARole1', 7, 'UU1', null, 'R15', NULL, 'AdminManage', '角色管理', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ADis8', 8, 'UU1', null, 'R15', NULL, 'AdminManage', '分销机制', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AOrder7', 15, 'UU1', null, 'R15', NULL, 'AdminManage', '订单中心', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AWeChat1', 16, 'UU1', null, 'R15', NULL, 'AdminManage', '公众号设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AWeChatPay1', 17, 'UU1', null, 'R15', NULL, 'AdminManage', '商户平台设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AMiniProgram11', 18, 'UU1', null, 'R15', NULL, 'AdminManage', '小程序设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AJJob1', 1, 'UU1', '/job/index', 'R15', NULL, 'AJob1', '招聘列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AJJob2', 2, 'UU1', '/job/create', 'R15', NULL, 'AJob1', '添加招聘信息', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AJResume1', 3, 'UU1', '/resume/index', 'R15', NULL, 'AJob1', '简历列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AJResume2', 4, 'UU1', '/resume/create', 'R15', NULL, 'AJob1', '添加人才信息', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'ADDis1', 1, 'UU1', '/dis-sale-user/index', 'R15', NULL, 'ADis8', '用户列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ADDis2', 2, 'UU1', '/dis-sale-conf/index', 'R15', NULL, 'ADis8', '分销设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AMMiniProgram1', 1, 'UU1', '/mini-program-conf/index', 'R15', NULL, 'AMiniProgram11', '小程序设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AuthWeChat1', 1, 'UU1', '/we-chat/index', 'R15', NULL, 'AWeChat1', '公众号设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthWeChat2', 2, 'UU1', '/we-chat/menu', 'R15', NULL, 'AWeChat1', '公众号菜单', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AuthWeChatPay1', 1, 'UU1', '/we-chat-pay/index', 'R15', NULL, 'AWeChatPay1', '商户平台设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthWeChatPay2', 2, 'UU1', '/we-chat-pay/view', 'R15', NULL, 'AWeChatPay1', '商户平台测试', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AAArticle1', 1, 'UU1', '/article/index', 'R15', NULL, 'AArticle1', '文章列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AAArticle2', 2, 'UU1', '/article/create', 'R15', NULL, 'AArticle1', '添加文章', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AAArticle3', 3, 'UU1', '/article-cls/index', 'R15', NULL, 'AArticle1', '文章分类列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AAArticle4', 4, 'UU1', '/article-cls/create', 'R15', NULL, 'AArticle1', '添加文章分类', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AuthHotel1', 1, 'UU1', '/hotels/index', 'R15', NULL, 'AHotel1', '酒店列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthHotel2', 2, 'UU1', '/hotels/create', 'R15', NULL, 'AHotel1', '添加酒店', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AuthRoom1', 1, 'UU1', '/rooms/index', 'R15', NULL, 'ARooms1', '房间列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom2', 2, 'UU1', '/rooms/create', 'R15', NULL, 'ARooms1', '添加房间', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom3', 3, 'UU1', '/rooms-cls/index', 'R15', NULL, 'ARooms1', '房间分类列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom4', 4, 'UU1', '/rooms-cls/create', 'R15', NULL, 'ARooms1', '添加房间分类', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom5', 7, 'UU1', '/rooms-field/index', 'R15', NULL, 'ARooms1', '房间参数', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom6', 8, 'UU1', '/rooms-field/create', 'R15', NULL, 'ARooms1', '添加房间参数', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom7', 7, 'UU1', '/rooms-tag/index', 'R15', NULL, 'ARooms1', '房间标签', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom8', 8, 'UU1', '/rooms-tag/create', 'R15', NULL, 'ARooms1', '添加房间标签', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom9', 9, 'UU1', '/rooms-appointment/index', 'R15', NULL, 'ARooms1', '房间预约列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRoom10', 10, 'UU1', '/rooms-appointment/create', 'R15', NULL, 'ARooms1', '添加房间预约', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AuthCoupon1', 1, 'UU1', '/coupon/index', 'R15', NULL, 'ACoupon1', '卡卷列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthCoupon2', 2, 'UU1', '/coupon/create', 'R15', NULL, 'ACoupon1', '添加卡卷', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthCoupon3', 3, 'UU1', '/relevance-rooms-coupon/index', 'R15', NULL, 'ACoupon1', '派送卡卷设置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthCoupon4', 4, 'UU1', '/relevance-rooms-coupon/create', 'R15', NULL, 'ACoupon1', '添加派送', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AuthOrder1', 1, 'UU1', '/order/index', 'R15', NULL, 'AOrder7', '订单列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthOrder2', 2, 'UU1', '/order/statistics', 'R15', NULL, 'AOrder7', '订单统计', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AUUserV1', 1, 'UU1', '/user/index', 'R15', NULL, 'AU1', '所有用户', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AUUserV2', 2, 'UU1', '/comment/index', 'R15', NULL, 'AU1', '用户留言', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AUMenuV1', 1, 'UU1', '/menu/index', 'R15', NULL, 'AM1', '所有菜单', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AUMenuV2', 2, 'UU1', '/menu/create', 'R15', NULL, 'AM1', '创建菜单', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'ACCCenter1', 1, 'UU1', '/conf/index', 'R15', NULL, 'AC2', '网站配置', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ACCCenter2', 2, 'UU1', '/center/view', 'R15', NULL, 'AC2', '配置单', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ACCCenter3', 3, 'UU1', '/center/index', 'R15', NULL, 'AC2', '管理中心', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'ACCCenter4', 4, 'UU1', '/backup/index', 'R15', NULL, 'AC2', '备份数据', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),

(NULL, 'AURRole1', 1, 'UU1', '/role/index', 'R15', NULL, 'ARole1', '所有角色', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AURRole2', 2, 'UU1', '/role/create', 'R15', NULL, 'ARole1', '创建角色', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRole1', 3, 'UU1', '/auth-role/index', 'R15', NULL, 'ARole1', '认证角色列表', NULL, 'CN', 'On', 'On', #TIME#, #TIME#),
(NULL, 'AuthRole2', 4, 'UU1', '/auth-role/create', 'R15', NULL, 'ARole1', '添加认证角色', NULL, 'CN', 'On', 'On', #TIME#, #TIME#)
