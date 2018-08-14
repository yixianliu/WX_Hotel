<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HotelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '酒店房间管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to(['create']) ?>' class='btn btn-primary btn-lg' title='添加酒店房间'>添加酒店房间</a>
        <a href='<?= Url::to(['auth-role/create', 'type' => 2]) ?>' class='btn btn-primary btn-lg' title='添加认证权限'>添加认证权限</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'hotel_id',
                    'user_id',
                    'c_key',
                    'title',
                    //'content:ntext',
                    //'num',
                    //'checkin_num',
                    //'price',
                    //'discount',
                    //'introduction',
                    //'keywords',
                    //'path',
                    //'thumb',
                    //'images',
                    //'is_promote',
                    //'is_audit',
                    //'is_field',
                    //'is_comments',
                    //'created_at',
                    //'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ]); ?>

        </div>
    </div>
</div>
