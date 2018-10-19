<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '房间关联优惠卷';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-lg-12">

    <div class="form-group">

        <?= Html::a( '房间关联优惠卷', ['create'], ['class' => 'btn btn-success'] ) ?>

    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?=
            GridView::widget( [
                'dataProvider' => $dataProvider,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'coupon_key',
                    'room_id',
                    'use_up',
                    'created_at',
                    'updated_at',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ] );
            ?>

        </div>
    </div>
</div>

