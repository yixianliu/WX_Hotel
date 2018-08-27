<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Rooms */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '房间列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'c_key',
            'room_num',
            'title',
            'content:ntext',
            'num',
            'check_in_num',
            'price',
            'discount',
            'introduction',
            'keywords',
            'path',
            'thumb',
            'images',
            'is_promote',
            'is_comments',
            [
                'attribute' => 'is_using',
                'value'     => function ($model) {
                    $state = [
                        'On'  => '开启',
                        'Off' => '未启用',
                    ];

                    return $state[$model->is_using];
                },
            ],
            [
                'attribute' => 'created_at',
                'value'     => function ($model) {
                    return date('Y - m -d , h:i', $model->created_at);
                },
            ],
            [
                'attribute' => 'updated_at',
                'value'     => function ($model) {
                    return date('Y - m -d , h:i', $model->updated_at);
                },
            ],
        ],
    ]) ?>

</div>
