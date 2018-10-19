<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = '更新订单: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '订单中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render( '_form', [
    'model' => $model,
] ) ?>

