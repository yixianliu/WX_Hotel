<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RoomsTag */

$this->title = '更新房间标签: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '房间标签管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

