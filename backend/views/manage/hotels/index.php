<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '酒店管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    /*设置表格文字左右和上下居中对齐*/
    #w0 td {
        vertical-align: middle;
    }
</style>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加酒店'>添加酒店</a>
        <a href='<?= Url::to( ['rooms/create'] ) ?>' class='btn btn-primary btn-lg' title='添加房间'>添加房间</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= GridView::widget( [
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

                            $images = (!is_file( Yii::getAlias( '@webroot/../../frontend/web/temp/hotels/' ) . $model->thumb )) ?
                                Yii::getAlias( '@web/../../frontend/web/img/not.jpg' ) :
                                Yii::getAlias( '@web/../../frontend/web/temp/hotels/' ) . $model->thumb;

                            return '<img width="280" height="150" src="' . $images . '" alt="' . $model->name . '" />';
                        },
                        'options'   => ['width' => 180],
                    ],
                    'user_id',
                    'name',
                    [
                        'attribute' => 'address',
                        'value'     => function ($model) {
                            return $model->address;
                        },
                        'options'   => ['width' => 280],
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
