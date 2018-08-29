<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '优惠卷管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method'  => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'id',
                    'coupon_key',
                    'validity',
                    'title',
                    'num',
                    'denomination',
                    'quota',
                    'remarks',
                    'coupon_type',
                    [
                        'attribute' => 'is_using',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[$model->is_using];
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'value'     => function ($model) {
                            return date('Y - m -d , h:i', $model->created_at);
                        },
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date('Y - m -d , h:i', $model->updated_at);
                        },
                    ],
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ]) ?>

        </div>
    </div>
</div>

