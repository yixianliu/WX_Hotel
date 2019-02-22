<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */

$this->title = '添加派送设置';
$this->params['breadcrumbs'][] = ['label' => '派送设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">

                <h4><a href="#" class="sr-item-title">请选择对应的优惠卷</a></h4>

                <?=
                $form->field( $model, 'coupon_key' )->widget( \kartik\select2\Select2::classname(), [
                    'data'          => $result['coupon'],
                    'options'       => ['placeholder' => '请选择对应的优惠卷'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ] )->label( false );
                ?>

            </div>
        </div>
    </div>

    <?= $this->render( '_form', [
        'model'  => $model,
        'result' => $result,
    ] ) ?>

</div>

<?php ActiveForm::end(); ?>
