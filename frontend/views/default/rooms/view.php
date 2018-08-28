<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Rooms */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除这条记录?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'hotel_id',
            'room_id',
            'user_id',
            'c_key',
            'room_num',
            'title',
            'num',
            'check_in_num',
            'price',
            'discount',
            'introduction',
            'keywords',
            'path',
            'thumb',
            'images',
            'is_promote',
            'is_using',
            'is_comments',
            'created_at',
            'updated_at',
            'content:html',
        ],
    ]);
    ?>

</div>
