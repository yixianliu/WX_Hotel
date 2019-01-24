<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DisSaleConf */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '分销设置中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('返回列表', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'name',
            'commission_one',
            'commission_two',
            'commission_three',
            'commission_me',
            [
                'attribute' => 'is_commission_me',
                'value'     => function ($model) {
                    $state = [
                        'On'  => '已开启',
                        'Off' => '未启用',
                    ];

                    return $state[ $model->is_commission_me ];
                },
            ],
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
        'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
    ]) ?>

        </div>
    </div>
</div>


