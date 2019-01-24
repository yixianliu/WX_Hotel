<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpnt\ICheck\ICheck;

?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default tabs">

        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab-1" role="tab" data-toggle="tab">基本资料</a></li>
        </ul>

        <?php $form = ActiveForm::begin(); ?>

        <div class="panel-body tab-content">

            <div class="tab-pane active" id="tab-1">

                <?= $form->field( $model, 'name' )->textInput() ?>

                <?= $form->field( $model, 'commission_one' )->textInput() ?>

                <?= $form->field( $model, 'commission_two' )->textInput() ?>

                <?= $form->field( $model, 'commission_three' )->textInput() ?>

                <?= $form->field( $model, 'commission_me' )->textInput() ?>

                <?= $form->field( $model, 'is_commission_me' )->widget( ICheck::className(), [
                    'type'    => ICheck::TYPE_RADIO_LIST,
                    'style'   => ICheck::STYLE_SQUARE,
                    'items'   => ['On' => '启用', 'Off' => '禁用'],
                    'color'   => 'grey',
                    'options' => [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return '<input type="radio" id="commission_me' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="commission_me' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
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

            </div>

        </div>

        <?= $form->field( $model, 'user_id' )->hiddenInput()->label( false ) ?>

        <div class="panel-footer">

            <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

            <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
