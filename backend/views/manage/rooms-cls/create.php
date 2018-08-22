<?php

/* @var $this yii\web\View */
/* @var $model common\models\RoomsClassify */

$this->title = '添加酒店房间分类';
$this->params['breadcrumbs'][] = ['label' => '酒店房间分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

