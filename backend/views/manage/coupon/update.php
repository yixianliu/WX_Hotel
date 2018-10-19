<?php

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */

$this->title = '更新优惠卷: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '优惠卷管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_form', ['model' => $model,]) ?>
