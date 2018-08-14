<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-view">

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
            'hotel_id',
            'user_id',
            'c_key',
            'title',
            'content:ntext',
            'num',
            'checkin_num',
            'price',
            'discount',
            'introduction',
            'keywords',
            'path',
            'thumb',
            'images',
            'is_promote',
            'is_audit',
            'is_field',
            'is_comments',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
