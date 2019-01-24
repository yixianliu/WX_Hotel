<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpnt\ICheck\ICheck;

?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field( $model, 'r_key' )->widget( ICheck::className(), [
                'type'    => ICheck::TYPE_RADIO_LIST,
                'style'   => ICheck::STYLE_SQUARE,
                'items'   => $result['role'],
                'color'   => 'grey',
                'options' => [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<input type="radio" id="r_key' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="r_key' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                    },
                ]] )
            ?>

            <?= $form->field( $model, 'username' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'password' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'nickname' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'credit' )->textInput( ['maxlength' => true] ) ?>

            <?=
            $form->field( $model, 'birthday' )->widget( 'kartik\daterange\DateRangePicker', [
                'convertFormat' => true,
                'pluginOptions' => [
                    'timePicker'          => true,
                    'timePickerIncrement' => 30,
                    'format'              => 'Y年 - m月 - d日 h:i:A',
                ],
            ] );
            ?>

            <?= $form->field( $model, 'signature' )->textarea( ['maxlength' => true, 'rows' => 6] ) ?>

            <?= $form->field( $model, 'address' )->textarea( ['maxlength' => true, 'rows' => 2] ) ?>

            <?= $form->field( $model, 'is_display' )->widget( ICheck::className(), [
                'type'    => ICheck::TYPE_RADIO_LIST,
                'style'   => ICheck::STYLE_SQUARE,
                'items'   => ['On' => '启用', 'Off' => '禁用'],
                'color'   => 'grey',
                'options' => [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<input type="radio" id="is_display' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_display' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                    },
                ]] )
            ?>

            <?= $form->field( $model, 'is_head' )->widget( ICheck::className(), [
                'type'    => ICheck::TYPE_RADIO_LIST,
                'style'   => ICheck::STYLE_SQUARE,
                'items'   => ['On' => '启用', 'Off' => '禁用'],
                'color'   => 'grey',
                'options' => [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<input type="radio" id="is_head' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_head' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                    },
                ]] )
            ?>

            <?= $form->field( $model, 'is_using' )->widget( ICheck::className(), [
                'type'    => ICheck::TYPE_RADIO_LIST,
                'style'   => ICheck::STYLE_SQUARE,
                'items'   => ['On' => '启用', 'Off' => '禁用'],
                'color'   => 'grey',
                'options' => [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<input type="radio" id="is_using' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_using' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                    },
                ]] )
            ?>

            <?= $form->field( $model, 'user_id' )->hiddenInput()->label( false ) ?>

            <div class="form-group">

                <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

                <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
