<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MiniProgramConf */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mini-program-conf-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'weixin_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'app_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mch_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api_psw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cert_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cert_psw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_using')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
