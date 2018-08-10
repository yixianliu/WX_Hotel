<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MenuModel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '菜单模型', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?></h2></header>

        <div class="content-body">
            <div class="row">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('删除', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data'  => [
                            'confirm' => '是否删除这条记录?',
                            'method'  => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('返回列表', ['index'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('继续添加', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?= DetailView::widget([
                    'model'      => $model,
                    'attributes' => [
                        'id',
                        'model_key',
                        'sort_id',
                        'url_key:url',
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
                    'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
                ]) ?>

            </div>
        </div>
    </section>
</div>

