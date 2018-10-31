<?php

/**
 * @abstract 全局文件
 * @author   Yxl <zccem@163.com>
 */

use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\AppAsset;

AppAsset::register( $this );  // $this 代表视图对象

$session = Yii::$app->session;

$Conf = \common\models\Conf::findOne( 1 );

$this->beginPage();

?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>

        <meta charset="<?= Yii::$app->charset ?>">

        <title><?= Html::encode( $this->title ) ?> - <?= $Conf['title']; ?> - <?= $Conf['name']; ?></title>

        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'/>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>

        <meta name="generator" content="<?= $Conf['copyright']; ?>" data-variable="<?= $Conf['site_url']; ?>"/>

        <meta name='keywords' content="<?= $Conf['keywords']; ?>"/>
        <meta name='description' content="<?= $Conf['description']; ?>"/>
        <meta name='author' content="<?= $Conf['developers']; ?>"/>

        <link rel="shortcut icon" href="<?= Yii::getAlias( '@web' ) ?>/favicon.ico" type="image/x-icon"/>

        <?= Html::csrfMetaTags() ?>

        <?php $this->head() ?>

    </head>
    <body>

    <?php $this->beginBody() ?>

    <div class="page-container">

        <div class="page-sidebar page-sidebar-fixed">

            <?= \common\widgets\iMenu\MenuAdmin::widget( [ 'config' => [ 'A3' ] ] ); ?>

        </div>

        <div class="page-content">

            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">

                <li class="xn-icon-button pull-right">
                    <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
                </li>

            </ul>

            <ul class="breadcrumb">
                <li><a href="#"></a></li>
                <li class="active"><?= $this->title ?></li>
            </ul>

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
                        <a href="<?= Url::to( [ 'mount/member/logout' ] ) ?>" class="btn btn-success btn-lg">是</a>
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