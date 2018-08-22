<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '房间分类列表';
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



        </div>
    </div>
</div>

