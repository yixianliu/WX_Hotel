<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '配置中心', 'url' => ['index']];
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
                <?= Html::a( ' 返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
            </p>

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'id',
                    'lang_key',
                    'name',
                    'title',
                    'email:email',
                    'phone',
                    'keywords',
                    'site_url:url',
                    'developers',
                    'icp',
                    'description:ntext',
                    'copyright',
                    'created_at',
                    'updated_at',
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>
