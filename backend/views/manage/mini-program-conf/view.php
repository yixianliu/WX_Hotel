<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->wx_id;
$this->params['breadcrumbs'][] = ['label' => '小程序设置管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <p>
                <?= Html::a( '更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => '是否删除这条记录?',
                        'method'  => 'post',
                    ],
                ] ) ?>
                <?= Html::a( '返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '继续添加', ['create'], ['class' => 'btn btn-primary'] ) ?>
            </p>

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'conf_id',
                    'wx_id',
                    'app_id',
                    'mch_id',
                    'api_psw',
                    'cert_path',
                    'cert_psw',
                    [
                        'attribute' => 'is_using',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_using ];
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , h:i', $model->created_at );
                        },
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , h:i', $model->updated_at );
                        },
                    ],
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>

