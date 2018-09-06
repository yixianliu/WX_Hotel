<?php

/**
 * @abstract 安装全局文件
 * @author Yxl <zccem@163.com>
 */

use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\AppAsset;

// 跳转安装
if (file_exists(Yii::getAlias('@common') . '/' . Yii::$app->params['WebInfo']['RD_FILE'])) {
    return;
}

AppAsset::register($this);  // $this 代表视图对象

$session = Yii::$app->session;

// 判断是否登录
if (empty($session['MountAdmin']['username'])) {
    return false;
}

$this->beginPage();

?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>

        <meta charset="<?= Yii::$app->charset ?>">

        <title><?= Html::encode($this->title) ?> - <?= Yii::$app->params['WebInfo']['TITLE']; ?> - <?= Yii::$app->params['WebInfo']['NAME']; ?></title>

        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'/>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
        <meta name='keywords' content="<?= Yii::$app->params['WebInfo']['KEYWORDS']; ?>"/>
        <meta name='description' content="<?= Yii::$app->params['WebInfo']['DESCRIPTION']; ?>"/>
        <meta name='author' content="<?= Yii::$app->params['WebInfo']['DEVELOPERS']; ?>"/>

        <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/favicon.ico" type="image/x-icon"/>

        <?= Html::csrfMetaTags() ?>

        <?php $this->head() ?>

    </head>
    <body>

    <?php $this->beginBody() ?>

    <!-- START PAGE CONTAINER -->
    <div class="page-container page-navigation-top-fixed">

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar page-sidebar-fixed scroll">

            <ul class="x-navigation">

                <li class="xn-logo">
                    <a href="#" title="<?= Yii::$app->params['WebInfo']['TITLE']; ?> - <?= Yii::$app->params['WebInfo']['NAME']; ?>"></a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li><a href="<?= Url::to(['mount/center/view']); ?>" title="了解挂载操作"><span class="xn-text">控制面板</span></a></li>
                <li><a href="<?= Url::to(['mount/run/index']); ?>"><span class="xn-text">挂载操作</span></a></li>
                <li><a href="<?= Url::to(['mount/run/verify']); ?>"><span class="xn-text">验证文件</span></a></li>
                <li><a href="<?= Url::to(['mount/run/dbfile']); ?>"><span class="xn-text">数据文件</span></a></li>

            </ul>

        </div>

        <div class="page-content">

            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
			
                <li class="xn-icon-button pull-right">
                    <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
                </li>

            </ul>

            <ul class="breadcrumb">
                <li><a href="#">挂载中心</a></li>
                <li class="active"><?= $this->title ?></li>
            </ul>

            <div class="page-title">
                <h2><span class="fa fa-arrow-circle-o-left"></span> <?= Html::encode($this->title) ?></h2>
            </div>

            <div class="page-content-wrap">
                <?= $content; ?>
            </div>

        </div>
    </div>

    <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
        <div class="mb-container">
            <div class="mb-middle">

                <div class="mb-title"><span class="fa fa-sign-out"></span> 注销 <strong>当前用户</strong> ?</div>

                <div class="mb-content">
                    <p>您确定要退出？</p>
                    <p>如果要继续工作，请按 "否"。 按 "是" 注销当前用户。</p>
                </div>

                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="<?= Url::to(['mount/member/logout']) ?>" class="btn btn-success btn-lg">是</a>
                        <button class="btn btn-default btn-lg mb-control-close">否</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php $this->endBody(); ?>

    </body>
    </html>

<?php $this->endPage() ?>