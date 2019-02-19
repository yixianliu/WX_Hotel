<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/2/19
 * Time: 16:05
 */
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?=
$form->field( $model, 'hotel_id' )->widget( Select2::classname(), [
    'data'          => $result['hotel'],
    'options'       => ['placeholder' => '选择酒店...'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
] );
?>

<?= $form->field($model, 'telphone')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?=
$form->field( $model, 'start_time' )->widget( 'kartik\daterange\DateRangePicker', [
    'convertFormat' => true,
    'pluginOptions' => [
        'timePicker'          => true,
        'timePickerIncrement' => 30,
        'format'              => 'Y年 - m月 - d日 h:i:A',
    ],
] );
?>

<div class="form-group">

    <?= Html::submitButton( $model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'] ) ?>

    <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary' title='返回列表'>返回列表</a>

</div>

<?php ActiveForm::end(); ?>
