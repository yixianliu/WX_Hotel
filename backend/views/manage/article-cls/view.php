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
                'confirm' => 'Are you sure you want to delete this item?',
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
                    'id',
                    'c_key',
                    'sort_id',
                    'name',
                    'description:ntext',
                    'keywords',
                    'json_data',
                    'parent_id',
                    'is_using',
                    'created_at',
                    'updated_at',
                ],
            ] ) ?>

        </div>
    </div>
</div>

