<?php

/**
 * @abstract 登录模板
 * @author Yxl <zccem@163.com>
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\widgets\iMessage\FormMsg;
use backend\assets\AppAsset;

AppAsset::register($this);  // $this 代表视图对象

$this->beginPage();

?>

<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>

    <?= Html::csrfMetaTags() ?>

    <title> 登 录 - <?= Yii::$app->params['WebInfo']['TITLE']; ?> - <?= Yii::$app->params['WebInfo']['NAME']; ?></title>
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

            <?php $form = ActiveForm::begin(['action' => ['mount/member/in'], 'class' => "form-horizontal", 'method' => 'post', 'id' => $model->formName()]); ?>

            <div class="form-group">
                <div class="col-md-12">
                    <?= $form->field($model, 'username')->label('帐号')->textInput(['maxlength' => 30, 'placeholder' => '帐号...', 'class' => 'form-control', 'autofocus' => true]); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <?= $form->field($model, 'password')->label('密码')->passwordInput(['maxlength' => 30, 'placeholder' => '密码...', 'class' => 'form-control']); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div style="width: 100%;height: 15px;"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <a href="#" class="btn btn-link btn-block">忘记密码 ?</a>
                </div>
                <div class="col-md-7">
                    <?= Html::submitButton('立即登录', ['class' => 'btn btn-orange btn-block btn-lg']); ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <div class="form-group">
                <div class="col-md-12">
                    <div style="width: 100%;height: 30px;"></div>
                </div>
            </div>

            <?=
            FormMsg::widget(['config' => [
                'tpl'      => 'mountform',
                'FormName' => $model->formName(),
                'Url'      => Url::to(['mount/center/view']),
            ]]);
            ?>

        </div>

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

