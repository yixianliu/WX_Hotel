<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = '更新网站配置: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '网站配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>


<?= $this->render('_form', [
    'model' => $model,
    'type'  => $type,
]) ?>

