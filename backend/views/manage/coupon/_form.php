<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'quota')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

            <?=
            $form->field($model, 'validity')->widget('kartik\daterange\DateRangePicker', [
                'convertFormat' => true,
                'pluginOptions' => [
                    'timePicker'          => true,
                    'timePickerIncrement' => 30,
                    'format'              => 'Y年 - m月 - d日 h:i:A',
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'coupon_type')->widget(Select2::classname(), [
                'data'          => ['discount' => '折扣劵', 'coupon' => '优惠卷'],
                'options'       => ['placeholder' => '卡卷类型...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'pay_type')->widget(Select2::classname(), [
                'data'          => [
                    'before' => '消费后送优惠卷',
                    'after'  => '消费前送优惠卷',
                    'wechat' => '关注公众号',
                ],
                'options'       => ['placeholder' => '使用...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>

            <?= $form->field($model, 'remarks')->textarea(['maxlength' => true, 'rows' => 6]) ?>

            <div class="form-group">

                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>

                <a href='<?= Url::to(['index']) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>