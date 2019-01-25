<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenuModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单模型';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?></h2></header>

        <div class="content-body">
            <div class="row">

                <p>
                    <?= Html::a('添加菜单模型', ['create']) . ' / ' ?>
                    <?= Html::a('添加菜单', ['admin/menu/create']) . ' / ' ?>
                    <?= Html::a('创建单页面', ['admin/pages/create']) . ' / ' ?>
                    <?= Html::a('创建单页面分类', ['admin/pages-cls/create']) . ' / ' ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns'      => [
                        'url_key:url',
                        'sort_id',
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
                            'options'   => ['width' => 120]
                        ],
                        [
                            'attribute' => 'created_at',
                            'value'     => function ($model) {
                                return date('Y - m -d , H:i:s', $model->created_at);
                            },
                            'options'   => ['width' => 180]
                        ],
                        [
                            'attribute' => 'updated_at',
                            'value'     => function ($model) {
                                return date('Y - m -d , H:i:s', $model->updated_at);
                            },
                            'options'   => ['width' => 180]
                        ],

                        [
                                'class' => 'yii\grid\ActionColumn',
                                'options' => ['width' => 100]
                        ],
                    ],
                ]); ?>

            </div>
        </div>
    </section>
</div>

