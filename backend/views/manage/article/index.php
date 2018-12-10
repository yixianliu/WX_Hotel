<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchArticle */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['rooms/create'] ) ?>' class='btn btn-primary btn-lg' title='添加酒店房间'>添加房间</a>
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加房间分类'>添加网站配置</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= GridView::widget( [
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'article_id',
                    'user_id',
                    'c_key',
                    'title',
                    //'content:ntext',
                    //'introduction',
                    //'keywords',
                    //'path',
                    //'praise',
                    //'forward',
                    //'collection',
                    //'share',
                    //'attention',
                    //'is_promote',
                    //'is_hot',
                    //'is_classic',
                    //'is_winnow',
                    //'is_recommend',
                    'is_comments',
                    'is_using',
                    'created_at',
                    'updated_at',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'tableOptions' => [ 'class' => 'table table-hover' ],
                'pager'        => [
                    'options' => [ 'class' => 'pagination' ],
                ],
            ] ); ?>

        </div>
    </div>
</div>
