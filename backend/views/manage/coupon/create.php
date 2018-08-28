<?php

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */

$this->title = '添加优惠卷';
$this->params['breadcrumbs'][] = ['label' => 'Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', ['model' => $model,]) ?>
