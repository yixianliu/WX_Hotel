<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '房间预约';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加预约'>添加预约</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= GridView::widget( [
                'dataProvider' => $dataProvider,
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
                        'attribute' => 'hotel_id',
                        'value'     => function ($model) {

                            $data = \common\models\Hotels::findOne(['hotel_id' => $model->hotel_id]);

                            return $data['name'];
                        },
                        'options'   => ['width' => 280],
                    ],
                    [
                        'attribute' => 'rooms_id',
                        'value'     => function ($model) {

                            $data = \common\models\Rooms::findOne(['rooms_id' => $model->rooms_id]);

                            return $data['title'];
                        },
                        'options'   => ['width' => 180],
                    ],
                    'telphone',
                    'name',
                    'start_time',
                    [
                        'attribute' => 'advance_charge',
                        'value'     => function ($model) {

                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->advance_charge ];
                        },
                        'options'   => ['width' => 120]
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
                        'options'   => ['width' => 120]
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

    <?= Yii::$app->view->renderFile( '@app/views/formMsg.php' ); ?>

</div>

