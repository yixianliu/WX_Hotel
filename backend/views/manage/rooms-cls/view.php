<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RoomsClassify */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rooms Classifies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-classify-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
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
    ]) ?>

</div>
