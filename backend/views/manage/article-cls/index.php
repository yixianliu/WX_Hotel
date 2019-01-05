<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '文章分类列表';
$this->params['breadcrumbs'][] = $this->title;

$html = \common\models\ArticleCls::getCls('On');

?>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['article/create'] ) ?>' class='btn btn-primary btn-lg' title='添加酒店房间'>添加文章</a>
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加房间分类'>添加文章分类</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= $html ?>

        </div>
    </div>
</div>

