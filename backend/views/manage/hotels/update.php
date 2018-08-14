<?php

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */

$this->title = '更新酒店房间: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '酒店房间管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_form', ['model' => $model,]) ?>

