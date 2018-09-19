<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单管理';
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
            'hotel_id',
            'room_id',
            'user_id',
            'price',
            'title',
            'username',
            'check_in',
            'check_out',
            //'pay_type',
            //'express_type',
            //'is_using',
            //'place_order',
            //'pay_order',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
