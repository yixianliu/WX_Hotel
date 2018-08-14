<?php

/**
 * @abstract 产品列表模板
 * @author   Yxl <zccem@163.com>
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = '所有产品';
?>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to(['product/create']) ?>' class='btn btn-primary btn-lg' title='添加产品'>添加产品</a>
        <a href='<?= Url::to(['product-cls/create']) ?>' class='btn btn-primary btn-lg' title='添加产品分类'>添加产品分类</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <br/>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns'      => [
                    [
                        'class'   => 'yii\grid\CheckboxColumn',
                        'name'    => 'id',
                        'options' => ['width' => 40],
                    ],
                    [
                        'class'   => 'yii\grid\SerialColumn',
                        'options' => ['width' => 70],
                    ],
                    'title',
                    [
                        'attribute' => 'l_key',
                        'value'     => function ($model) {
                            $data = \common\models\ProductLevel::findOne(['l_key' => $model->l_key]);
                            return $data->name;
                        },
                        'options'   => ['width' => 180],
                    ],
                    'thumb',
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
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date('Y - m -d , H:i:s', $model->updated_at);
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'class'   => 'yii\grid\ActionColumn',
                        'options' => ['width' => 100],
                    ],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ]);
            ?>

        </div>
    </div>
</div>
