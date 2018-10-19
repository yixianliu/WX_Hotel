<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '房间关联优惠卷', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevance-rooms-coupon-view">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
        <?= Html::a( '更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
        <?= Html::a( '删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => '是否删除这条记录?',
                'method'  => 'post',
            ],
        ] ) ?>
    </p>

    <?=
    DetailView::widget( [
        'model'      => $model,
        'attributes' => [
            'coupon_key',
            'room_id',
            'use_up',
            'created_at',
            'updated_at',
        ],
    ] )
    ?>

</div>
