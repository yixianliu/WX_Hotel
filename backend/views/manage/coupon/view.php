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

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <p>
                <?= Html::a( '更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => '是否删除这条记录?',
                        'method'  => 'post',
                    ],
                ] ) ?>
                <?= Html::a( '返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '继续添加', ['create'], ['class' => 'btn btn-primary'] ) ?>
            </p>

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'title',
                    'card_id',
                    'coupon_key',
                    'brand_name',
                    'quantity',
                    'denomination',
                    'quota',
                    [
                        'attribute' => 'card_type',
                        'value'     => function ($model) {

                            $state = [
                                'GROUPON'        => '团购券类型',
                                'CASH'           => '代金券类型',
                                'DISCOUNT'       => '折扣券类型',
                                'GIFT'           => '兑换券类型',
                                'GENERAL_COUPON' => '优惠券类型',
                            ];

                            return $state[ $model->card_type ];
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

                            return $state[ $model->pay_type ];
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
                        'attribute' => 'images',
                        'format'    => 'html',
                        'value'     => function ($model) {

                            $images = (!is_file( Yii::getAlias( '@webroot/../../frontend/web/temp/coupon/' ) . $model->coupon_key . '/' . $model->images )) ?
                                Yii::getAlias( '@web/../../frontend/web/img/not.jpg' ) :
                                Yii::getAlias( '@web/../../frontend/web/temp/coupon/' ) . $model->coupon_key . '/' . $model->images;

                            return '<img width="280" height="150" src="' . $images . '" alt="' . $model->title . '" />';
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'created_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , h:i', $model->created_at );
                        },
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , h:i', $model->updated_at );
                        },
                    ],
                    'description',
                ],
                'template'   => '<tr><th width="230">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>

