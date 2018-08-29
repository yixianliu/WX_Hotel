<?php

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */

$this->title = '添加优惠卷';
$this->params['breadcrumbs'][] = ['label' => '优惠卷管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', ['model' => $model,]) ?>
