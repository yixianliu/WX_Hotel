<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '招聘管理';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加招聘'>添加招聘</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= GridView::widget( [
                'dataProvider' => $dataProvider,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'job_id',
                    'user_id',
                    'title',
                    [
                        'attribute' => 'is_language',
                        'value'     => function ($model) {
                            $data = \common\models\Language::findOne( ['lang_key' => $model->is_language] );
                            return $data['name'];
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

    <?= Yii::$app->view->renderFile( '@app/views/_FormMsg.php' ); ?>

</div>
