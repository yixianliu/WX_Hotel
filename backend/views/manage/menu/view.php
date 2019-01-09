<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = '菜单 : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '菜单中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <p>
        <?= Html::a( '更新', ['update', 'id' => $model->m_key], ['class' => 'btn btn-primary'] ) ?>
        <?= Html::a( '删除', ['delete', 'id' => $model->m_key], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => '是否删除这条记录?',
                'method'  => 'post',
            ],
        ] ) ?>
        <?= Html::a( '返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
        <?= Html::a( '继续添加', ['create'], ['class' => 'btn btn-success'] ) ?>
    </p>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?=
            DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'm_key',
                    'sort_id',
                    [
                        'attribute' => 'parent_id',
                        'value'     => function ($model) {

                            $data = \common\models\Menu::findOne( ['m_key' => $model->parent_id] );

                            if (empty( $data ))
                                return '一级菜单';

                            return $data->name;
                        },
                    ],
                    'url_data',
                    [
                        'attribute' => 'is_type',
                        'value'     => function ($model) {

                            if (empty( $model->is_type ))
                                return '没有设置';

                            $state = [
                                'list'   => '列表内容类型',
                                'view'   => '内容详情类型',
                                'show'   => '展示详情类型',
                                'index'  => '首页类型',
                                'center' => '中心类型',
                            ];

                            return $state[ $model->is_type ];
                        },
                    ],

                    'r_key',
                    [
                        'attribute' => 'model_key',
                        'value'     => function ($model) {
                            $data = \common\models\MenuModel::findOne( ['m_key' => $model->model_key] );
                            return $data->name;
                        },
                    ],
                    'name',
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
            ] );
            ?>

        </div>
    </div>
</div>
