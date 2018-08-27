<?php

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */

$this->title = '更新酒店: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '酒店管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_form', ['model' => $model,]) ?>

