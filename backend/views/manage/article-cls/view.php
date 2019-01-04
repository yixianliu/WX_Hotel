<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleCls */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '文章分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register( $this );
?>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <p>
        <?= Html::a( '更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
        <?= Html::a( '删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => '是否删除这条记录?',
                'method'  => 'post',
            ],
        ] ) ?>

        <?= Html::a( ' 继续添加', ['create'], ['class' => 'btn btn-primary'] ) ?>
        <?= Html::a( ' 返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
    </p>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'c_key',
                    'sort_id',
                    'name',
                    'description:ntext',
                    'keywords',
                    [
                        'attribute' => 'parent_id',
                        'value'     => function ($model) {

                            if ($model->parent_id == \common\models\ArticleCls::$parentId)
                                return '父类级别';

                            $data = \common\models\ArticleCls::findOne(['c_key' => $model->parent_id]);

                            return $data->name;
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
                            return date('Y - m - d , h:i', $model->created_at);
                        },
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date('Y - m - d , h:i', $model->updated_at);
                        },
                    ],
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>

