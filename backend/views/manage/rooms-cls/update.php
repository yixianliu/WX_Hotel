<?php

/* @var $this yii\web\View */
/* @var $model common\models\RoomsClassify */

$this->title = '更新酒店房间分类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '酒店房间分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_form', ['model' => $model, 'result' => $reuslt]) ?>
