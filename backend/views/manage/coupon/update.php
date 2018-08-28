<?php

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */

$this->title = 'Update Coupon: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_form', ['model' => $model,]) ?>
