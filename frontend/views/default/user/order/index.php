<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hotel_id',
            'room_id',
            'user_id',
            'coupon_key',
            //'price',
            //'title',
            //'content:ntext',
            //'username',
            //'checkin_men_num',
            //'checkin_men_name',
            //'checkin_men_idcard',
            //'check_in',
            //'check_out',
            //'order_type',
            //'pay_type',
            //'express_type',
            //'is_using',
            //'place_order',
            //'pay_order',
            //'created_at',
            //'updated_at',
            //'order_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
