<?php

/**
 * @abstract 登录模板
 * @author   Yxl <zccem@163.com>
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

AppAsset::register( $this );  // $this 代表视图对象

$this->beginPage();

?>

<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>

    <?= Html::csrfMetaTags() ?>

    <title>登录 - <?= Yii::$app->params['WebInfo']['TITLE']; ?> - <?= Yii::$app->params['WebInfo']['NAME']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name='keywords' content='<?= Yii::$app->params['WebInfo']['KEYWORDS']; ?>'/>
    <meta name='description' content='<?= Yii::$app->params['WebInfo']['DESCRIPTION']; ?>'/>
    <meta name='author' content='<?= Yii::$app->params['WebInfo']['DEVELOPERS']; ?>'/>

    <link rel='shortcut icon' type='image/x-icon' href='./favicon.ico'/>

    <?php $this->head() ?>

</head>
<body>

<?php $this->beginBody() ?>

<div class="login-container">

    <div class="login-box animated fadeInDown">

        <div class="login-body">

            <?php $form = ActiveForm::begin( [ 'action' => [ 'mount/member/in' ], 'class' => "form-horizontal", 'method' => 'post', 'id' => $model->formName() ] ); ?>

            <?= $form->field( $model, 'username' )->label( '帐号' )->textInput( [ 'maxlength' => true, 'class' => 'form-control', 'autofocus' => true ] ); ?>

            <?= $form->field( $model, 'password' )->label( '密码' )->passwordInput( [ 'maxlength' => true, 'class' => 'form-control' ] ); ?>

            <div class="form-group">
                <?= Html::submitButton( '立即登录', [ 'class' => 'btn btn-orange btn-block btn-lg' ] ); ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

        <?= \common\widgets\iMessage\FormMsg::widget( [ 'config' => [ 'tpl' => 'MountForm', 'FormName' => $model->formName()] ] ); ?>

        <div class="login-footer">
            <div class="pull-left">
                &copy; 2004 - 2017 <?= Yii::$app->params['WebInfo']['NAME']; ?>
            </div>
        </div>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

