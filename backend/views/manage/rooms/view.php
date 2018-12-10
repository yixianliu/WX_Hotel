<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Rooms */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '房间列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

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
                <?= Html::a( '继续添加', ['create'], ['class' => 'btn btn-primary'] ) ?>
            </p>

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    [
                        'attribute' => 'hotel_id',
                        'value'     => function ($model) {
                            $data = \common\models\Hotels::findOne(['hotel_id' => $model->hotel_id]);
                            return $data->name;
                        },
                    ],
                    'room_id',
                    'user_id',
                    [
                        'attribute' => 'c_key',
                        'value'     => function ($model) {
                            $data = \common\models\RoomsClassify::findOne(['c_key' => $model->c_key]);
                            return $data->name;
                        },
                    ],
                    'room_num',
                    'title',
                    'num',
                    'check_in_num',
                    'price',
                    'discount',
                    'introduction',
                    'keywords',
                    [
                        'attribute' => 'thumb',
                        'format'    => 'html',
                        'value'     => function ($model) {

                            $filenameReal = Yii::getAlias( '@webroot/../../frontend/web/temp/rooms/' ) . $model->thumb;

                            if (!file_exists( $filenameReal ) || !is_file( $filenameReal )) {
                                $filename = Yii::getAlias( '@web/../../frontend/web/img/' ) . 'not.jpg';
                            } else {
                                $filename = Yii::getAlias( '@web/../../frontend/web/temp/rooms/' ) . $model->thumb;
                            }

                            return '<img width="280" height="150" src="' . $filename . '" alt="' . $model->title . '" />';
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'images',
                        'format'    => 'html',
                        'value'     => function ($model) {
                            if (empty( $model->images )) {
                                return '<img width="280" height="150" src="' . Yii::getAlias( '@web/../../frontend/web/img/' ) . 'not.jpg' . '" alt="' . $model->title . '" />';
                            }

                            $imagesData = explode( ',', $model->images );

                            $html = '<div class="row">';
                            foreach ($imagesData as $value) {

                                if (empty( $value ))
                                    continue;

                                $html .= '<div class="col-md-3">';
                                $html .= '<img width="340" height="220" src="' . Yii::getAlias( '@web/../../frontend/web/temp/rooms/' ) . $value . '" alt="' . $model->title . '" />';
                                $html .= '</div>';
                            }
                            $html .= '</div>';

                            return $html;
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'is_promote',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_using ];
                        },
                    ],
                    [
                        'attribute' => 'is_comments',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_using ];
                        },
                    ],
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
                            return date( 'Y - m -d , h:i', $model->created_at );
                        },
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , h:i', $model->updated_at );
                        },
                    ],
                    'content:html',
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ); ?>

            <hr/>
            <h3>房间参数</h3>
            <?=
            GridView::widget( [
                'dataProvider' => $dataFieldProvider,
                'columns'      => [
                    [
                        'class'   => 'yii\grid\SerialColumn',
                        'options' => ['width' => 70],
                    ],
                    [
                        'attribute' => 'f_key',
                        'value'     => function ($model) {
                            $data = \common\models\RoomsField::findOne( ['f_key' => $model->f_key] );
                            return $data->f_key;
                        },
                    ],
                    'content',
                    [
                        'attribute' => 'rooms_id',
                        'value'     => function ($model) {
                            $data = \common\models\Rooms::findOne( ['room_id' => $model->rooms_id] );
                            return $data->title;
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
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ] );
            ?>

            <hr/>
            <h3>房间标签</h3>
            <?=
            GridView::widget( [
                'dataProvider' => $dataTagProvider,
                'columns'      => [
                    [
                        'class'   => 'yii\grid\SerialColumn',
                        'options' => ['width' => 70],
                    ],
                    [
                        'attribute' => 't_key',
                        'value'     => function ($model) {
                            $data = \common\models\RoomsTag::findOne( ['t_key' => $model->t_key] );
                            return $data->name;
                        },
                    ],
                    [
                        'attribute' => 'rooms_id',
                        'value'     => function ($model) {
                            $data = \common\models\Rooms::findOne( ['room_id' => $model->rooms_id] );
                            return $data->title;
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
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ] );
            ?>

        </div>
    </div>
</div>

