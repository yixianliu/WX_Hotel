<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotel_id')->textInput(['maxlength' => true, 'value' => $hotelModel->name, 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'room_id')->textInput(['maxlength' => true, 'value' => $roomModel->title, 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->username, 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'value' => $roomModel->price, 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'checkin_men_num')->textInput(['']) ?>

    <?= $form->field($model, 'checkin_men_name')->textInput(['']) ?>

    <?= $form->field($model, 'checkin_men_idcard')->textInput(['']) ?>

    <?=
    $form->field($model, 'check_in')->widget(\kartik\daterange\DateRangePicker::classname(), [
        'convertFormat' => true,
        'pluginOptions' => [
            'timePicker'          => true,
            'timePickerIncrement' => 15,
            'locale'              => ['format' => 'Y-m-d h:i A'],
            'singleDatePicker'    => true,
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'check_out')->widget(\kartik\daterange\DateRangePicker::classname(), [
        'convertFormat' => true,
        'pluginOptions' => [
            'timePicker'          => true,
            'timePickerIncrement' => 15,
            'locale'              => ['format' => 'Y-m-d h:i A'],
            'singleDatePicker'    => true,
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'pay_type')->widget(Select2::classname(), [
        'data'          => ['wechat' => '微信支付', 'alipay' => '支付宝支付', 'cash' => '现金支付'],
        'options'       => ['placeholder' => '卡卷类型...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('同意协议并且下单', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
