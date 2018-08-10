<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = '菜单 : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '菜单中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?></h2></header>

        <div class="content-body">
            <div class="row">

                <p>
                    <?= Html::a('更新', ['update', 'id' => $model->m_key], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('删除', ['delete', 'id' => $model->m_key], [
                        'class' => 'btn btn-danger',
                        'data'  => [
                            'confirm' => '是否删除这条记录?',
                            'method'  => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('返回列表', ['index'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('继续添加', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <hr/>

                <?=
                DetailView::widget([
                    'model'      => $model,
                    'attributes' => [
                        'm_key',
                        'sort_id',
                        [
                            'attribute' => 'parent_id',
                            'value'     => function ($model) {

                                $data = \common\models\Menu::findOne(['m_key' => $model->parent_id]);

                                if (empty($data))
                                    return '一级菜单';

                                return $data->name;
                            },
                        ],
                        'url',
                        [
                            'attribute' => 'is_type',
                            'value'     => function ($model) {

                                if (empty($model->is_type))
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

                        'rp_key',
                        [
                            'attribute' => 'model_key',
                            'value'     => function ($model) {
                                $data = \common\models\MenuModel::findOne(['model_key' => $model->model_key]);

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
                ]);
                ?>

            </div>
        </div>
    </section>
</div>
