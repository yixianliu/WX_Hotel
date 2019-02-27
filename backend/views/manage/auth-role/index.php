<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '认证角色列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加认证角色'>添加认证角色</a>
        <a href='<?= Url::to( ['index', 'id' => 1] ) ?>' class='btn btn-primary btn-lg' title='添加认证角色'>认证角色</a>
        <a href='<?= Url::to( ['index', 'id' => 2] ) ?>' class='btn btn-primary btn-lg' title='添加认证角色'>认证权限</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= GridView::widget( [
                'dataProvider' => $dataProvider,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'description',
                    'rule_name',
                    'data',
                    [
                        'attribute' => 'type',
                        'value'     => function ($model) {
                            return $model->type == 1 ? '认证角色' : '认证权限';
                        },
                    ],
                    [
                        'attribute' => 'status',
                        'value'     => function ($model) {
                            return $model->status == 1 ? '已启用' : '已关闭';
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
                    [
                        'class'   => 'yii\grid\ActionColumn',
                        'options' => ['width' => 100],
                    ],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ] ); ?>

        </div>
    </div>
</div>
