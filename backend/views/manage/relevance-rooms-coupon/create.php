<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */

$this->title = 'Create Relevance Rooms Coupon';
$this->params['breadcrumbs'][] = ['label' => 'Relevance Rooms Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevance-rooms-coupon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
