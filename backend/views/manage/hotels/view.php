<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '酒店管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除这条记录?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'hotel_id',
            'user_id',
            'name',
            'content:html',
            'introduction',
            'keywords',
            'thumb',
            'images',
            [
                'attribute' => 'is_promote',
                'value'     => function ($model) {
                    $state = [
                        'On'  => '开启',
                        'Off' => '未启用',
                    ];

                    return $state[$model->is_promote];
                },
            ],
            [
                'attribute' => 'is_comments',
                'value'     => function ($model) {
                    $state = [
                        'On'  => '开启',
                        'Off' => '未启用',
                    ];

                    return $state[$model->is_comments];
                },
            ],
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
