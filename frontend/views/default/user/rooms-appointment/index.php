<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/2/19
 * Time: 16:03
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '房间预约';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode( $this->title ) ?></h1>

<a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary' title='添加预约'>添加预约</a>

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

                $data = \common\models\Hotels::findOne( ['hotel_id' => $model->hotel_id] );

                return $data['name'];
            },
            'options'   => ['width' => 280],
        ],
        [
            'attribute' => 'rooms_id',
            'value'     => function ($model) {

                $data = \common\models\Rooms::findOne( ['rooms_id' => $model->rooms_id] );

                return $data['title'];
            },
            'options'   => ['width' => 180],
        ],
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
            'options'   => ['width' => 120],
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
            'options'   => ['width' => 100],
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

<?= Yii::$app->view->renderFile( '@app/views/_FormMsg.php' ); ?>
