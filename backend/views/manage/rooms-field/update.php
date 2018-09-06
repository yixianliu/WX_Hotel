<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RoomsField */

$this->title = '更新房间参数: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '房间参数列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
