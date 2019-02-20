<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hotel_id',
            'room_id',
            'user_id',
            'coupon_key',
            'price',
            'title',
            'content:ntext',
            'username',
            'checkin_men_num',
            'checkin_men_name',
            'checkin_men_idcard',
            'check_in',
            'check_out',
            'order_type',
            'pay_type',
            'express_type',
            'is_using',
            'place_order',
            'pay_order',
            'created_at',
            'updated_at',
            'order_id',
        ],
    ]) ?>

</div>
