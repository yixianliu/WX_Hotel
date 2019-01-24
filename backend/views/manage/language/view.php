<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="language-view">

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
            'lang_key',
            'name',
            'content',
            [
                'attribute' => 'is_using',
                'value'     => function ($model) {
                    $state = [
                        'On'  => '已开启',
                        'Off' => '未启用',
                    ];

                    return $state[ $model->is_using ];
                },
            ],
            'is_default',
            [
                'attribute' => 'created_at',
                'value'     => function ($model) {
                    return date( 'Y - m -d , H:i:s', $model->created_at );
                },
                'options'   => ['width' => 180],
            ],
            [
                'attribute' => 'updated_at',
                'value'     => function ($model) {
                    return date( 'Y - m -d , H:i:s', $model->updated_at );
                },
                'options'   => ['width' => 180],
            ],
        ],
    ]) ?>

</div>
