<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Resume */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '简历管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="resume-view">

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
        <?= Html::a( '继续添加', ['create'], ['class' => 'btn btn-success'] ) ?>
    </p>

    <?= DetailView::widget( [
        'model'      => $model,
        'attributes' => [
            'id',
            'user_id',
            'title',
            'content:ntext',
            'path',
            'is_using',
            'created_at',
            'updated_at',
        ],
    ] ) ?>

</div>
