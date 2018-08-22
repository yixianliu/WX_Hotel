<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'hotel_id',
            'room_id',
            'user_id',
            'c_key',
            //'price',
            //'title',
            //'content:ntext',
            //'keywords',
            //'username',
            //'path',
            //'num',
            //'check_in',
            //'check_out',
            //'pay_type',
            //'is_using',
            //'place_order',
            //'pay_order',
            [
                'attribute' => 'created_at',
                'value'     => function ($model) {
                    return date('Y - m -d , H:i:s', $model->created_at);
                },
                'options'   => ['width' => 180],
            ],
            [
                'attribute' => 'updated_at',
                'value'     => function ($model) {
                    return date('Y - m -d , H:i:s', $model->updated_at);
                },
                'options'   => ['width' => 180],
            ],
            [
                'class'   => 'yii\grid\ActionColumn',
                'options' => ['width' => 100],
            ],
        ],
        'tableOptions' => ['class' => 'table table-hover'],
        'pager'        => [
            'options' => ['class' => 'pagination'],
        ],
    ]); ?>

        </div>
    </div>
</div>
