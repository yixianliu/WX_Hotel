<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '公众号配置';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-lg-12">

    <div class="form-group">
        <?= Html::a( '添加公众号配置', ['create'], ['class' => 'btn btn-success'] ) ?>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= GridView::widget( [
                'dataProvider' => $dataProvider,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'conf_id',
                    'name',
                    'app_id',
                    'app_secret',
                    'is_using',
                    'is_working',
                    'created_at',
                    'updated_at',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ] ); ?>

        </div>
    </div>
</div>

