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

<style>
    /*设置表格文字左右和上下居中对齐*/
    #w0 td {vertical-align: middle;}
</style>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to(['rooms/create']) ?>' class='btn btn-primary btn-lg' title='添加酒店房间'>添加房间</a>
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
                    [
                        'attribute' => 'thumb',
                        'format'    => 'html',
                        'value'     => function ($model) {
                            $images = (!is_file( Yii::getAlias( '@webroot/../../frontend/web/temp/coupon/' ) . $model->thumb )) ?
                                Yii::getAlias( '@web/../../frontend/web/img/not.jpg' ) :
                                Yii::getAlias( '@web/../../frontend/web/temp/coupon/' ) . $model->thumb;

                            return '<img width="280" height="150" src="' . $images . '" alt="' . $model->title . '" />';
                        },
                        'options'   => [ 'width' => 180 ],
                    ],
                    [
                        'attribute' => 'hotel_id',
                        'value'     => function ($model) {
                            $data = \common\models\Hotels::findOne(['hotel_id' => $model->hotel_id]);
                            return $data->name;
                        },
                    ],
                    'title',
                    'user_id',
                    [
                        'attribute' => 'c_key',
                        'value'     => function ($model) {
                            $data = \common\models\RoomsClassify::findOne(['c_key' => $model->c_key]);
                            return $data->name;
                        },
                    ],
                    'room_num',
                    //'title',
                    'num',
                    'price',
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

