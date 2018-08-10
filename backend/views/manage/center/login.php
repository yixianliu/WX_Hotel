<?php
/**
 *
 * 登录模板
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/10/16
 * Time: 17:28
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use common\widgets\iConf\ConfList;

AppAsset::register($this); // $this 代表视图对象

$this->beginPage();

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <?= ConfList::widget(['config' => ['登录', 'head']]); ?>

    <?php $this->head() ?>

</head>
<body class=" login_page">

<?php $this->beginBody() ?>

<div class="login-wrapper">
    <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">

        <h1><a href="#" title="<?= Yii::$app->params['Conf']['NAME'] ?>" tabindex="-1"><?= Yii::$app->params['Conf']['NAME'] ?></a></h1>

        <?php $form = ActiveForm::begin(['action' => ['member/login'], 'method' => 'post', 'id' => $model->formName()]); ?>

        <p>
            <?= $form->field($model, 'username')->textInput(['class' => 'input', 'placeholder' => '帐号...'])->label('帐号'); ?>
        </p>

        <p>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'input', 'placeholder' => '密码...'])->label('密码'); ?>
        </p>

        <p class="submit">
            <?= Html::submitButton('登录', ['class' => 'btn btn-orange btn-block']) ?>
        </p>

        <?php ActiveForm::end() ?>

        <?= Yii::$app->view->renderFile('@app/views/formMsg.php'); ?>

    </div>
</div>

<?php $this->endBody(); ?>

</body>
</html>

<?php $this->endPage() ?>

