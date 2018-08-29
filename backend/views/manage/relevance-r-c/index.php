<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '关联房间优惠卷';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevance-rooms-coupon-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加关联', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_id',
            'coupon_key',
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
