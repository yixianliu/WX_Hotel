<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AuthRole */

$this->title = '浏览产品 - ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '产品管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <br/>

            <p>
                <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => '是否删除这条记录?',
                        'method'  => 'post',
                    ],
                ]) ?>
                <?= Html::a('返回列表', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>

            <?=
            DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'title',
                    'introduction',
                    'price',
                    'discount',
                    'keywords',
                    'introduction',
                    'path',

                    'thumb',
                    'images',

                    [
                        'attribute' => 'grade',
                        'value'     => function ($model) {
                            return $model->grade . ' 分';
                        },
                    ],
                    [
                        'attribute' => 'user_grade',
                        'value'     => function ($model) {
                            return $model->user_grade . ' 分';
                        },
                    ],

                    'praise',
                    'forward',
                    'collection',
                    'share',
                    'attention',
                    [
                        'attribute' => 'is_recommend',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启推荐',
                                'Off' => '未启用推荐',
                            ];

                            return $state[ $model->is_classic ];
                        },
                    ],
                    [
                        'attribute' => 'is_winnow',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启精选',
                                'Off' => '未启用精选',
                            ];

                            return $state[ $model->is_classic ];
                        },
                    ],
                    [
                        'attribute' => 'is_classic',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启经典',
                                'Off' => '未启用经典',
                            ];

                            return $state[ $model->is_classic ];
                        },
                    ],
                    [
                        'attribute' => 'is_hot',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启热门',
                                'Off' => '未启用热门',
                            ];

                            return $state[ $model->is_hot ];
                        },
                    ],
                    [
                        'attribute' => 'is_promote',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启推广',
                                'Off' => '未启用推广',
                            ];

                            return $state[ $model->is_promote ];
                        },
                    ],
                    [
                        'attribute' => 'is_audit',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_audit ];
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
                'template' => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ])
            ?>

        </div>
    </div>
</div>
