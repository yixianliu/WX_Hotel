<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchArticle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'article_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'c_key') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'introduction') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'path') ?>

    <?php // echo $form->field($model, 'praise') ?>

    <?php // echo $form->field($model, 'forward') ?>

    <?php // echo $form->field($model, 'collection') ?>

    <?php // echo $form->field($model, 'share') ?>

    <?php // echo $form->field($model, 'attention') ?>

    <?php // echo $form->field($model, 'is_promote') ?>

    <?php // echo $form->field($model, 'is_hot') ?>

    <?php // echo $form->field($model, 'is_classic') ?>

    <?php // echo $form->field($model, 'is_winnow') ?>

    <?php // echo $form->field($model, 'is_recommend') ?>

    <?php // echo $form->field($model, 'is_comments') ?>

    <?php // echo $form->field($model, 'is_using') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
