<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '房间列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to(['rooms/create']) ?>' class='btn btn-primary btn-lg' title='添加酒店房间'>添加酒店房间</a>
        <a href='<?= Url::to(['create']) ?>' class='btn btn-primary btn-lg' title='添加房间分类'>添加房间分类</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
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
                    'hotel_id',
                    'room_id',
                    'user_id',
                    'c_key',
                    'room_num',
                    //'title',
                    'num',
                    'check_in_num',
                    'price',
                    //'discount',
                    //'introduction',
                    //'keywords',
                    //'path',
                    //'thumb',
                    //'images',
                    //'is_promote',
                    //'is_using',
                    //'is_comments',
                    [
                        'attribute' => 'created_at',
                        'value'     => function ($model) {
                            return date('Y - m -d , H:i:s', $model->created_at);
                        },
                        'options'   => ['width' => 180],
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

