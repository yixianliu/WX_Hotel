<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

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
                <?= Html::a( '返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '继续添加', ['create'], ['class' => 'btn btn-primary'] ) ?>
            </p>

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'user_id',
                    'username',
                    'password',
                    'r_key',
                    'credit',
                    'nickname',
                    'signature:ntext',
                    'address:ntext',
                    'tel_phone',
                    'birthday',
                    'answer',
                    'problems_key',
                    [
                        'attribute' => 'reg_time',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , H:i:s', $model->reg_time );
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'last_login_time',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , H:i:s', $model->last_login_time );
                        },
                        'options'   => ['width' => 180],
                    ],
                    'login_ip',
                    [
                        'attribute' => 'sex',
                        'value'     => function ($model) {
                            $state = [
                                'Male'   => '男人',
                                'Female' => '女人',
                            ];

                            return $state[ $model->sex ];
                        },
                    ],
                    [
                        'attribute' => 'is_display',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '已开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_display ];
                        },
                    ],
                    [
                        'attribute' => 'is_head',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '已开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_head ];
                        },
                    ],
                    [
                        'attribute' => 'is_security',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '已开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_security ];
                        },
                    ],
                    [
                        'attribute' => 'is_using',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '已开启',
                                'Off' => '未启用',
                                'Not' => '未审核',
                            ];

                            return $state[ $model->is_using ];
                        },
                    ],
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>

