<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '房间预约';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-appointment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rooms Appointment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'hotel_id',
            'rooms_id',
            'telphone',
            'name',
            'start_time',
            'end_time',
            'advance_charge',
            'is_using',
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
