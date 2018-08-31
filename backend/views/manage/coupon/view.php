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
                <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => '是否删除这条记录?',
                        'method'  => 'post',
                    ],
                ]) ?>
                <?= Html::a('返回列表', ['index'], ['class' => 'btn btn-primary']) ?>
            </p>

            <?= DetailView::widget([
                'model'      => $model,
                'attributes' => [
                    'title',
                    'coupon_key',
                    'validity',
                    'num',
                    'denomination',
                    'quota',
                    [
                        'attribute' => 'coupon_type',
                        'value'     => function ($model) {

                            $state = ['discount' => '折扣劵', 'coupon' => '优惠卷'];

                            return $state[$model->coupon_type];
                        },
                    ],
                    [
                        'attribute' => 'pay_type',
                        'value'     => function ($model) {
                            $state = [
                                'before' => '消费后送优惠卷',
                                'after'  => '消费前送优惠卷',
                                'wechat' => '关注公众号',
                            ];

                            return $state[$model->pay_type];
                        },
                    ],
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
                    'remarks',
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ]) ?>

        </div>
    </div>
</div>

