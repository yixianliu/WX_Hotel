<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ConfSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conf-search">

    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get',]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'c_key') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'parameter') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'is_using') ?>

    <?php // echo $form->field($model, 'is_language') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
