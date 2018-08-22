<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'introduction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'praise')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'forward')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'collection')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'share')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attention')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_promote')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_hot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_classic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_winnow')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_recommend')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_comments')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_using')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
